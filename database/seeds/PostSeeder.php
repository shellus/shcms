<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2015-04-20
 * Time: 14:47
 */
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts = [
            [
                'user_id' => 1,
                'title' => '又一个shcms',
                'content' => '欢迎你安装shcms，请开始体验吧！',
            ],
            [
                'user_id' => 1,
                'title'=>'shcms怎么用啊？',
                'content'=>'刚安装就报错了。请问怎么办？',
            ],
        ];

        foreach($posts as $post){
            $model = \App\Model\Post::create($post);
            $this -> command -> info($model -> id);
        }
    }
}

