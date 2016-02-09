<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Departamento de contratación</title>

	<link href="{{asset('css/app.css')}}" rel="stylesheet">
	<script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>

	<!-- Latest compiled and minified CSS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">
	<!-- Latest compiled and minified JavaScript -->
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" >
		<div class="container-fluid">
			<div class="navbar-header">
			<img style="padding-top:5px; margin-left:5px;width:128px;height:60" src="{!! asset('images/logoxx.png')!!}">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{!! asset('app')!!}"><i class="glyphicon glyphicon-home"></i></a></li>
					<li><a href="{!! asset('proyectos')!!}">Contratos</a></li>
					<li><a  href="{!! asset ('revisions')!!}">Revisiones</a></li>
					<li><a  href="{!! asset('detalleRevisions')!!}">Detalle revisión</a></li>
					<li><a  href="{!! asset('informes')!!}">Informes</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::check())
							<img src='{{url(Auth::user()->perfiles)}}'  class='img-circle' style='margin-left:10px;margin-top:3px;width:50px; max-width: 50px' />
							
					<li class="dropdown">
							<a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{url('user')}}">perfil</a></li>
								<li><a  href="{!! asset('formatolistas')!!}">Formatos</a></li>
								<li><a href="{{url('logout')}}">cerrar sesion</a></li>
							</ul>
						</li>

					@else
 						<li><a href="{{url('auth/login')}}">Iniciar sesión</a></li>
					@endif

							
				</ul>
			</div>
		</div>
	</nav>

 <div class="container">
    <div class="jumbotron" style="margin-top: 70px;">
  
	@yield('content')
	</div>
 </div>
	<!-- Scripts -->

	<script type="text/javascript">
		var url = window.location;
// Will only work if string in href matches with location
$('ul.nav a[href="'+ url +'"]').parent().addClass('active');

// Will also work for relative and absolute hrefs
$('ul.nav a').filter(function() {
    return this.href == url;
}).parent().addClass('active');
	</script>
	
</body>
</html>
