<!--- Nombre Dato Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombre_dato', 'Nombre Dato:') !!}
    {!! Form::text('nombre_dato', null, ['class' => 'form-control']) !!}
</div>

<!--- Formatolista Id Field --->
 
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('formatolista_id', 'Formato Lista:') !!}
	{!! Form::select('formatolista_id', $formatolistas,null, ['class' => 'form-control']) !!}
</div>
 

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
       {!! link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-danger']) !!}
</div>
