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
                'name' => 'blog',
                'title' => '博文',
            ],
            [
                'name' => 'bbs',
                'title' => '交流区',
            ],

        ];
        foreach($options as $option){
            $option['type'] = 'category';
            $option['value'] = '';
            \App\Model\Option::create($option);
        }
    }
}
