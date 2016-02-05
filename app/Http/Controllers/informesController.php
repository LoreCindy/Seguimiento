<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\detalleRevision;

class informesController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		return view('informes.informe');
	}

	public function informe(Request $request)
	{

		$fecha_inicio= $request->get('fecha_inicio');
		$fecha_fin=$request->get('fecha_fin');
		$users_id= $request->user()->id;

		$aprobado= \DB::table('detalle_revisions')
            ->join('revisions', 'detalle_revisions.revision_id', '=', 'revisions.id')
            ->join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
            ->select('detalle_revisions.estado','proyectos.fecha_radicacion','proyectos.nombre_contratatista')
            ->where('detalle_revisions.users_id','=',$users_id)
            ->where('detalle_revisions.estado','LIKE','aprobado')
            ->whereBetween('proyectos.fecha_radicacion',array($fecha_inicio,$fecha_fin))
           ->groupby('detalle_revisions.revision_id')
            ->count();
            

       	$devuelto= \DB::table('detalle_revisions')
            ->join('revisions', 'detalle_revisions.revision_id', '=', 'revisions.id')
            ->join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
            ->select('detalle_revisions.estado','proyectos.fecha_radicacion','proyectos.nombre_contratatista')
            ->where('detalle_revisions.users_id','=',$users_id)
            ->where('detalle_revisions.estado','LIKE','devolucion')
            ->whereBetween('proyectos.fecha_radicacion',array($fecha_inicio,$fecha_fin))
            ->groupby('detalle_revisions.revision_id')
            ->count();
            
            $nombre_informe='Informe_Desde_'.$fecha_inicio.'_Hasta_'.$fecha_fin;
            $contratos = array(
    		array('Contratos Aprobados', 'Contratos Devueltos'),
    		array($aprobado, $devuelto) );
               
               Excel::create($nombre_informe, function($excel) use($contratos){

            	$excel->sheet('informe', function($sheet) use($contratos) {

                $sheet->fromArray($contratos,null,'A1',false,false);
 				
            });

             })->export('xls');
        
		}

}