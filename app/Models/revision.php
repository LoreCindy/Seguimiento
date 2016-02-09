<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class revision extends Model
{
    
	public $table = "revisions";

	public $primaryKey = "id";
    
	public $timestamps = true;

	public function  user()
	{
		return $this->belongsTo('App\User', 'users_id');
	}
	public function  detalle()
	{
		return $this->hasMany('App\Models\detalleRevision', 'revision_id');
	}

	public function  proyecto()
	{
		return $this->belongsTo('App\Models\proyecto', 'proyecto_id');
	}

	public function  formato()
	{
		return $this->belongsTo('App\Models\formatolista', 'formatoLista_id');
	}


	public function  legalizacion()
	{
		return $this->belongsToMany('App\Models\FormatoLegalizacion');
	}
	
	public function  chequeo()
	{
		return $this->hasMany('App\Models\chequeo', 'revision_id');
	}



		
		

		
	public function scopeName($query, $name)
    {
    
	if(trim($name['name'])!= "" && trim($name['tipo'])!= "" && $name['tipo']!='0')
   	$query->where($name['tipo'],"LIKE",$name['name']);
    }




	public $fillable = [
	    "fecha_revision",
		"proyecto_id",
		"formatoLista_id",
		"observaciones",
		"users_id"
		//"datosGenerales_id",
		//"chequeo_id"
	];

	public static $rules = [
	    "fecha_revision" => "required",
		"proyecto_id" => "required",
		"formatoLista_id" => "required",
		"observaciones" => "required",
		//"datosGenerales_id" => "required",
		//"chequeo_id" => "required"
	];

	public static $errors = [
            'fecha_revision.required' => 'El campo fecha revision es requerido',
            'proyecto_id.required' => 'El campo contratista es requerido',
            'formatoLista_id.required' => 'El campo formato lista es requerido',
            'observaciones.required' => 'El campo observaciones es requerido',
        ];

	

}
