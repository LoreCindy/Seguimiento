<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreaterevisionRequest;
use App\Models\revision;
use App\Models\chequeo;
use App\Models\proyecto;
use App\Models\chequeoDatos;
use App\Models\formatolista;
use App\Models\FormatoLegalizacion;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;
use Maatwebsite\Excel\Facades\Excel;

class revisionController extends AppBaseController
{
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
	 * Display a listing of the Post.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//$revisions= \DB::table('revisions')->paginate();

		$query = revision::name($request->only('name', 'tipo'))->with('general');
		$revisions = $query->paginate(8);
		//dd($revisions>toArray()[2]['general']);
		

	
		$revisions->setPath('/contratacion/public/revisions');
        $columns = Schema::getColumnListing('$TABLE_NAME$');
        $attributes = array();


        foreach($columns as $attribute){
            if($request[$attribute] == true)
            {
                $query->where($attribute, $request[$attribute]);
                $attributes[$attribute] =  $request[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        return view('revisions.index')
           // ->with('revisions', $revisions)
            ->with('attributes', $attributes)
            ->with('revisions', $revisions);
	}

	/**
	 * Show the form for creating a new revision.
	 *
	 * @return Response
	 */
	public function create()
	{	

		//$= ['chequeos'=>\DB::table('chequeos')->lists('nombre_supervisor', 'id')];
		 $formatos= ['formatolista' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		
		$proyectos= proyecto::all();
		//$proyectos = ['proyectos' =>\DB::table('proyectos')->lists('nombre_contratatista', 'id')];
		return view('revisions.create')
		->with('proyectos',$proyectos)
		->with($formatos);
	}

	// funcion para regresar la información de las ciudades que pertenecen al estado selecionado
    /*public function listaDatos()
    {	
    	// Recibimos ID del estado selecionado
        $id = Request::input('id');
        // buscamos las ciudades que pertenecen al estado
        $datosgenerales = datos_generales::where('formatolista_id',$id)->get();
	//  Regresamos las ciudades obtenidas de la consulta
        return Response::json($datosgenerales);
    }*/
// funcion para el combo dependiente  de formato lista y datos generales
    public function formato_lista(Request $request)
    {
	   $input  =  $request->get( 'option' );

	   $formatolista  =  formatolista::find($input);
	   //dd($formatolista);

	   $datosGenerales =  $formatolista->datos(); 
	   
	   return  Response::make( $datosGenerales->get([ 'id' , 'nombre_dato' ]));
	   

    }
// funcion para el combo dependiente  de formato lista y formato legalizacion
    public function formato_legalizacion(Request $request)
    {
     	$input  =  $request->get( 'option' );

     	$formatolista=  formatolista::find($input);
	   //dd($formatolista);
	   $FormatoLegalizacion =  $formatolista->legalizacion(); 
	 
	   return  Response::make(  $FormatoLegalizacion->get([ 'id' , 'documentos_legalizacion' ])); 
    }

	/**
	 * Store a newly created revision in storage.
	 *
	 * @param CreaterevisionRequest $request
	 *
	 * @return Response
	 */
	public function store(CreaterevisionRequest $request)
	{
        try {
       
       
		$input = $request->all();
		$revision = revision::create($input);
		$idRevision= $revision->id;
		//$datosGenerales = $request->get("datosGenerales");
		$legalizacion = $request->get("legalizacion_id");
		//$nombreDatos = $request->get("nombre_datosGenerales");
		$dacCheck= $request->get('dac');

		/*foreach ($datosGenerales as $key => $dato) {
			$revision->general()->attach($dato);
			$chequeodato= ["nombreChequeoDatos"=>$nombreDatos[$key],"datos_generales_id"=>$dato,"revision_id"=>$idRevision];
			$chequeodatos = chequeoDatos::create($chequeodato);
		}*/

	  	//$chequeosupervisor=$request->get("nombre_supervisor");
		$chequeoobservacion= $request->get("observacion");

		foreach ($legalizacion as $key => $value) {
		$revision->legalizacion()->attach($value);
	   	$chequeo= ["legalizacion_id"=>$value,"dac"=>$dacCheck[$key],"revision_id"=>$idRevision,"observaciones"=>$chequeoobservacion[$key]];
		$chequeos = chequeo::create($chequeo);
		}

		Flash::message('revision saved successfully.');
		return redirect(route('revisions.index'));
			
		} catch (Exception $e) {
			Flash::message('no se ha podido guardar la revision');
			
		}

	}


	/**
	 * Display the specified revision.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$revision = revision::find($id);

		if(empty($revision))
		{
			Flash::error('revision not found');
			return redirect(route('revisions.index'));
		}

		return view('revisions.show')->with('revision', $revision);
	}

	/**
	 * Show the form for editing the specified revision.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//$query = revision->consulta($id);
		$revision = revision::find($id);

		$legalizaciones =$revision->chequeo;
		$legalizacionFormato=$revision->legalizacion;
		$ejemplo=$revision->formato->legalizacion;
		//dd($ejemplo);
		$datosGenerales=$revision->chequeoDatos;
		$datosGeneralesformato=$revision->general;

		$proyectos = ['proyectos' =>\DB::table('proyectos')->lists('nombre_contratatista', 'id')];
 		$formatolista= ['formatolista' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		if(empty($revision))
		{
			Flash::error('revision not found');
			return redirect(route('revisions.index'));
		}

		return view('revisions.edit')->with('revision', $revision)
		->with($proyectos)
		->with($formatolista)
		->with('datosGeneralesFormato',$datosGeneralesformato)
		->with('datosGenerales',$datosGenerales)
		->with('legalizaciones',$legalizaciones)
		->with('legalizacionesFormato',$legalizacionFormato);
       
		
	}

	/**
	 * Update the specified revision in storage.
	 *
	 * @param  int    $id
	 * @param CreaterevisionRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreaterevisionRequest $request)
	{
		/** @var revision $revision */
		$revision = revision::find($id);
		$idChequeo= $request->get('id');
		$buscarChequeo= chequeo::find($idChequeo);
		$chequeos = $request->only('nombre_supervisor','observacion','dac');
		
		$idDatos= $request->get('id_datos');
		$buscarDatos= chequeoDatos::find($idDatos);
		$datos = $request->only('nombreChequeoDatos');
		
		if(empty($revision))
		{
			Flash::error('revision not found');
			return redirect(route('revisions.index'));
		}

		$revision->fill($request->all());
		$revision->save();
		foreach ($buscarChequeo as $key => $chequeo) {

			$observacion=$chequeos['observacion'][$key];
			$nombre=$chequeos['nombre_supervisor'][$key];
			$dac=$chequeos['dac'][$key];
			$nombre_supervisor=['nombre_supervisor'=>$nombre,'observaciones'=>$observacion ,'dac'=>$dac];
			
			$chequeo->fill($nombre_supervisor);
			$chequeo->save();
	
		}

		foreach ($buscarDatos as $key => $dato) {

			$nombreChequeo=$datos['nombreChequeoDatos'][$key];
		
			$nombreChequeoDatos=['nombreChequeoDatos'=>$nombreChequeo];
		
			$dato->fill($nombreChequeoDatos);
			$dato->save();
	
		}

		Flash::message('revision updated successfully.');
		return redirect(route('revisions.index'));
	}

	/**
	 * Remove the specified revision from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var revision $revision */
		$revision = revision::find($id);
		$datos=$revision->general()->lists('id');
		
		if(empty($revision))
		{
			Flash::error('revision not found');
			return redirect(route('revisions.index'));
		}

		$revision->general()->detach($datos);
		$revision->delete();

		Flash::message('revision deleted successfully.');

		return redirect(route('revisions.index'));
	}

	public function delete (Request $request)
	{
		$id_revisions =$request->get('eliminar');
	
		foreach ($id_revisions as $key => $id_revision) {
			$revision = revision::find($id_revision);
			$datos=$revision->general()->lists('id');

		if(empty($revision))
		{
			Flash::error('revision no encontrada');
			return redirect(route('revisions.index'));
		}

		$revision->general()->detach($datos);
		$revision->delete();
	}
		Flash::message('proyecto deleted successfully.');
		return redirect(route('revisions.index'));	
	}
	


}
