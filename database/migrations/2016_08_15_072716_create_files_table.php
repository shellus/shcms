<?php

use Illuminate\Support\Facades\Schema;
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

            $table->string('mime_type');
            $table->string('size');
            /**
             * 显示的文件名，一般为用户上传时的原始文件名
             */
            $table->string('display_filename');

            /**
             * 相对路径
             * 不包含文件名
             * 尽量短，尽量不包含通用路径
             * 尽量能和内容关联，例如category_name/article_id这样
             * 可为‘’，代表在默认根目录
             *
             */
            $table->string('save_path');
            /**
             * 带扩展名的真实在文件系统上的文件名
             */
            $table->string('filename');
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
        Schema::dropIfExists('files');
    }
}
