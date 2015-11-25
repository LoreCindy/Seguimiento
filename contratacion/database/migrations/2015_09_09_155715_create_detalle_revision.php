<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRevision extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalle_revisions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('estado');
			$table->date('fecha');
			$table->string('nombre_responsable');
			$table->string('dependencia_responsable');
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
		Schema::drop('detalle_revisions');
	}

}
	