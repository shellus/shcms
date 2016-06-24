<?php

use Illuminate\Database\Seeder;

class SiteConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \App\SiteConfig::create([
            'type' => 'app',
            'title' => '网站标题',
            'name' => 'site_title',
            'value' => 'shcms',
        ]);
    }
}
