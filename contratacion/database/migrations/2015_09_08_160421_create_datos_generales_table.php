<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedatosGeneralesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datos_generales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre_dato')->nullable();
			$table->integer('formatolista_id')->unsigned();
			$table->foreign('formatolista_id')->references('id')->on('formatolistas')->onDelete('cascade');
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
		Schema::drop('datos_generales');
	}

}
