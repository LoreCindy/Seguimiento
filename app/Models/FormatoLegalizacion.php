<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormatoLegalizacion extends Model
{
    
	public $table = "formato_legalizacions";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "documentos_legalizacion",
		"formatoLista_id"
	];

	public static $rules = [
	    "documentos_legalizacion" => "required",
		"formatoLista_id" => "required"
	];

}
