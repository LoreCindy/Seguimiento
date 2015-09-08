<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datosGenerales extends Model
{
    
	public $table = "datos_generales";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "nombre_dato",
		"formatolista_id"
	];

	public static $rules = [
	    "nombre_dato" => "required",
		"formatolista_id" => "required"
	];

}
