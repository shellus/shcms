<?php

namespace App\Console\Commands;

use App\Article;
use App\Service\UserService;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class CrawlSegmentfault extends Command
{
    use CommandHelper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CrawlSegmentfault';

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
        $body = $this->request('https://segmentfault.com/');
        $dom = new Crawler($body);

        $new_index_list = $dom->filter('.stream-list .title a')->each(function (Crawler $node, $i) use (&$list) {
            return $node->attr('href');
        });

        if (\Storage::exists('index_list.diff')) {
            $oldIndexList = \GuzzleHttp\json_decode(\Storage::get('index_list.diff'));
        } else {
            $oldIndexList = [];
        }

        $index_list = array_diff($new_index_list, $oldIndexList);
        foreach ($index_list as $questionPageUrl) {
            $question = $this->getQuestionPage('https://segmentfault.com' . $questionPageUrl);
            $article = new Article();
            $article->title = $question['title'];
            $article->body = $question['question'];


            $u = explode('/', $question['userUrl']);
            $user_id = end($u);;
            $userEmail = $user_id . '@segmentfault.com';

            if (!($user = User::where(['email' => $userEmail])->first())) {
                $user = UserService::create([
                    'name' => utf8_to_unicode_str($question['userName']),
                    'email' => $userEmail,
                    'password' => Str::random(),
                ]);
            };

            $article->user_id = $user->id;

            $article->save();
        }
        if ($index_list){
            $diffJson = \GuzzleHttp\json_encode($new_index_list, JSON_PRETTY_PRINT);
            \Storage::put('index_list.diff', $diffJson);
        }
    }

    public function getQuestionPage($questionPageUrl)
    {
        $body = $this->request($questionPageUrl);
        $dom = new Crawler($body);
        $question = $dom->filter('.question')->html();

        $a['url'] = $questionPageUrl;
        $a['id'] = $dom->filter('#questionTitle')->attr('data-id');
        $a['title'] = $dom->filter('#questionTitle>a')->text();
        $a['question'] = $question;

        $a['userName'] = $dom->filter('.question__author a strong')->first()->text();
        $a['userUrl'] = $dom->filter('.question__author a')->first()->attr('href');

        $a['answers'] = [];
        $dom->filter('.widget-answers__item[id]')->each(function (Crawler $node, $i) use (&$a) {
            $a['answers'][] = [
                'id' => $node->attr('id'),
                'userName' => $node->filter('.answer__info--author-name')->first()->text(),
                'userUrl' => $node->filter('.answer__info--author-name')->first()->attr('href'),
                'userRank' => $node->filter('.answer__info--author-rank')->first()->text(),
                'time' => $node->filter('.list-inline>li')->first()->filter('a')->text(),
                'answer' => $node->filter('.answer')->first()->html(),
            ];
        });
        return $a;
    }
}
