
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>


	<link href="/css/app.css" rel="stylesheet">

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       		<div style="text-align:center;" > 
    			<img src="{!! asset('images/login.png')!!}">
    		</div>
      </div>
      <div class="modal-body">
   
   @if (Session::has('message'))

   <div class="alert alert-danger">
	{{Session::get('message')}}
	</div>

  @endif

						
					
          <form class="form-horizontal" role="form" method="POST" action="{{url('auth/login')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<input type="email" class="form-control input-lg" name="email" value="{{ old('email') }}" placeholder="Email">
							 <div class="text-danger">{{$errors->first('email')}}</div>

						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg" name="password" placeholder="password">
							<div class="text-danger">{{$errors->first('password')}}</div>

						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember">Recordar mi password
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-right: 15px;">Iniciar sesión</button>
								<span class="pull-right"><a href="{{url('auth/register')}}">Registrarme</a></span>
								<span><a href="{{url('password/email')}}">Olvide mi password?</a></span>
							
						</div>
					</form>
      </div>

  </div>
  </div>
</div>


</body>
</html>



