<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormatoLegalizacion extends Model
{
    
	public $table = "formato_legalizacions";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revision()
	{
		return $this->hasMany('App\Models\revision', 'formatoLegalizacion_id');
	}

	public function  chequeo()
	{
		return $this->hasMany('App\Models\revision', 'legalizacion_id');
	}

	public function  formato()
	{
		return $this->belongsTo('App\Models\formatolista', 'formatolista_id');
	}

	public $fillable = [
	    "documentos_legalizacion",
		"formatoLista_id"
	];

	public static $rules = [
	     "documentos_legalizacion" => "required",
		"formatoLista_id" => "required"
	];

}
