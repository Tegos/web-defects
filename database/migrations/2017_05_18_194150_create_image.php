<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImage extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function (Blueprint $table) {
			$table->integer('id', true, true);
			$table->string('image')->nullable();
			$table->string('slug')->nullable();
			$table->timestamp('updated_at')->nullable();
			$table->timestamp('created_at')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('images');
	}
}
