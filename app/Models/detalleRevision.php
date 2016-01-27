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
public function scopeName($query, $name)
    {
    
	if(trim($name['name'])!= "" && trim($name['tipo'])!= "" && $name['tipo']!='0')
   	$query->where($name['tipo'],"LIKE",$name['name']);
    }
		

	public $fillable = [
	    "estado",
		"nombre_responsable",
		"revision_id"
	];

	public static $rules = [
	    "estado" => "required",
		"nombre_responsable" => "required",
		"revision_id" => "required"
	];

	

}
