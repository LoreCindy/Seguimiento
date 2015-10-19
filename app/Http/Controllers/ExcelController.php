<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\proyecto;
use App\Models\formatolista;
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
	public function index()
	{
		Excel::create('Proyectos', function($excel) {
 			
            $excel->sheet('Proyectos', function($sheet) {
 				
                $proyectos = proyecto::all();
 				
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
 
                $sheet->fromArray($formatos);
 
            });

        })->download('xls');
	}

	/**
	 * Display the specified resource
	 * @return Response
	 */
	public function chequeos()
	{
		Excel::create('chequeos', function($excel) {
 
            $excel->sheet('chequeos', function($sheet) {
 
                $chequeos = chequeo::all();
 
                $sheet->fromArray($chequeos);
 
            });

        })->download('xls');
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function revision()
	{
	Excel::create('revisiones', function($excel) {
 
            $excel->sheet('revisiones', function($sheet) {
 
                $revisiones = revision::all();
 
                $sheet->fromArray($revisiones);
 
            });

        })->download('xls');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function detalle()
	{
		Excel::create('detalle', function($excel) {
 
            $excel->sheet('detalle', function($sheet) {
 
                $detalles = detalleRevision::all();
 
                $sheet->fromArray($detalles);
 
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
