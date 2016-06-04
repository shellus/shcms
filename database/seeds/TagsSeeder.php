<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_tags = [
            ['title' => '阴部特写'],
            ['title' => '菊花特写'],
            ['title' => '美足特写'],

            ['title' => '画质模糊'],
            ['title' => '画质普通'],
            ['title' => '画质清晰'],

            ['title' => '未露点'],
            ['title' => '有码'],
            ['title' => '无码'],
            ['title' => '淑女'],
            ['title' => 'OL'],
            ['title' => '人妻'],
            ['title' => '少妇'],

            ['title' => '学生妹'],
            ['title' => '萝莉'],
            ['title' => '御姐'],
            ['title' => '太妹'],
            ['title' => '淑女'],
            ['title' => 'OL'],
            ['title' => '人妻'],
            ['title' => '少妇'],

            ['title' => '萌'],
            ['title' => '气质'],
            ['title' => '淫荡'],
            ['title' => '精致'],
            ['title' => '偷拍'],
            ['title' => '自拍'],

            ['title' => '野外露出'],
            ['title' => '公交车'],
            ['title' => '公园'],
            ['title' => '海边'],
            ['title' => '办公室'],

            ['title' => '白丝'],
            ['title' => '黑丝'],
            ['title' => '紫丝'],
            ['title' => '红丝'],

            ['title' => '骨感'],
            ['title' => '体型匀称'],
            ['title' => '体型丰腴'],
            ['title' => '高挑美女'],
            ['title' => '贫乳'],
            ['title' => '巨乳'],

            ['title' => '警察'],
            ['title' => '护士'],
            ['title' => '保姆'],
            ['title' => '教师'],
            ['title' => '兔女郎'],
            ['title' => '圣诞美女'],

            ['title' => '口交'],
            ['title' => '乳交'],
            [
                'title' => '中出',
                'description' => '在漢語圈常以「中出」一詞借代「體內射精」'
            ],
            ['title' => '足交'],


//            [
//                'title' => '局部特写' ,
//                '_child' => [
//                    ['title' => '阴部特写'],
//                    ['title' => '菊花特写'],
//                    ['title' => '美足特写'],
//                ],
//            ],
//            [
//                'is_required' => true,
//                'title' => '画质等级' ,
//                '_child' => [
//                    ['title' => '画质模糊'],
//                    ['title' => '画质普通'],
//                    ['title' => '画质清晰'],
//                ],
//            ],
//            [
//                'is_required' => true,
//                'title' => '暴露程度' ,
//                '_child' => [
//                    ['title' => '未露点'],
//                    ['title' => '有码'],
//                    ['title' => '无码'],
//                ],
//            ],
//            [
//                'title' => '女主类型' ,
//                '_child' => [
//                    ['title' => '学生妹'],
//                    ['title' => '萝莉'],
//                    ['title' => '御姐'],
//                    ['title' => '太妹'],
//                    ['title' => '淑女'],
//                    ['title' => 'OL'],
//                    ['title' => '人妻'],
//                    ['title' => '少妇'],
//                ],
//            ],
//            [
//                'title' => '露出' ,
//                '_child' => [
//                    ['title' => '野外露出'],
//                    ['title' => '公交车'],
//                    ['title' => '公园'],
//                    ['title' => '海边'],
//                    ['title' => '办公室'],
//                ],
//            ],
//            [
//                'title' => '风格' ,
//                '_child' => [
//                    ['title' => '萌'],
//                    ['title' => '气质'],
//                    ['title' => '淫荡'],
//                    ['title' => '精致'],
//                    ['title' => '偷拍'],
//                    ['title' => '自拍'],
//                ],
//            ],
//            [
//                'title' => '丝袜' ,
//                '_child' => [
//                    ['title' => '白丝'],
//                    ['title' => '黑丝'],
//                    ['title' => '紫丝'],
//                    ['title' => '红丝'],
//                ],
//            ],
//            [
//                'title' => '体型' ,
//                '_child' => [
//                    ['title' => '骨感'],
//                    ['title' => '体型匀称'],
//                    ['title' => '体型丰腴'],
//                    ['title' => '高挑美女'],
//                    ['title' => '贫乳'],
//                    ['title' => '巨乳'],
//                ],
//            ],
//            [
//                'title' => '角色扮演' ,
//                '_child' => [
//                    ['title' => '警察'],
//                    ['title' => '护士'],
//                    ['title' => '保姆'],
//                    ['title' => '教师'],
//                    ['title' => '兔女郎'],
//                    ['title' => '圣诞美女'],
//                ],
//            ],
//            [
//                'title' => '性交类型' ,
//                '_child' => [
//                    ['title' => '口角'],
//                    ['title' => '乳交'],
//                    [
//                        'title' => '中出',
//                        'description' => '在漢語圈常以「中出」一詞借代「體內射精」'
//                    ],
//                    ['title' => '足交'],
//                ],
//            ],
//            [
//                'title' => '重口味',
//                '_child' => [
//                    ['title' => '捆绑',],
//                    [
//                        'title' => '虐待' ,
//                        '_child' => [
//                            [
//                                'title' => '轻度虐待',
//                                'description' => '轻微的，正常的性行为性质的',
//                            ],
//                            [
//                                'title' => '重度虐待',
//                                'description' => '鞭打，滴蜡之类',
//                            ],
//                            [
//                                'title' => '变态虐待',
//                                'description' => '吃屎喝尿之类',
//                            ],
//                            [
//                                'title' => '血腥虐待',
//                                'description' => '残忍的，危及生命的虐待',
//                            ],
//                        ],
//                    ],
//                ],
//            ],
        ];
        foreach ($data_tags as $data_tag){
            \App\Tag::create($data_tag);
        }
//        $this->loop($data_tags, new \App\Tag(), 0);
    }

    /**
     * @param $plays
     * @param $model \App\Tag
     * @param $level
     */
    private function loop($plays, $model, $level)
    {

        $model_child = null;
        $play = null;

        foreach ($plays as $play) {
            $play['level'] = $level;
            $child = Arr::pull($play, '_child');
            /**
             * @var $model_child \App\Tag
             */
            $model_child = $model->create($play)->childs();
            if ($child) {
                $this->loop($child, $model_child, $level+1);
            }
        }
    }
}
