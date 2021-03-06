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

	public function  user()
	{
		return $this->belongsTo('App\User', 'users_id');
	}

	public function scopeName($query, $name)
    {
    
	if(trim($name['name'])!= "" && trim($name['tipo'])!= "" && $name['tipo']!='0')
   	$query->where($name['tipo'],"LIKE",$name['name']);
    }

	public $fillable = [
		"id",
	    "fecha_radicacion",
		"nombre_contratatista",
		"nombre_modalidad",
		"nombre_tipoContratacion",
		"users_id",
		"numero_contrato",
		"dependencia_origen"

	];

	public static $rules = [
	    "fecha_radicacion" => "required",
		"nombre_contratatista" => "required",
		"nombre_modalidad" => "required",
		"nombre_tipoContratacion" => "required",
		"numero_contrato" => "required",
		"dependencia_origen" => "required"
	];

}
