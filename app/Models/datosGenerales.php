<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datosGenerales extends Model
{
    
	public $table = "datos_generales";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  revisiones()
	{
		return $this->belongsToMany('App\Models\revision', 'id');
	}

	public function  lista()
		{
			return $this->belongsTo('App\Models\formatolista', 'formatolista_id');
		}


	public function scopeName($query, $name)
    {
    
	if(trim($name['name'])!= "" && trim($name['tipo'])!= "" && $name['tipo']!='0')
   
   	$query->where($name['tipo'],"LIKE",$name['name']);
    }


	public $fillable = [
	    "nombre_dato",
		"formatolista_id"
	];

	public static $rules = [
	    "nombre_dato" => "required",
		"formatolista_id" => "required"
	];


	// app/models/Empresa.php
	
	public function procesos() {
		return $this->hasMany('datos_generales');
	}

	public function whereFormato($id){
        return DB::table('datos_generales')
            ->select('nombre_dato', 'id')
            ->where('formatolista_id', '=', $id)
            ->get();
    }



}
