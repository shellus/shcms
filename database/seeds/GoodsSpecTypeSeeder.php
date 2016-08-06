<?php

use Illuminate\Database\Seeder;

class GoodsSpecTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Item::find(1) -> goods_spec_types() -> create(['title' => '功能类型']);

        \App\GoodsSpecType::find(2) -> goods_specs() -> create(['title' => '去屑', 'price' => '0']);
        \App\GoodsSpecType::find(2) -> goods_specs() -> create(['title' => '温和', 'price' => '0']);
        \App\GoodsSpecType::find(2) -> goods_specs() -> create(['title' => '男士专用', 'price' => '0']);
    }
}
