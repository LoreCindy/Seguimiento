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
   
    {!! Form::select('nombre_modalidad', ['Seleccion abreviada' => 'Selección Abreviada', 'Concurso_meritos' 
    => 'Concurso Meritos', 'Licitacion Pública'  => 'Licitacion Pública', 'Minima Cuantia' 
    => 'Minima Cuantía', 'Regimen Especial' => 'Regimen Especial', 'Contratación Directa' => 'Contratación Directa'], null, ['class' => 'form-control']) !!}

</div>

<!--- Nombre Tipocontratacion Field --->
<div class="form-group col-sm-6 col-lg-4">
   {!! Form::label('nombre_tipoContratacion', 'Nombre Tipocontratacion:') !!}
   {!! Form::select('nombre_tipoContratacion', ['Contrato' => 'Contrato', 'Convenio' => 'Convenio'], null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
