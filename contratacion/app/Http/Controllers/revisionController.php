<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreaterevisionRequest;
use App\Models\revision;
use App\Models\formatolista;
use App\Models\FormatoLegalizacion;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class revisionController extends AppBaseController
{

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

		$query = revision::name($request->only('name', 'tipo'));
		$revisions = $query->paginate(5);
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
		$datoos= ['chequeos'=>\DB::table('chequeos')->lists('nombre_supervisor', 'id')];
		$datoo= ['legal'=>\DB::table('formato_legalizacions')->lists('documentos_legalizacion', 'id')];
		 $dato= ['datosgenerales'=>\DB::table('datos_generales')->lists('nombre_dato', 'id')];
		 $datas= ['formatolista' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		 
		 $data = ['proyectos' =>\DB::table('proyectos')->lists('nombre_contratatista', 'id')];
		return view('revisions.create', $data, $datas)
		->with($dato)
		->with($datoo)
		->with($datoos);
	}


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
        $input = $request->all();

		$revision = revision::create($input);

		Flash::message('revision saved successfully.');

		return redirect(route('revisions.index'));
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
		$revision = revision::find($id);

		$datoos= ['chequeos'=>\DB::table('chequeos')->lists('nombre_supervisor', 'id')];
		$datoo= ['legal'=>\DB::table('formato_legalizacions')->lists('documentos_legalizacion', 'id')];
		 $dato= ['datosgenerales'=>\DB::table('datos_generales')->lists('nombre_dato', 'id')];
		$data = ['proyectos' =>\DB::table('proyectos')->lists('nombre_contratatista', 'id')];
 		$datas= ['formatolista' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		if(empty($revision))
		{
			Flash::error('revision not found');
			return redirect(route('revisions.index'));
		}

		return view('revisions.edit')->with('revision', $revision)
		->with($data)
		->with($datas)
		->with($dato)
		->with($datoo)
		->with($datoos);
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

		if(empty($revision))
		{
			Flash::error('revision not found');
			return redirect(route('revisions.index'));
		}

		$revision->fill($request->all());
		$revision->save();

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

		if(empty($revision))
		{
			Flash::error('revision not found');
			return redirect(route('revisions.index'));
		}

		$revision->delete();

		Flash::message('revision deleted successfully.');

		return redirect(route('revisions.index'));
	}

public function mostrarFListas(){

	$listas= formatolistas::all();
}





}
