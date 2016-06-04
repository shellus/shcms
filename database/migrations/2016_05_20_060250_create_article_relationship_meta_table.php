<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleRelationshipMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_meta', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('article_id') -> unsigned();
            $table->integer('meta_id') -> unsigned();

            $table->unique(['article_id', 'meta_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_meta');
    }
}
