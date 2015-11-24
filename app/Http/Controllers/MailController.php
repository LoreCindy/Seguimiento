<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Requests\CreatedetalleRevisionRequest;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class MailController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		  return \View::make('contacto/contact');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function send(Request $request)
   {
       //guarda el valor de los campos enviados desde el form en un array
       $data = $request->all();
 		
       //se envia el array y la vista lo recibe en llaves individuales {{ $email }} , {{ $subject }}...


       
       \Mail::send('contacto.email', $data, function($message) use ($request)
       {
       

           //remitente
           $message->from("gerenciap2015@gmail.com");
 
           //asunto
           $message->subject($request->subject);
 
           //receptor
           $message->to($request->email);
           //dd($message);
 
       });
       return \View::make('contacto/contact');
   }

}
