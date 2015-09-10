<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class revision extends Model
{
    
	public $table = "revisions";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "nombre_revision",
		"proyecto_id",
		"formatoLista_id",
		"observaciones",
		"datosGenerales_id",
		"formatoLegalizacion_id",
		"chequeo_id"
	];

	public static $rules = [
	    "nombre_revision" => "required",
		"proyecto_id" => "required",
		"formatoLista_id" => "required",
		"observaciones" => "required",
		"datosGenerales_id" => "required",
		"formatoLegalizacion_id" => "required",
		"chequeo_id" => "required"
	];

}
