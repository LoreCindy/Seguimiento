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
		$revisiones= revision::where('users_id','=',$users_id)->lists('fecha_revision', 'id');
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
 		$data = ['revision' =>\DB::table('revisions')->lists('fecha_revision', 'id')];
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
 			//nombre
          // $message->text($request->text);
           //asunto
           $message->subject($request->subject);
 
           //receptor
           $message->to($request->email);
           //dd($message);
 
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
			//return redirect(route('detalleRevisions.index'));
		}
		
		$detalle->delete();

	}
		Flash::message('detalle revision eliminado exitosamente');
		//return redirect(route('detalleRevisions.index'));	

	}

}
