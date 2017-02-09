<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->default('');
            $table->string('type')->default('category'); // or 'tag'
            $table->string('description')->default('');  // 指导资源分类者的标签介绍
            $table->integer('parent_id')->default(0)->unsigned();
            $table->integer('logo_id')->nullable()->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('categories');
    }
}
