<!--- Nombredato Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('documentosLegalizacion', 'Documentos :') !!}
    {!! Form::text('documentosLegalizacion', null, ['class' => 'form-control']) !!}
</div>

<!--- Formatolista Id Field --->
<div class="form-group col-sm-6 col-lg-4"
 {!! Form::label('formatolista_id', 'Formato Lista:') !!}
 {!! Form::select('formatoLista_id', $formatolista, null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
