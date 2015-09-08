<!--- Nombredato Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombreDato', 'Nombredato:') !!}
    {!! Form::text('nombreDato', null, ['class' => 'form-control']) !!}
</div>

<!--- Formatolista Id Field --->
<div class="form-group col-sm-6 col-lg-4"
{!! Form::label('formatoLista_id', 'Seleccion un formato) !!}
    {!! Form::text('formatoLista_id', null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
