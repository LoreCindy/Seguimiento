<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequeoDatos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chequeoDatos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombreChequeoDatos');
			$table->integer('datos_generales_id')->unsigned();
			$table->foreign('datos_generales_id')->references('id')->on('datos_generales')->onDelete('cascade');

			$table->integer('revision_id')->unsigned();
			$table->foreign('revision_id')->references('id')->on('revisions')->onDelete('cascade');
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
		Schema::drop('chequeoDatos');
	}

}
	