<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticleMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id')->default(0)->unsigned();
            $table->integer('meta_id')->default(0)->unsigned();
            $table->timestamps();

            $table->foreign('content_id')->references('id')->on('contents')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('meta_id')->references('id')->on('metas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['content_id', 'meta_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_meta');
    }
}
