<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateformatolistaRequest;
use App\Models\formatolista;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class formatolistaController extends AppBaseController
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
		//$formatolista= \DB::table('formatolistas')->paginate(5);
		//$query = formatolista::query();

		$query = formatolista::name($request->only('name', 'tipo'));
		$formatolistas = $query->paginate(5);
		$formatolistas->setPath('/contratacion/public/formatolistas');

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

       // $formatolistas = $query->get();

        return view('formatolistas.index')
            ->with('formatolistas', $formatolistas)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new formatolista.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('formatolistas.create');
	}

	/**
	 * Store a newly created formatolista in storage.
	 *
	 * @param CreateformatolistaRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateformatolistaRequest $request)
	{
        $input = $request->all();

		$formatolista = formatolista::create($input);

		Flash::message('formatolista saved successfully.');

		return redirect(route('formatolistas.index'));
	}

	/**
	 * Display the specified formatolista.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$formatolista = formatolista::find($id);

		if(empty($formatolista))
		{
			Flash::error('formatolista not found');
			return redirect(route('formatolistas.index'));
		}

		return view('formatolistas.show')->with('formatolista', $formatolista);
	}

	/**
	 * Show the form for editing the specified formatolista.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$formatolista = formatolista::find($id);

		if(empty($formatolista))
		{
			Flash::error('formatolista not found');
			return redirect(route('formatolistas.index'));
		}

		return view('formatolistas.edit')->with('formatolista', $formatolista);
	}

	/**
	 * Update the specified formatolista in storage.
	 *
	 * @param  int    $id
	 * @param CreateformatolistaRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateformatolistaRequest $request)
	{
		/** @var formatolista $formatolista */
		$formatolista = formatolista::find($id);

		if(empty($formatolista))
		{
			Flash::error('formatolista not found');
			return redirect(route('formatolistas.index'));
		}

		$formatolista->fill($request->all());
		$formatolista->save();

		Flash::message('formatolista updated successfully.');

		return redirect(route('formatolistas.index'));
	}

	/**
	 * Remove the specified formatolista from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var formatolista $formatolista */
		$formatolista = formatolista::find($id);

		if(empty($formatolista))
		{
			Flash::error('formatolista not found');
			return redirect(route('formatolistas.index'));
		}

		$formatolista->delete();

		Flash::message('formatolista deleted successfully.');

		return redirect(route('formatolistas.index'));
	}


		public function delete (Request $request)
	{
		$id_formatos =$request->get('eliminar');
	
		foreach ($id_formatos as $key => $id_formato) {
			$formato = formatolista::find($id_formato);

		if(empty($formato))
		{
			Flash::error('formato no encontrado');
			return redirect(route('formatolistas.index'));
		}

		$formato->delete();
	}
		Flash::message('formato eliminado exitosamente');
		return redirect(route('formatolistas.index'));	
	}
}
