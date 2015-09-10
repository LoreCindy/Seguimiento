<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chequeo extends Model
{
    
	public $table = "chequeos";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
		"legalizacion_id",
		"nombre_supervisor",
		"dac",
		"observaciones"
	];

	public static $rules = [
	    "legalizacion_id" => "required",
		"nombre_supervisor" => "required",
		"dac" => "required",
		"observaciones" => "required"
	];

}
