<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\detalleRevision;
use Maatwebsite\Excel\Facades\Excel;


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

		$totalContratos= \DB::table('detalle_revisions')
            ->join('revisions', 'detalle_revisions.revision_id', '=', 'revisions.id')
            ->join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
            ->select('detalle_revisions.estado','proyectos.fecha_radicacion','proyectos.nombre_contratatista')
            ->where('detalle_revisions.users_id','=',$users_id)
            ->whereBetween('proyectos.fecha_radicacion',array($fecha_inicio,$fecha_fin))
            ->count();

		$aprobado= \DB::table('detalle_revisions')
            ->join('revisions', 'detalle_revisions.revision_id', '=', 'revisions.id')
            ->join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
            ->select('detalle_revisions.estado','proyectos.fecha_radicacion','proyectos.nombre_contratatista')
            ->where('detalle_revisions.users_id','=',$users_id)
            ->where('detalle_revisions.estado','LIKE','aprobado')
            ->whereBetween('proyectos.fecha_radicacion',array($fecha_inicio,$fecha_fin))
            ->count();

            $aprobado2= detalleRevision::join('revisions', 'detalle_revisions.revision_id', '=', 'revisions.id')
            ->join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
            ->select('detalle_revisions.estado','detalle_revisions.nombre_responsable','proyectos.dependencia_origen','proyectos.fecha_radicacion','proyectos.nombre_contratatista','proyectos.numero_contrato','revisions.fecha_revision','revisions.observaciones')
            ->where('detalle_revisions.users_id','=',$users_id)
            ->where('detalle_revisions.estado','LIKE','aprobado')
            ->whereBetween('proyectos.fecha_radicacion',array($fecha_inicio,$fecha_fin))
            ->get();


           $devuelto2=detalleRevision::join('revisions', 'detalle_revisions.revision_id', '=', 'revisions.id')
            ->join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
            ->select('detalle_revisions.estado','detalle_revisions.nombre_responsable','proyectos.dependencia_origen','proyectos.fecha_radicacion','proyectos.nombre_contratatista','proyectos.numero_contrato','revisions.fecha_revision','revisions.observaciones')
            ->where('detalle_revisions.users_id','=',$users_id)
            ->where('detalle_revisions.estado','LIKE','devolucion')
            ->whereBetween('proyectos.fecha_radicacion',array($fecha_inicio,$fecha_fin))
            ->get();
           
            
       	$devuelto= \DB::table('detalle_revisions')
            ->join('revisions', 'detalle_revisions.revision_id', '=', 'revisions.id')
            ->join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
            ->select('detalle_revisions.estado','proyectos.fecha_radicacion','proyectos.nombre_contratatista')
            ->where('detalle_revisions.users_id','=',$users_id)
            ->where('detalle_revisions.estado','LIKE','devolucion')
            ->whereBetween('proyectos.fecha_radicacion',array($fecha_inicio,$fecha_fin))
            ->count();
            
            $nombre_informe='Informe_Desde_'.$fecha_inicio.'_Hasta_'.$fecha_fin;
            $contratos = array(
    		array('Contratos Aprobados', 'Contratos Devueltos','Total Contratos Radicados'),
    		array($aprobado, $devuelto,$totalContratos) );
               
               Excel::create($nombre_informe, function($excel) use($contratos,$aprobado2,$devuelto2){

            	$excel->sheet('informe general', function($sheet) use($contratos) {
                $sheet->fromArray($contratos,null,'A1',false,false);
 				
            });

            	$excel->sheet('informe Aprobados', function($sheet) use($aprobado2) {
                $sheet->fromArray($aprobado2);
 				
            });

            	$excel->sheet('informe Devueltos', function($sheet) use($devuelto2) {
                $sheet->fromArray($devuelto2);
 				
            });

             })->export('xls');
        
		}

}