<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticleReadingAnalysis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_reading_analyses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->default(0)->unsigned();
            $table->integer('user_id')->default(0)->unsigned();
            $table->integer('reading_at')->default(0)->nullable();
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
        Schema::dropIfExists('article_reading_analyses');
    }
}
