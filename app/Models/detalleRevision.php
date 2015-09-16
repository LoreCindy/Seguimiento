<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detalleRevision extends Model
{
    
	public $table = "detalle_revisions";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revision()
		{
			return $this->belongsTo('App\Models\revision', 'revision_id');
		}

		

	public $fillable = [
	    "estado",
		"fecha",
		"nombre_responsable",
		"dependencia_responsable",
		"revision_id"
	];

	public static $rules = [
	    "estado" => "required",
		"fecha" => "required",
		"nombre_responsable" => "required",
		"dependencia_responsable" => "required",
		"revision_id" => "required"
	];

	

}
