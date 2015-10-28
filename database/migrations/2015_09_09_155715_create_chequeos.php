<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createchequeos extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chequeos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('legalizacion_id')->unsigned();
			$table->foreign('legalizacion_id')->references('id')->on('formato_legalizacions')->onDelete('cascade');
			$table->string('nombre_supervisor');
			$table->string('dac');
			$table->integer('revision_id')->unsigned();
			$table->foreign('revision_id')->references('id')->on('revisions')->onDelete('cascade');
			$table->text('observaciones');
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
		Schema::drop('chequeos');
	}

}
