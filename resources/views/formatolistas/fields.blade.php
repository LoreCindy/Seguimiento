<!--- Nombre Formato Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombre_formato', 'Nombre Formato:') !!}
    {!! Form::text('nombre_formato', null, ['class' => 'form-control']) !!}
</div>

<!--- Fecha Formato Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('fecha_formato', 'Fecha Formato:') !!}
   {!! Form::input('date', 'fecha_formato', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
