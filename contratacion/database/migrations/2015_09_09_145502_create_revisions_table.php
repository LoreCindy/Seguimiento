<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaterevisionsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('revisions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre_revision');
			$table->integer('proyecto_id')->unsigned();
			$table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
			$table->integer('formatoLista_id')->unsigned();
			$table->foreign('formatoLista_id')->references('id')->on('formatolistas')->onDelete('cascade');
			$table->text('observaciones')->nullable();
			$table->integer('datosGenerales_id')->unsigned();
			$table->foreign('datosGenerales_id')->references('id')->on('datos_generales')->onDelete('cascade');
			$table->integer('formatoLegalizacion_id')->unsigned();
			$table->foreign('formatoLegalizacion_id')->references('id')->on('formato_legalizacions')->onDelete('cascade');
			$table->integer('chequeo_id')->unsigned();
			$table->foreign('chequeo_id')->references('id')->on('chequeos')->onDelete('cascade');
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
		Schema::drop('revisions');
	}

}
