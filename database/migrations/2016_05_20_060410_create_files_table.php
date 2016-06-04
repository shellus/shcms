<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id') -> unsigned();
            $table->string('title');
            $table->string('filename');
            $table->string('mime_type');
            $table->string('size'); // 字节
            $table->string('value'); // TODO 转换完成后删除
            /**
             * 相对路径
             * 不包含文件名
             * 尽量短，尽量不包含通用路径
             * 尽量能和内容关联，例如category_name/article_id这样
             * 可为‘’，代表在默认根目录
             *
             */
            $table->string('save_path');
            $table->string('description'); // 图集使用的

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
        Schema::drop('files');
    }
}
