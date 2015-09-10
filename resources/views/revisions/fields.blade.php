<!--- Nombre Revision Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombre_revision', 'Nombre Revision:') !!}
    {!! Form::text('nombre_revision', null, ['class' => 'form-control']) !!}
</div>


<!--- Proyecto Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('proyecto_id', 'Proyecto:') !!}
    {!! Form::select('proyecto_id', $proyectos,null, ['class' => 'form-control']) !!}
</div>


<!--- Formatolista Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('formatoLista_id', 'Formato lista:') !!}
        {!! Form::select('formatoLista_id', $formatolista, null, ['class' => 'form-control']) !!}
</div>

<!--- Observaciones Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, ['class' => 'form-control']) !!}
</div>


<!--- Datosgenerales Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('datosGenerales_id', 'Datos generales:') !!}
    {!! Form::select('datosGenerales_id', $datosgenerales, null, ['class' => 'form-control']) !!}

    
</div>


<!--- Formatolegalizacion Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('formatoLegalizacion_id', 'Formato legalizacion:') !!}
    {!! Form::select('formatoLegalizacion_id', $legal, null, ['class' => 'form-control']) !!}

</div>


<!--- Chequeo Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('chequeo_id', 'Chequeo:') !!}
   {!! Form::select('chequeo_id', $chequeos, null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
