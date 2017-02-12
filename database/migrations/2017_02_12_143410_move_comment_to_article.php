<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveCommentToArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->integer('article_id')->nullable()->unsigned();
            $table->string('type')->default('article'); // or 'comment'
            $table->tinyInteger('is_awesome')->unsigned()->default(0);
            $table->string('title')->nullable()->change();


            $table->foreign('article_id')->references('id')->on('articles')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('articles_article_id_foreign');
            $table->dropColumn('article_id');
            $table->dropColumn('type');
            $table->dropColumn('is_awesome');
            $table->string('title')->nullable(false)->change();
        });
    }
}
