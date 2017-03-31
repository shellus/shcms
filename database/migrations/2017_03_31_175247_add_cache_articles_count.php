<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCacheArticlesCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('articles_count')->default(0)->unsigned();
        });

        foreach (DB::table('categories')->get() as $value) {
            $articles_count = DB::table('article_category')->where('category_id', '=', $value->id)->count();
            DB::table('categories')->where('id', '=', $value->id)->update(['articles_count' => $articles_count]);
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('articles_count');
        });
    }
}
