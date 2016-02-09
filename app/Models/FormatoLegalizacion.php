<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormatoLegalizacion extends Model
{
    
	public $table = "formato_legalizacions";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revisiones()
	{
		return $this->belongsToMany('App\Models\revision', 'id');
	}

	public function  chequeo()
	{
		return $this->hasMany('App\Models\chequeo', 'legalizacion_id');
	}

	public function  formato()
	{
		return $this->belongsTo('App\Models\formatolista', 'formatolista_id');
	}

	public function scopeName($query, $name)
    {
    
	if(trim($name['name'])!= "") 
   	$query->where('formatolista_id',"LIKE",$name['name']);
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
