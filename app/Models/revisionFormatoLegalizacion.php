<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chequeo extends Model
{
    
	public $table = "revision_formato_legalizacion";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revision()
	{
		return $this->belongsTo('App\Models\revision', 'revision_id_revision');
	}

public function  formatoLegal()
	{
		return $this->belongsTo('App\Models\FormatoLegalizacion', 'formatoLegalizacion_id');
	}


	public $fillable = [
	    "revision_id_revision",
		"formatoLegalizacion_id"
		
	];

	public static $rules = [
	    "revision_id_revision"=>"required",
		"formatoLegalizacion_id"=>"required",
	];




}
