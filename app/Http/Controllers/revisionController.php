<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreaterevisionRequest;
use App\Models\revision;
use App\Models\chequeo;
use App\Models\proyecto;
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
		$users_id= $request->user()->id;
		$query= revision::where('users_id','=',$users_id)->name($request->only('name', 'tipo'));
		$revisions = $query->paginate(20);
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
            ->with('attributes', $attributes)
            ->with('revisions', $revisions);
	}

	/**
	 * Show the form for creating a new revision.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{	
		$users_id= $request->user()->id;
		$formatos= ['formatolista' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		$proyectos= proyecto::where('users_id', '=', $users_id)->get();
		
		return view('revisions.create')
		->with('proyectos',$proyectos)
		->with($formatos);
	}
	
   	public function formato_lista(Request $request)
    {
	   $input  =  $request->get( 'option' );
	   $formatolista  =  formatolista::find($input);
	   $datosGenerales =  $formatolista->datos(); 
	   return  Response::make( $datosGenerales->get([ 'id' , 'nombre_dato' ]));
	   

    }
    public function formato_legalizacion(Request $request)
    {
     	$input  =  $request->get( 'option' );
     	$formatolista=  formatolista::find($input);
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
       
      	$users_id= $request->user()->id;
		$nombre = $request->fecha_revision;
		$proyecto_id=$request->proyecto_id;
		$formatoLista_id= $request->formatoLista_id;
		$observaciones= $request->observaciones;
		$input=['fecha_revision'=>$nombre,'proyecto_id'=>$proyecto_id,'formatoLista_id'=>$formatoLista_id,'observaciones'=>$observaciones,'users_id'=>$users_id];
		
		$revision = revision::create($input);
		$idRevision= $revision->id;
		$legalizacion = $request->get("legalizacion_id");
		$dacCheck= $request->get('dac');
		$chequeoobservacion= $request->get("observacion");

		if(empty($legalizacion))
		{
			return redirect(route('revisions.create'))->with('message','debe seleccionar un formato para realizar la revision del contrato');
		}
		else{ 
		foreach ($legalizacion as $key => $value) {
		$revision->legalizacion()->attach($value);
	   	$chequeo= ["legalizacion_id"=>$value,"dac"=>$dacCheck[$key],"revision_id"=>$idRevision,"observaciones"=>$chequeoobservacion[$key]];
		$chequeos = chequeo::create($chequeo);
		}
		
		Flash::message('La revision del contrato se ha guardado exitosamente.');
		return redirect(route('revisions.index'));
			
			}
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
			Flash::error('revision no encontrada.');
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
		$revision = revision::find($id);

		$legalizaciones =$revision->chequeo;
		$legalizacionFormato=$revision->legalizacion;
		$formatolista=$revision->formato->lists('nombre_formato', 'id');
		$proyecto=$revision->proyecto->where('users_id','=',$revision->users_id)->lists('nombre_contratatista','id');
		//$datosGenerales=$revision->chequeoDatos;
		//$datosGeneralesformato=$revision->general;

		//$proyectos = ['proyectos' =>\DB::table('proyectos')->lists( 'nombre_contratatista', 'id')];
 		//$formatolista= ['formatolista' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		if(empty($revision))
		{
			Flash::error('revision no encontrada');
			return redirect(route('revisions.index'));
		}

		return view('revisions.edit')->with('revision', $revision)
		->with('proyecto',$proyecto)
		->with('formatolista',$formatolista)
		//->with('datosGeneralesFormato',$datosGeneralesformato)
		//->with('datosGenerales',$datosGenerales)
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
	public function update($id, Request $request)
	{
		$revision = revision::find($id);
		$idChequeo= $request->get('id');
		$buscarChequeo= chequeo::find($idChequeo);
		$chequeos = $request->only('observacion','dac');
		
		if(empty($revision))
		{
			Flash::error('revision no encontrada');
			return redirect(route('revisions.index'));
		}
	
		$idM= $request->get('fecha_revision');
		$proyectoId= $request->get('proyecto_id');
		$fomatoId= $request->get('formatoLista_id');
		$observacions= $request->get('observaciones');
		$datos= ['fecha_revision'=>$idM, 'proyecto_id'=>$proyectoId,'formatoLista_id'=>$fomatoId, 'observaciones'=>$observacions];

		$revision->fill($datos);
		$revision->save();
		foreach ($buscarChequeo as $key => $chequeo) {
			$observacion=$chequeos['observacion'][$key];
			$dac=$chequeos['dac'][$key];
			$nombre_supervisor=['observaciones'=>$observacion ,'dac'=>$dac];
			$chequeo->fill($nombre_supervisor);
			$chequeo->save();
	
		}

		Flash::message('revision se ha actualizado exitosamente.');
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
		$revision = revision::find($id);
		$datos=$revision->general()->lists('id');
		
		if(empty($revision))
		{
			Flash::error('revision no encontrada');
			return redirect(route('revisions.index'));
		}

		$revision->general()->detach($datos);
		$revision->delete();

		Flash::message('revision eliminada exitosamente.');

		return redirect(route('revisions.index'));
	}

	public function delete (Request $request)
	{
		$id_revisions =$request->get('eliminar');
	
		foreach ($id_revisions as $key => $id_revision) {
			$revision = revision::find($id_revision);
			

		if(empty($revision))
		{
			Flash::error('revision no encontrada');
			return redirect(route('revisions.index'));
		}

		
		$revision->delete();
	}
		Flash::message('revision eliminada exitosamente.');
		return redirect(route('revisions.index'));	
	}
	


}
