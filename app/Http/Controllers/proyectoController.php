<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateproyectoRequest;
use App\Models\proyecto;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class proyectoController extends AppBaseController
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
		$query = proyecto::query();
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

        $proyectos = $query->get();

        return view('proyectos.index')
            ->with('proyectos', $proyectos)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new proyecto.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('proyectos.create');
	}

	/**
	 * Store a newly created proyecto in storage.
	 *
	 * @param CreateproyectoRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateproyectoRequest $request)
	{
        $input = $request->all();

		$proyecto = proyecto::create($input);

		Flash::message('proyecto saved successfully.');

		return redirect(route('proyectos.index'));
	}

	/**
	 * Display the specified proyecto.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$proyecto = proyecto::find($id);

		if(empty($proyecto))
		{
			Flash::error('proyecto not found');
			return redirect(route('proyectos.index'));
		}

		return view('proyectos.show')->with('proyecto', $proyecto);
	}

	/**
	 * Show the form for editing the specified proyecto.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$proyecto = proyecto::find($id);

		if(empty($proyecto))
		{
			Flash::error('proyecto not found');
			return redirect(route('proyectos.index'));
		}

		return view('proyectos.edit')->with('proyecto', $proyecto);
	}

	/**
	 * Update the specified proyecto in storage.
	 *
	 * @param  int    $id
	 * @param CreateproyectoRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateproyectoRequest $request)
	{
		/** @var proyecto $proyecto */
		$proyecto = proyecto::find($id);

		if(empty($proyecto))
		{
			Flash::error('proyecto not found');
			return redirect(route('proyectos.index'));
		}

		$proyecto->fill($request->all());
		$proyecto->save();

		Flash::message('proyecto updated successfully.');

		return redirect(route('proyectos.index'));
	}

	/**
	 * Remove the specified proyecto from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var proyecto $proyecto */
		$proyecto = proyecto::find($id);

		if(empty($proyecto))
		{
			Flash::error('proyecto not found');
			return redirect(route('proyectos.index'));
		}

		$proyecto->delete();

		Flash::message('proyecto deleted successfully.');

		return redirect(route('proyectos.index'));
	}
}
