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
        // 测试redis是否就绪
        try{
            \PRedis::get('test');
        }catch (\Predis\Connection\ConnectionException $e){
            $this->command->error('Unable to connect to redis ' . config('database.redis.default.host') . ':'
                . config('database.redis.default.port'));
            throw $e;
        }

        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ArticlesSeeder::class);
        $this->call(FavoriteSeeder::class);
    }
}
