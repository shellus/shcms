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
        try{
            // 这句没有任何字面意义，是用来检查是否配置好支持tag的缓存驱动
            Cache::tags(['check'])->get('RBAC');
        }catch (\Predis\Connection\ConnectionException $e){
            $this->command->error('Unable to connect to redis ' . config('database.redis.default.host') . ':'
                . config('database.redis.default.port'));
            throw $e;
        }

        $this->call(PermissionsSeeder::class);
        $this->call(UserSeeder::class);
    }
}
