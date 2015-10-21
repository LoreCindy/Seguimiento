<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionFormatoLegalizacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('revision_formato_legalizacion', function(Blueprint $table)
		{
			 	$table->integer('revision_id_revision')->unsigned();
			$table->foreign('revision_id_revision')->references('id')->on('revisions')->onDelete('cascade');

			$table->integer('formatoLegalizacion_id')->unsigned();
			$table->foreign('formatoLegalizacion_id')->references('id')->on('formato_legalizacions')->onDelete('cascade');
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
		Schema::drop('revision_formato_legalizacion');
	}

}
	