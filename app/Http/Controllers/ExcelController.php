<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\proyecto;
use App\Models\formatolista;
use App\Models\FormatoLegalizacion;
use App\Models\chequeo;
use App\Models\revision;
use App\Models\detalleRevision;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller {
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
	public function index(Request $request)
	{
		$user_id= $request->user()->id;
		Excel::create('Contratos', function($excel) use ($user_id){
 			
            $excel->sheet('Contratos', function($sheet) use ($user_id) {
 				
                $proyectos = proyecto::where('users_id','=',$user_id)->get();
                $sheet->fromArray($proyectos);
 				
            });

        })->download('xls');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function formato()
	{

		Excel::create('formatos', function($excel) {
 
            $excel->sheet('formatos', function($sheet) {
 
                $formatos = formatolista::all();
                foreach ($formatos as $key => $formato) {
                	$formatosLegalizacion= FormatoLegalizacion::where('formatolista_id','=',$formato->id)->get();
                }

                $sheet->fromArray($formatosLegalizacion);
 
            });

        })->download('xls');
	}

	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function revision(Request $request)
	{

		$user_id= $request->user()->id;
	Excel::create('revisiones', function($excel) use($user_id){
 
            $excel->sheet('revisiones', function($sheet) use($user_id) {
 			
            $revisiones= revision::join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
            ->join('formatolistas','revisions.formatoLista_id','=','formatolistas.id')
            ->select('revisions.fecha_revision','proyectos.nombre_contratatista','proyectos.numero_contrato','formatolistas.nombre_formato','revisions.observaciones')
            ->where('revisions.users_id','=',$user_id)
        	->get();
       
			$sheet->fromArray($revisiones);
 
            });

        })->download('xls');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function detalle(Request $request)
	{

		$user_id= $request->user()->id;
		Excel::create('detalle', function($excel) use ($user_id){
 
            $excel->sheet('detalle', function($sheet) use($user_id){
 
            $detalleRevision= detalleRevision::join('revisions', 'detalle_revisions.revision_id', '=', 'revisions.id')
            ->join('proyectos','revisions.proyecto_id','=','proyectos.id')
            ->select('detalle_revisions.estado','detalle_revisions.nombre_responsable','proyectos.nombre_contratatista','proyectos.numero_contrato','revisions.fecha_revision')
            ->where('detalle_revisions.users_id','=',$user_id)
        	->get();
       
			$sheet->fromArray($detalleRevision);
 
 
            });

        })->download('xls');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
