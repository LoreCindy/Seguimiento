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




	public $fillable = [
	    "nombre_formato",
		"fecha_formato"
	];

	public static $rules = [
	    "nombre_formato" => "required",
		"fecha_formato" => "required"
	];

}
