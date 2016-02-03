@extends('app')

@section('content')

<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>

         
			<div class="well">
            
               <form class="form-horizontal" role="form" method="POST" action="{{url('consultar')}}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="alert alert-error" id="alert" style="display: none;">
				<strong>la fecha de finalizacion no puede ser inferior a la fecha inicio</strong>
			  </div>
			<table class="table">
				<thead>
					<tr>
					
						<th>Desde:{!! Form::input('date', 'fecha_inicio', date('Y-m-d'), ['class' => 'form-control']) !!}</th>
						<th>Hasta:{!! Form::input('date', 'fecha_fin', date('Y-m-d'), ['class' => 'form-control']) !!}</th>
						<th>{!! Form::submit('Consultar', ['class' => 'btn btn-primary']) !!}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						
					</tr>
				</tbody>
			</table>
			
            </form>
             </div>
 


@endsection