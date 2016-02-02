<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

	public function informe($dateI, $dateF)
	{
		$detalleRevision=detalleRevision::where('created_at', '>=' , $date_from)->where('created_at', '<=', $date_to)->get();
		dd($detalleRevision);
		//$detalleRevision=detalleRevision::where("estado", "=", "Recibido")->all();
		//$detalleRevision=DB::table('detalle_revisions')->get();
		return $detalleRevision;

	}

}
