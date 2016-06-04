<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SiteConfigSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(ArticlesSeeder::class);
    }
}
