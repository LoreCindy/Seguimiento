<!--- Legalizacion Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('legalizacion_id', 'Legalizacion Id:') !!}
    {!! Form::text('legalizacion_id', null, ['class' => 'form-control']) !!}
</div>

<!--- Legalizacion Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('legalizacion_id', 'Legalizacion Id:') !!}
    {!! Form::text('legalizacion_id', null, ['class' => 'form-control']) !!}
</div>

<!--- Nombre Supervisor Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombre_supervisor', 'Nombre Supervisor:') !!}
    {!! Form::text('nombre_supervisor', null, ['class' => 'form-control']) !!}
</div>

<!--- Dac Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('dac', 'Dac:') !!}
    {!! Form::text('dac', null, ['class' => 'form-control']) !!}
</div>

<!--- Observaciones Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
