<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatedetalleRevisionRequest;
use App\Models\detalleRevision;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class detalleRevisionController extends AppBaseController
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
		$query = detalleRevision::query();
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

        $detalleRevisions = $query->get();

        return view('detalleRevisions.index')
            ->with('detalleRevisions', $detalleRevisions)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new detalleRevision.
	 *
	 * @return Response
	 */
	public function create()
	{
		 $data = ['revision' =>\DB::table('revisions')->lists('nombre_revision', 'id')];
		return view('detalleRevisions.create', $data);
	}

	/**
	 * Store a newly created detalleRevision in storage.
	 *
	 * @param CreatedetalleRevisionRequest $request
	 *
	 * @return Response
	 */
	public function store(CreatedetalleRevisionRequest $request)
	{
        $input = $request->all();

		$detalleRevision = detalleRevision::create($input);

		Flash::message('detalleRevision saved successfully.');

		return redirect(route('detalleRevisions.index'));
	}

	/**
	 * Display the specified detalleRevision.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$detalleRevision = detalleRevision::find($id);

		if(empty($detalleRevision))
		{
			Flash::error('detalleRevision not found');
			return redirect(route('detalleRevisions.index'));
		}

		return view('detalleRevisions.show')->with('detalleRevision', $detalleRevision);
	}

	/**
	 * Show the form for editing the specified detalleRevision.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$detalleRevision = detalleRevision::find($id);
 		$data = ['revision' =>\DB::table('revisions')->lists('nombre_revision', 'id')];
		if(empty($detalleRevision))
		{
			Flash::error('detalleRevision not found');
			return redirect(route('detalleRevisions.index'));
		}

		return view('detalleRevisions.edit')->with('detalleRevision', $detalleRevision)
		  ->with($data);
	}

	/**
	 * Update the specified detalleRevision in storage.
	 *
	 * @param  int    $id
	 * @param CreatedetalleRevisionRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreatedetalleRevisionRequest $request)
	{
		/** @var detalleRevision $detalleRevision */
		$detalleRevision = detalleRevision::find($id);

		if(empty($detalleRevision))
		{
			Flash::error('detalleRevision not found');
			return redirect(route('detalleRevisions.index'));
		}

		$detalleRevision->fill($request->all());
		$detalleRevision->save();

		Flash::message('detalleRevision updated successfully.');

		return redirect(route('detalleRevisions.index'));
	}

	/**
	 * Remove the specified detalleRevision from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var detalleRevision $detalleRevision */
		$detalleRevision = detalleRevision::find($id);

		if(empty($detalleRevision))
		{
			Flash::error('detalleRevision not found');
			return redirect(route('detalleRevisions.index'));
		}

		$detalleRevision->delete();

		Flash::message('detalleRevision deleted successfully.');

		return redirect(route('detalleRevisions.index'));
	}
}
