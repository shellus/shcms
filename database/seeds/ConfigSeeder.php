<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2015-04-20
 * Time: 14:47
 */
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $options = [
            [
                'name' => 'title',
                'value' => 'shcms',
                'title' => '网站标题',
            ],
            [
                'name' => 'author',
                'value' => 'shellus',
                'title' => '作者',
            ],
            [
                'name' => 'Copyright',
                'value' => 'Copyright',
                'title' => '版权文字',
            ],
            [
                'name' => 'keywords',
                'value' => '黄色网站,无毒的黄色网站,免费的黄色网站,最有情怀的黄色网站',
                'title' => '网站关键词',
            ],
            [
                'name' => 'description',
                'value' => '很明显，这是一个黄色网站无疑。。',
                'title' => '网站介绍',
            ],
        ];
        foreach($options as $option){
            \App\Model\Config::create($option);
        }
    }

}
