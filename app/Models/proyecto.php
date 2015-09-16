<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    
	public $table = "proyectos";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revision()
	{
		return $this->hasMany('App\Models\revision', 'proyecto_id');
	}

	public $fillable = [
	    "fecha_radicacion",
		"nombre_contratatista",
		"nombre_modalidad",
		"nombre_tipoContratacion"
	];

	public static $rules = [
	    "fecha_radicacion" => "required",
		"nombre_contratatista" => "required",
		"nombre_modalidad" => "required",
		"nombre_tipoContratacion" => "required"
	];

}
