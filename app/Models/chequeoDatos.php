<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chequeoDatos extends Model
{
    
	public $table = "chequeoDatos";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revision()
	{
		return $this->belongsTo('App\Models\revision', 'revision_id');
	}

	public function  general()
	{
			return $this->belongsTo('App\Models\datosGenerales', 'datos_generales_id');
	}

		public function scopeName($query, $name)
    {
    
	if(trim($name['name'])!= "" && trim($name['tipo'])!= "" && $name['tipo']!='0')
   	$query->where($name['tipo'],"LIKE",$name['name']);
    }


	public $fillable = [
	    "nombreChequeoDatos",
		"datos_generales_id",
		"revision_id"
		
	];

	public static $rules = [
	    "nombreChequeoDatos" => "required",
		"datos_generales_id" => "required",
		"revision_id" => "required"
		
	];




}
