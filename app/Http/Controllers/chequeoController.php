<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatechequeoRequest;
use App\Models\chequeo;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class chequeoController extends AppBaseController
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
		$query = chequeo::query();
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

        $chequeos = $query->paginate(5);

        return view('chequeos.index')
            ->with('chequeos', $chequeos)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new chequeo.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data= ['legal'=>\DB::table('formato_legalizacions')->lists('documentos_legalizacion', 'id')];
		return view('chequeos.create',  $data);
	}

	/**
	 * Store a newly created chequeo in storage.
	 *
	 * @param CreatechequeoRequest $request
	 *
	 * @return Response
	 */
	public function store(CreatechequeoRequest $request)
	{
        $input = $request->all();

		$chequeo = chequeo::create($input);

		Flash::message('chequeo saved successfully.');

		return redirect(route('chequeos.index'));
	}

	/**
	 * Display the specified chequeo.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$chequeo = chequeo::find($id);

		if(empty($chequeo))
		{
			Flash::error('chequeo not found');
			return redirect(route('chequeos.index'));
		}

		return view('chequeos.show')->with('chequeo', $chequeo);
	}

	/**
	 * Show the form for editing the specified chequeo.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$chequeo = chequeo::find($id);
		$data= ['legal'=>\DB::table('formato_legalizacions')->lists('documentos_legalizacion', 'id')];
		if(empty($chequeo))
		{
			Flash::error('chequeo not found');
			return redirect(route('chequeos.index'));
		}

		return view('chequeos.edit')->with('chequeo', $chequeo)
		 ->with($data);
	}

	/**
	 * Update the specified chequeo in storage.
	 *
	 * @param  int    $id
	 * @param CreatechequeoRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreatechequeoRequest $request)
	{
		/** @var chequeo $chequeo */
		$chequeo = chequeo::find($id);

		if(empty($chequeo))
		{
			Flash::error('chequeo not found');
			return redirect(route('chequeos.index'));
		}

		$chequeo->fill($request->all());
		$chequeo->save();

		Flash::message('chequeo updated successfully.');

		return redirect(route('chequeos.index'));
	}

	/**
	 * Remove the specified chequeo from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var chequeo $chequeo */
		$chequeo = chequeo::find($id);

		if(empty($chequeo))
		{
			Flash::error('chequeo not found');
			return redirect(route('chequeos.index'));
		}

		$chequeo->delete();

		Flash::message('chequeo deleted successfully.');

		return redirect(route('chequeos.index'));
	}
}
