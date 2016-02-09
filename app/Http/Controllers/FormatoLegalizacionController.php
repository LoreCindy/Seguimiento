<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateFormatoLegalizacionRequest;
use App\Models\FormatoLegalizacion;
use App\Models\formatolista;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class FormatoLegalizacionController extends AppBaseController
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
		$query = FormatoLegalizacion::name($request->only('name'));
		$formatoLegalizacions = $query->paginate(8);
		$formatolista =\DB::table('formatolistas')->lists('nombre_formato', 'id');
		$formatoLegalizacions->setPath('/contratacion/public/formatoLegalizacions');
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

        return view('formatoLegalizacions.index')
            ->with('formatoLegalizacions', $formatoLegalizacions)
            ->with('formatolista', $formatolista)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new FormatoLegalizacion.
	 *
	 * @return Response
	 */
	public function create()
	{
		 $data = ['formatolistas' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		return view('formatoLegalizacions.create',$data);
	}

	/**
	 * Store a newly created FormatoLegalizacion in storage.
	 *
	 * @param CreateFormatoLegalizacionRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateFormatoLegalizacionRequest $request)
	{
        $input = $request->all();

		$formatoLegalizacion = FormatoLegalizacion::create($input);

		Flash::message('descripcion documentos de legalizacion guardado exitosamente.');

		return redirect(route('formatoLegalizacions.index'));
	}

	/**
	 * Display the specified FormatoLegalizacion.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$formatoLegalizacion = FormatoLegalizacion::find($id);

		if(empty($formatoLegalizacion))
		{
			Flash::error('descripcion documentos de legalizacion no se ha encontrado');
			return redirect(route('formatoLegalizacions.index'));
		}

		return view('formatoLegalizacions.show')->with('formatoLegalizacion', $formatoLegalizacion);
	}

	/**
	 * Show the form for editing the specified FormatoLegalizacion.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$formatoLegalizacion = FormatoLegalizacion::find($id);
		 $data = ['formatolistas' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		if(empty($formatoLegalizacion))
		{
			Flash::error('descripcion documentos de legalizacion no se ha encontrado.');
			return redirect(route('formatoLegalizacions.index'));
		}

		return view('formatoLegalizacions.edit')->with('formatoLegalizacion', $formatoLegalizacion)
												->with($data);
	}

	/**
	 * Update the specified FormatoLegalizacion in storage.
	 *
	 * @param  int    $id
	 * @param CreateFormatoLegalizacionRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateFormatoLegalizacionRequest $request)
	{
		/** @var FormatoLegalizacion $formatoLegalizacion */
		$formatoLegalizacion = FormatoLegalizacion::find($id);

		if(empty($formatoLegalizacion))
		{
			Flash::error('descripcion documentos de legalizacion no se ha encontrado');
			return redirect(route('formatoLegalizacions.index'));
		}

		$formatoLegalizacion->fill($request->all());
		$formatoLegalizacion->save();

		Flash::message('descripcion documentos de legalizacion se ha actualizado exitosamente.');

		return redirect(route('formatoLegalizacions.index'));
	}

	/**
	 * Remove the specified FormatoLegalizacion from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var FormatoLegalizacion $formatoLegalizacion */
		$formatoLegalizacion = FormatoLegalizacion::find($id);

		if(empty($formatoLegalizacion))
		{
			Flash::error('descripcion documentos de legalizacion no se ha encontrado');
			return redirect(route('formatoLegalizacions.index'));
		}

		$formatoLegalizacion->delete();

		Flash::message('descripcion documentos de legalizacion se ha eliminado exitosamente');

		return redirect(route('formatoLegalizacions.index'));
	}


	public function delete (Request $request)
	{
		$id_formatos =$request->get('eliminar');
		
	
		foreach ($id_formatos as $key => $id_formato) {
			$formato= formatoLegalizacion::find($id_formato);

		if(empty($formato))
		{
			Flash::error('formato legalizacion no encontrado');
			return redirect(route('formatoLegalizacions.index'));
		}

		$formato->delete();
	}
		Flash::message('descripcion documentos de legalizacion se ha eliminado exitosamente.');
		return redirect(route('formatoLegalizacions.index'));	
	}


	public function listarLegalizaciones(Request $request)
	{
		$input  =  $request->get( 'data' );
		dd($input);
		//return view('formatoLegalizacions.create');
	}
}
