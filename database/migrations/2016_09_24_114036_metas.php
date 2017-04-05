<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Metas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->default('');
            $table->string('type')->default('category'); // or 'tag'
            $table->string('description')->default('');  // 指导资源分类者的标签介绍
            $table->integer('parent_id')->default(0)->unsigned();
            $table->integer('logo_id')->nullable()->unsigned();
            $table->integer('articles_count')->default(0)->unsigned();
            $table->timestamps();

            $table->unique('slug');

            $table->foreign('logo_id')->references('id')->on('files')
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
        Schema::dropIfExists('metas');
    }
}
