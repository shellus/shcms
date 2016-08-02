<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug'); // 商品id，自定义的

            $table->string('shop_id'); // 商铺名称
            $table->string('shop_name'); // 商铺名称

            $table->string('title'); // 标题
            $table->decimal('price', 20, 2); // 价格
            $table->decimal('discount', 20, 2); // 折扣
            $table->decimal('discount_price', 20, 2); // 折后价，用来去除除不尽的尾数

            $table->integer('quantity')->unsigned(); // 数量
            $table->integer('sell_out')->unsigned(); // 卖出数量
            $table->integer('current_quantity')->unsigned(); // 当前数量
            $table->integer('current_sell_out')->unsigned(); // 当前卖出数量


            $table->integer('status')->unsigned(); // 状态码

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
        Schema::drop('items');
    }
}
