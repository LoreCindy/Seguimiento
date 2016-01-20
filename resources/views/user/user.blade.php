@extends('app')

@section('content')
<h2>Informacion del usuario</h2>

@if (Session::has('status'))
<hr />
<div class='text-success'>
    {{Session::get('status')}}
</div>
<hr />
@endif

<img src='{{url(Auth::user()->perfiles)}}' class='img-responsive' style='max-width: 150px' />
<h3>Nombre: {{Auth::user()->name}}</h3>
<h3>Correo: {{Auth::user()->email}}</h3>
<h3>Opciones:</h3>
<ul>
    <li><a href="{{url('user/profile')}}">Cambiar mi imagen de perfil</a></li>
     <li><a href="{{url('user/password')}}">Cambiar mi password</a></li>

</ul>

@endsection