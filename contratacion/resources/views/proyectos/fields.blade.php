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
    {!! Form::select('nombre_modalidad', ['Seleccion abreviada' => 'Seleccion Abreviada', 'Concurso_meritos' 
    => 'Concurso Meritos', 'Licitacion Publica'  => 'Licitacion Publica', 'Minima Cuantia' 
    => 'Minima Cuantia', 'Regimen Especial' => 'Regimen Especial', 'Contratacion Directa' => 'Contratacion Directa'], null, ['class' => 'form-control']) !!}

</div>

<!--- Nombre Tipocontratacion Field --->
<div class="form-group col-sm-6 col-lg-4">
   {!! Form::label('nombre_tipoContratacion', 'Tipo Contratacion:') !!}
   {!! Form::select('nombre_tipoContratacion', ['Contrato' => 'Contrato', 'Convenio' => 'Convenio'], null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    {!! link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-danger']) !!}
</div>


