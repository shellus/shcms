<?php

namespace App\Console\Commands;

use App\Article;
use App\Comment;
use App\Service\ArticleService;
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
    protected $description = '实时抓取Segmentfault的数据，需要每分钟运行一次';

    /**
     * Create a new command instance.
     *
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
        // 获取最新问题
        $body = HttpService::request('GET', 'https://segmentfault.com/questions')->getBody()->getContents();
        $dom = new Crawler($body);

        // 从DOM取出问题url列表，并用问题url.回答数量.是否采纳做一个md5.用来对比某个问题是否已经更新，需要再次去采集
        $dom->filter('.stream-list .stream-list__item')->each(function (Crawler $node, $i) use (&$new_index_list) {
            $url = $node->filter('.title a')->attr('href');
            $answersCount = intval($node->filter('.qa-rank .answers')->html());
            $solved = $node->filter('.qa-rank .solved')->count();
            $md5 = "$url-$answersCount-$solved";
            $new_index_list[$md5] = $url;
        });

        // 获取上次抓取列表
        if (\Storage::disk('storage')->exists('questionList.diff')) {
            $oldQuestionList = \GuzzleHttp\json_decode(\Storage::disk('storage')->get('questionList.diff'), true);
        } else {
            $oldQuestionList = [];
        }

        // 和上次的问题列表的差集，得出改变的问题列表
        $questionList = array_diff_key($new_index_list, $oldQuestionList);



        // 循环抓取每一个问题的数据
        $es = [];
        // array_reverse是因为要反向获取，不然顺序是倒的。
        foreach (array_reverse($questionList) as $k => $questionPageUrl) {
            \Log::info('diff: ' . $k . ':' . $questionPageUrl);
            try {
                $question = $this->parse('https://segmentfault.com' . $questionPageUrl);
                $this->store($question);
            } catch (\Exception $e) {
                $es[] = $e;
            }
        }

        // 如果有改变，就存取来作为下次对比差异用
        if ($questionList) {
            $diffJson = \GuzzleHttp\json_encode($new_index_list, JSON_PRETTY_PRINT);
            \Storage::disk('storage')->put('questionList.diff', $diffJson);
        }

        // 问题存起来集中爆发，防止中断循环
        // TODO 其实没做好。。。只能爆发第一个错误，进程就崩溃，后面的错误都被丢掉了
        foreach ($es as $e) {
            throw $e;
        }

        // 不返回IDE会报提示。。烦。
        return;
    }

    /**
     * 从DOM取出需要的数据
     * @param $questionPageUrl
     * @return mixed
     */
    public function parse($questionPageUrl)
    {
        $body = HttpService::request('GET', $questionPageUrl)->getBody()->getContents();
        $dom = new Crawler($body);

        $question = $this->parseQuestion($dom);
        $question['url'] = $questionPageUrl;

        $question['answers'] = $this->parseAnswers($dom);
        return $question;
    }

    /**
     * 取出问题数据
     * @param Crawler $dom
     * @return mixed
     */
    protected function parseQuestion($dom){
        $question['slug'] = 'segmentfault-' . $dom->filter('#questionTitle')->attr('data-id');
        $question['title'] = utf8_to_unicode_str($dom->filter('#questionTitle>a')->text());
        $question['body'] = utf8_to_unicode_str(trim($dom->filter('.question')->html()));
        $question['tags'] = $dom->filter('.taglist--inline li a')->each(function (Crawler $node, $i) {
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

        return $question;
    }

    /**
     * 取出回答数据
     * @param Crawler $dom
     * @return mixed
     */
    protected function parseAnswers($dom){
        return $dom->filter('.widget-answers__item[id]')->each(function (Crawler $node, $i) {
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
    }
    /**
     * 储存数据
     * @param $question
     */
    public function store($question)
    {
        $article = $this->storeQuestion($question);
        foreach ($question['answers'] as $answer) {
            $comment = $this->storeComment($article, $answer);
            // 是否新添加答案
            if ($comment->wasRecentlyCreated) {
                \Log::info('add answer: ' . $comment->slug);
                \Event::fire(new \App\Events\CrawlSegmentfaultAnswer($question, $answer));
            }
        }
    }

    /**
     * 储存问题
     * @param $question
     * @return Article
     */
    protected function storeQuestion($question)
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
            if (!$article->tags()->whereTitle($tag_str)->exists()) {
                $tag = Tag::firstOrCreate(['title' => $tag_str], ['title' => $tag_str, 'slug'=>ArticleService::filterTagSlug($tag_str)]);
                $article->tags()->attach($tag);
            }
        }

        return $article;
    }
    /**
     * 储存回答
     * @param $article
     * @param $answer
     * @return Comment
     */
    protected function storeComment($article, $answer)
    {
        $answerUser = UserService::firstOrCreate(Arr::only($answer['user'], ['email']), $answer['user']);
        if ($answerUser->wasRecentlyCreated) {
            SegmentfaultService::crawlAvatar($answerUser);
            \Log::info('add answer user: ' . $answerUser->email);
        }

        $answer['user_id'] = $answerUser->id;
        $answer['article_id'] = $article->id;
        $answer['body'] = SegmentfaultService::filterBody($answer['body']);

        /** @var Comment $comment */
        $comment = Comment::firstOrCreate(Arr::only($answer, ['slug']), $answer);

        // 判断最佳答案
        if ($answer['is_awesome'] != $comment->is_awesome) {
            $comment->is_awesome = $answer['is_awesome'];
            $comment->save();
            \Log::info('answer change awesome: ' . $comment->slug);
        }
        return $comment;
    }


}
