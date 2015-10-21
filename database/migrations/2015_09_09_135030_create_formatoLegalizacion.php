<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormatoLegalizacion extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formato_legalizacions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->String('documentos_legalizacion');
			$table->integer('formatolista_id')->unsigned()->foreign('formatolista_id')->references('id')->on('formatolistas')->onDelete('cascade');
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
		Schema::drop('formato_legalizacions');
	}

}
