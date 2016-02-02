@extends('app')

@section('content')

<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>

         
			<div class="well">
            
               <form class="form-horizontal" role="form" method="POST" action="{{url('consultar')}}">
			<div class="alert alert-error" id="alert" style="display: none;">
				<strong>la fecha de finalizacion no puede ser inferior a la fecha inicio</strong>
			  </div>
			<table class="table">
				<thead>
					<tr>
						<p>
						Desde:
						<input type="text" id="from" name="from" />
						Hasta:
						<input type="text" id="to" name="to" />
						</p>

						
					 
					</tr>
				</thead>
				<tbody>
					<tr>
						
						<td> {!! Form::submit('Consultar', ['class' => 'btn btn-primary']) !!}</td>
					</tr>
				</tbody>
			</table>
         
            </form>
             </div>
 <script>
	$(function () {
	$("#from").datepicker({
	onClose: function (selectedDate) {
	$("#to").datepicker("option", "minDate", selectedDate);
	}
	});
	$("#to").datepicker({
	onClose: function (selectedDate) {
	$("#from").datepicker("option", "maxDate", selectedDate);
	}
	});
	});
	</script>


 





@endsection