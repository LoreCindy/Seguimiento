<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formatolista extends Model
{
    
	public $table = "formatolistas";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "nombre_formato",
		"fecha_formato"
	];

	public static $rules = [
	    "nombre_formato" => "required",
		"fecha_formato" => "required"
	];

}
