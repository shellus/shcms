<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2015-04-20
 * Time: 14:47
 */
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $options = [
            [
                'name' => 'php',
                'title' => 'php'
            ],
            [
                'name' => 'site',
                'title' => '网站'
            ],
        ];
        foreach($options as $option){
            $option['type'] = 'tag';
            $option['value'] = '';
            \App\Model\Option::create($option);
        }
    }
}
