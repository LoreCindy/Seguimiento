<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormatoLegalizacion extends Model
{
    
	public $table = "formato_legalizacions";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "nombreDato",
		"formatoLista_id"
	];

	public static $rules = [
	    "nombreDato" => "required",
		"formatoLista_id" => "required"
	];

}
