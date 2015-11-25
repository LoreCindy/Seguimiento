<!--- Nombredato Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('documentos_legalizacion', 'Documentos Legalizacion :') !!}
    {!! Form::text('documentos_legalizacion', null, ['class' => 'form-control']) !!}
</div>

<!--- Formatolista Id Field --->
<div class="form-group col-sm-6 col-lg-4"
 {!! Form::label('formatoLista_id', 'Formato Lista:') !!}
    {!! Form::select('formatoLista_id', $formatolistas, null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        {!! link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-danger']) !!}
</div>

