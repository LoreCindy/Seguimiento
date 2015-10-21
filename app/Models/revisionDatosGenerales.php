<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chequeo extends Model
{
    
	public $table = "revision_datos_generales";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revision()
	{
		return $this->belongsTo('App\Models\revision', 'revision_id_revision');
	}

public function  datosGenerales()
	{
		return $this->belongsTo('App\Models\datosGenerales', 'datosGenerales_id');
	}



	public $fillable = [
	    "revision_id_revision",
		"datosGenerales_id"
		
	];

	public static $rules = [
	     "revision_id_revision"=>"required",
		"datosGenerales_id"=>"required",
		
	];




}
