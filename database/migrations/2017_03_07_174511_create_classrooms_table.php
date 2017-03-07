<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassroomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classrooms', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('number', 45)->nullable()->comment('教室编号');
			$table->string('name', 45)->nullable();
			$table->string('location', 45)->nullable()->comment('地点');
			$table->float('square', 8, 2)->nullable()->comment('教室面积。单位：米');
			$table->integer('floor')->nullable()->comment('楼层');
			$table->boolean('is_free')->nullable()->default(1)->comment('是否空闲。0-否；1-是。默认-1');
			$table->string('building_name', 45)->nullable()->comment('建筑物名称');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classrooms');
	}

}
