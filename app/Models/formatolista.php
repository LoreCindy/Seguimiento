<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class formatolista extends Model
{
    
	public $table = "formatolistas";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revision()
	{
		return $this->hasMany('App\Models\revision', 'formatoLista_id');
	}

	public function  legalizacion()
	{
		return $this->hasMany('App\Models\FormatoLegalizacion', 'formatoLista_id');
	}

	public function  datos()
	{
		return $this->hasMany('App\Models\datosGenerales', 'formatolista_id');
	}

public function scopeName($query, $name)
    {
    
	if(trim($name['name'])!= "" && trim($name['tipo'])!= "" && $name['tipo']!='0')
   	$query->where($name['tipo'],"LIKE",$name['name']);
    }



	public $fillable = [
	    "nombre_formato",
		"fecha_formato"
	];

	public static $rules = [
	    "nombre_formato" => "required",
		"fecha_formato" => "required"
	];

}
