<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table -> string('api_token') -> after('password');

            \App\User::chunk(100, function($users){
                /** @var \App\User $user */
                foreach ($users as $user){
                    $user -> api_token = \Illuminate\Support\Str::random(60);
                    $user -> save();
                }
            });
            $table->unique('api_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_api_token_unique');
            $table->dropColumn('api_token');
        });
    }
}
