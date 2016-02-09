<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatedetalleRevisionRequest;
use App\Models\detalleRevision;
use App\Models\revision;
use Illuminate\Http\Request;
use Validator,Input,redirect;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class detalleRevisionController extends AppBaseController
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
		$query = detalleRevision::where('users_id','=',$users_id)->name($request->only('name', 'tipo', 'nombre_revision'));
		$detalleRevisions = $query->paginate(5);
		$detalleRevisions->setPath('/contratacion/public/detalleRevisions');
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

        

        return view('detalleRevisions.index')
            ->with('detalleRevisions', $detalleRevisions)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new detalleRevision.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$users_id=$request->user()->id;
		$revisiones=revision::join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
		->where('revisions.users_id','=',$users_id)
		->select('proyectos.nombre_contratatista','revisions.id')
		->get();
		
		return view('detalleRevisions.create')
				->with('revision',$revisiones);
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
        
      	$user_id=$request->user()->id;
      	$estado= $request->get('estado');
      	$nombreR=$request->get('nombre_responsable');
      	$revision=$request->get('revision_id');
      	$input=['estado'=>$estado,'nombre_responsable'=>$nombreR,'revision_id'=>$revision,'users_id'=>$user_id];
		$detalleRevision = detalleRevision::create($input);

		Flash::message('el detalle de la revision se ha guardado exitosamente.');

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
			Flash::error('detalle de revision no encontrado');
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
		$users_id=$detalleRevision->users_id;
 		$revisiones=revision::join('proyectos', 'revisions.proyecto_id', '=', 'proyectos.id')
		->where('revisions.users_id','=',$users_id)
		->where('revisions.id','=',$detalleRevision->revision_id)
		->select('proyectos.nombre_contratatista','revisions.id')
		->get();
		if(empty($detalleRevision))
		{
			Flash::error('detalle de revision no encontrado');
			return redirect(route('detalleRevisions.index'));
		}

		return view('detalleRevisions.edit')->with('detalleRevision', $detalleRevision)
		  ->with('revision',$revisiones);
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
		$detalleRevision = detalleRevision::find($id);

		if(empty($detalleRevision))
		{
			Flash::error('detalle de revision no encontrado');
			return redirect(route('detalleRevisions.index'));
		}

		$detalleRevision->fill($request->all());
		$detalleRevision->save();

		Flash::message('el detalle de la revision se ha actualizado exitosamente.');

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
		$detalleRevision = detalleRevision::find($id);

		if(empty($detalleRevision))
		{
			Flash::error('detalle de revision no encontrado');
			return redirect(route('detalleRevisions.index'));
		}

		$detalleRevision->delete();

		Flash::message('el detalle de la revision se ha eliminado exitosamente.');

		return redirect(route('detalleRevisions.index'));
	}

	
	public function send(Request $request)
   {
    $data = $request->all();
   	$rules=['email'=>'required|email'];
    $validator=Validator::make($data, $rules);
	if ($validator->fails())
   	{	Flash::error('Ingrese una dirección de correo correcta');
    	 return redirect(route('detalleRevisions.index'));
   	}
   	else
   	{
	
    \Mail::send('contacto.email', $data, function($message) use ($request)
       {
           //remitente
           $message->from("legalizacion0@gmail.com");
           //asunto
           $message->subject($request->subject);
           //receptor
           $message->to($request->email);
       });

       Flash::message('Su correo se ha enviado con exito.');
       return redirect(route('detalleRevisions.index'));
   }
}


   	public function delete (Request $request)
	{
		$input  =  $request->get( 'data' );

		foreach ($input as $key => $id_detalle) {
			$detalle = detalleRevision::find($id_detalle);
		if(empty($detalle))
		{
			Flash::error('detalle revision no encontrado');
		}
		
		$detalle->delete();

	}
		Flash::message('detalle revision eliminado exitosamente');
	}

}
