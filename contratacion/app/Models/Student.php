<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
	public $table = "students";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public $fillable = [
	    "nombre",
		"apellido"
	];

	public static $rules = [
	    "nombre" => "required",
		"apellido" => "required"
	];

}
