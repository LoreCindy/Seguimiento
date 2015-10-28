<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chequeo extends Model
{
    
	public $table = "chequeos";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revision()
	{
		return $this->belongsTo('App\Models\revision', 'revision_id');
	}

	public function  legalizacion()
		{
			return $this->belongsTo('App\Models\formatoLegalizacion', 'legalizacion_id');
		}

		public function scopeName($query, $name)
    {
    
	if(trim($name['name'])!= "" && trim($name['tipo'])!= "" && $name['tipo']!='0')
   	$query->where($name['tipo'],"LIKE",$name['name']);
    }


	public $fillable = [
	    "legalizacion_id",
		"nombre_supervisor",
		"dac",
		"revision_id",
		"observaciones"
	];

	public static $rules = [
	    "legalizacion_id" => "required",
		"nombre_supervisor" => "required",
		"dac" => "required",
		"revision_id"=>"required",
		"observaciones" => "required"
	];




}
