<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMindmapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mindmaps', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('text');
            $table->integer('user_id')->unsigned(); // 创建用户
            $table->integer('parent_id')->unsigned();
            $table->text('field'); // 其他字段-JSON格式
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
		Schema::drop('mindmaps');
	}

}
