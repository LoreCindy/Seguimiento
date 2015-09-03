<!--- Fecha Radicacion Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('fecha_radicacion', 'Fecha Radicacion:') !!}
    {!! Form::input('date', 'fecha_radicacion', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<!--- Nombre Contratatista Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombre_contratatista', 'Nombre Contratatista:') !!}
    {!! Form::text('nombre_contratatista', null, ['class' => 'form-control']) !!}
</div>

<!--- Nombre Modalidad Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombre_modalidad', 'Nombre Modalidad:') !!}
    {!! Form::text('nombre_modalidad', null, ['class' => 'form-control']) !!}
</div>

<!--- Nombre Tipocontratacion Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombre_tipoContratacion', 'Nombre Tipocontratacion:') !!}
    {!! Form::text('nombre_tipoContratacion', null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
