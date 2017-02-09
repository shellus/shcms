<?php

namespace App\Console\Commands;

use App\Article;
use App\Comment;
use App\Service\HttpService;
use App\Service\SegmentfaultService;
use App\Service\UserService;
use App\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class CrawlSegmentfault extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CrawlSegmentfault {url?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->argument('url')) {
            $question = $this->getQuestionPage($this->argument('url'));
            $this->storeQuestion($question);
            return;
        }
        if (\Storage::disk('storage')->exists('index_list.diff')) {
            $oldIndexList = \GuzzleHttp\json_decode(\Storage::disk('storage')->get('index_list.diff'), true);
        } else {
            $oldIndexList = [];
        }

        $body = HttpService::request('GET','https://segmentfault.com/questions')->getBody()->getContents();
        $dom = new Crawler($body);

        $dom->filter('.stream-list .stream-list__item')->each(function (Crawler $node, $i) use (&$new_index_list) {
            $url = $node->filter('.title a')->attr('href');
            $answersCount = intval($node->filter('.qa-rank .answers')->html());
            $solved = $node->filter('.qa-rank .solved')->count();
            $md5 = "$url-$answersCount-$solved";
            $new_index_list[$md5] = $url;
        });


        $index_list = array_diff_key($new_index_list, $oldIndexList);

        foreach (array_reverse($index_list) as $k => $questionPageUrl) {
            \Log::info('diff: ' . $k . ':' . $questionPageUrl);
            $question = $this->getQuestionPage('https://segmentfault.com' . $questionPageUrl);
            $this->storeQuestion($question);
        }
        if ($index_list) {
            $diffJson = \GuzzleHttp\json_encode($new_index_list, JSON_PRETTY_PRINT);
            \Storage::disk('storage')->put('index_list.diff', $diffJson);
        }
    }

    public function storeQuestion($question)
    {

        $user = UserService::firstOrCreate(['email' => $question['user']['email']], $question['user']);
        if ($user->wasRecentlyCreated) {
            SegmentfaultService::crawlAvatar($user);
            \Log::info('add question user: ' . $user->email);
        }
        $question['user_id'] = $user->id;
        $question['body'] = SegmentfaultService::filterBody($question['body']);

        /** @var Article $article */
        $article = Article::firstOrCreate(Arr::only($question, ['slug']), $question);
        if ($article->wasRecentlyCreated) {
            \Log::info('add question: ' . $article->slug);
            \Event::fire(new \App\Events\CrawlSegmentfaultQuestion($question));
        }
        foreach ($question['tags'] as $tag_str) {
            $article->tags()->attach(Tag::firstOrCreate(['title'=>$tag_str]));
        }
        foreach ($question['answers'] as $answer) {
            $answerUser = UserService::firstOrCreate(Arr::only($answer['user'], ['email']), $answer['user']);
            if ($answerUser->wasRecentlyCreated) {
                SegmentfaultService::crawlAvatar($answerUser);
                \Log::info('add answer user: ' . $answerUser->email);
            }

            $answer['user_id'] = $answerUser->id;
            $answer['article_id'] = $article->id;
            $answer['body'] = SegmentfaultService::filterBody($answer['body']);
            $comment = Comment::firstOrCreate(Arr::only($answer, ['slug']), $answer);
            if ($answer['is_awesome'] != $comment->is_awesome) {
                $comment->is_awesome = $answer['is_awesome'];
                $comment->save();
                \Log::info('answer change awesome: ' . $comment->slug);
            }
            if ($comment->wasRecentlyCreated) {
                \Log::info('add answer: ' . $comment->slug);
                \Event::fire(new \App\Events\CrawlSegmentfaultAnswer($question, $answer));
            }

        }
    }

    public function getQuestionPage($questionPageUrl)
    {
        $body = HttpService::request('GET', $questionPageUrl)->getBody()->getContents();
        $dom = new Crawler($body);

        $question['url'] = $questionPageUrl;
        $question['slug'] = 'segmentfault-' . $dom->filter('#questionTitle')->attr('data-id');
        $question['title'] = utf8_to_unicode_str($dom->filter('#questionTitle>a')->text());
        $question['body'] = utf8_to_unicode_str(trim($dom->filter('.question')->html()));
        $question['tags'] = $dom->filter('.taglist--inline li a')->each(function(Crawler $node, $i){
            return $node->attr('data-original-title');
        });

        $userName = $dom->filter('.question__author a strong')->first()->text();
        $userUrl = $dom->filter('.question__author a')->first()->attr('href');

        $u = explode('/', $userUrl);
        $user_id = end($u);;
        $userEmail = $user_id . '@segmentfault.com';

        $question['user'] = [
            'name' => utf8_to_unicode_str($userName),
            'email' => $userEmail,
            'password' => Str::random(),
        ];

        $question['answers'] = $dom->filter('.widget-answers__item[id]')->each(function (Crawler $node, $i) {
            $userName = $node->filter('.answer__info--author-name')->first()->text();
            $userUrl = $node->filter('.answer__info--author-name')->first()->attr('href');

            $u = explode('/', $userUrl);
            $user_id = end($u);
            $userEmail = $user_id . '@segmentfault.com';

            return [
                'slug' => 'segmentfault-' . $node->attr('id'),
                'time' => $node->filter('.list-inline>li')->first()->filter('a')->text(),
                'body' => utf8_to_unicode_str(trim($node->filter('.answer')->first()->html())),
                'is_awesome' => $node->filter('.accepted-check-icon')->count(),
                'user' => [
                    'name' => utf8_to_unicode_str($userName),
                    'email' => $userEmail,
                    'password' => Str::random(),
                    'rank' => $node->filter('.answer__info--author-rank')->first()->text(),
                ],
            ];
        });
        return $question;
    }
}
