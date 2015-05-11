<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2015-04-20
 * Time: 14:47
 */
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $options = [
            [
                'name' => 'luanlun',
                'title' => '家庭乱伦',
            ],
            [
                'name' => 'renqi',
                'title' => '人妻交换',
            ],
            [
                'name' => 'dushi',
                'title' => '都市激情',
            ],
            [
                'name' => 'xiaoyuan',
                'title' => '校园春色',
            ],
            [
                'name' => 'wuxia',
                'title' => '武侠古典',
            ],
            [
                'name' => 'linglei',
                'title' => '另类小说',
            ],


            [
                'name' => 'zipai',
                'title' => '自拍偷拍',
            ],
            [
                'name' => 'yazhou',
                'title' => '亚洲色图',
            ],
            [
                'name' => 'oumei',
                'title' => '欧美色图',
            ],
            [
                'name' => 'meitui',
                'title' => '美腿丝袜',
            ],
            [
                'name' => 'qingchun',
                'title' => '清纯唯美',
            ],
            [
                'name' => 'katong',
                'title' => '卡通动漫'
            ],
        ];
        foreach($options as $option){
            $option['type'] = 'category';
            $option['value'] = '';
            \App\Model\Option::create($option);
        }
    }
}
