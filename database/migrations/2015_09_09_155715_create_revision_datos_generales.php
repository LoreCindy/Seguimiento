<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionDatosGenerales extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('revision_datos_generales', function(Blueprint $table)
		{
			$table->integer('revision_id_revision')->unsigned();
			$table->foreign('revision_id_revision')->references('id')->on('revisions')->onDelete('cascade');
			$table->integer('datosGenerales_id')->unsigned();
			$table->foreign('datosGenerales_id')->references('id')->on('datos_generales')->onDelete('cascade');
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
		Schema::drop('revision_datos_generales');
	}

}
	