<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Cookie;
use URL;


class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$email=$data['email'];
		$user=$data['name'];

		$key = str_random(32);
		 Cookie::queue('key', $key, 60*24);
        // Almacenar el email
        Cookie::queue('email', $email, 60*24);
		  // Crear la url de confirmación para el mensaje del email
        $msg = "<a href='".URL::to("/confirmregister/$email/$key")."'>Confirmar cuenta</a>";

         //Enviar email para confirmar el registro
        $datos = array(
            'user' => $user,
            'msg' => $msg,
          );

        $fromEmail = 'gerenciap2015@gmail.com';
        $fromName = 'Administrador';

         \Mail::send('contacto.register', $datos, function($message) use ($fromName, $fromEmail, $user, $email)
          {
             $message->to($email, $user);
             $message->from($fromEmail, $fromName);
             $message->subject('Confirmar registro en Laravel');
          });
         
          $message = '<hr><label class="label label-info">'.$user.' le hemos enviado un email a su cuenta de correo electrónico para que confirme su registro</label><hr>';
		
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}


}
