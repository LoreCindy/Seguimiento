@extends('app')
@section('content')
<h2>Cambiar imagen de perfil</h2>

<form method='post' action='{{url("user/updateprofile")}}' enctype='multipart/form-data'>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class='form-group'>
		<label for='image'>Imagen: </label>
		<input type="file" name="image" />
		<div class='text-danger'>{{$errors->first('image')}}</div>
	</div>
	<button type='submit' class='btn btn-primary'>Actualizar imagen de perfil</button>
	<a href="/contratacion/public/auth/login" type="submit" >Iniciar Sesión</a>
</form>
@endsection