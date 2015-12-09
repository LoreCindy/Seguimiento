<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatedatosGeneralesRequest;
use App\Models\datosGenerales;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class datosGeneralesController extends AppBaseController
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
		$query = datosGenerales::name($request->only('name', 'tipo'));
		$datosGenerales = $query->paginate(5);
		$datosGenerales->setPath('/contratacion/public/datosGenerales');
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

       
        return view('datosGenerales.index')
            ->with('datosGenerales', $datosGenerales)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new datosGenerales.
	 *
	 * @return Response
	 */
	public function create()

	{	 $data = ['formatolistas' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		return view('datosGenerales.create', $data);

	}

	/**
	 * Store a newly created datosGenerales in storage.
	 *
	 * @param CreatedatosGeneralesRequest $request
	 *
	 * @return Response
	 */
	public function store(CreatedatosGeneralesRequest $request)
	{
        $input = $request->all();

		$datosGenerales = datosGenerales::create($input);

		Flash::message('datosGenerales saved successfully.');

		return redirect(route('datosGenerales.index'));
	}

	/**
	 * Display the specified datosGenerales.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$datosGenerales = datosGenerales::find($id);

		if(empty($datosGenerales))
		{
			Flash::error('datosGenerales not found');
			return redirect(route('datosGenerales.index'));
		}

		return view('datosGenerales.show')->with('datosGenerales', $datosGenerales);
	}

	/**
	 * Show the form for editing the specified datosGenerales.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$datosGenerales = datosGenerales::find($id);
		$data = ['formatolistas' =>\DB::table('formatolistas')->lists('nombre_formato', 'id')];
		if(empty($datosGenerales))
		{
			Flash::error('datosGenerales not found');
			return redirect(route('datosGenerales.index'));
		}

		return view('datosGenerales.edit')->with('datosGenerales', $datosGenerales)
										   ->with($data);
	}

	/**
	 * Update the specified datosGenerales in storage.
	 *
	 * @param  int    $id
	 * @param CreatedatosGeneralesRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreatedatosGeneralesRequest $request)
	{
		/** @var datosGenerales $datosGenerales */
		$datosGenerales = datosGenerales::find($id);

		if(empty($datosGenerales))
		{
			Flash::error('datosGenerales not found');
			return redirect(route('datosGenerales.index'));
		}

		$datosGenerales->fill($request->all());
		$datosGenerales->save();

		Flash::message('datosGenerales updated successfully.');

		return redirect(route('datosGenerales.index'));
	}

	/**
	 * Remove the specified datosGenerales from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var datosGenerales $datosGenerales */
		$datosGenerales = datosGenerales::find($id);

		if(empty($datosGenerales))
		{
			Flash::error('datosGenerales not found');
			return redirect(route('datosGenerales.index'));
		}

		$datosGenerales->delete();

		Flash::message('datosGenerales deleted successfully.');

		return redirect(route('datosGenerales.index'));
	}

	
	public function delete (Request $request)
	{
		$id_datos =$request->get('eliminar');
	
		foreach ($id_datos as $key => $id_dato) {
			$dato = datosGenerales::find($id_dato);

		if(empty($dato))
		{
			Flash::error('datos generales no encontrado.');
			return redirect(route('datosGenerales.index'));
		}

		$dato->delete();
	}
		Flash::message('datos generales eliminados exitosamente.');
		return redirect(route('datosGenerales.index'));	
	}
}
