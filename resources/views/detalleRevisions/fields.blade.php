<!--- Estado Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::text('estado', null, ['class' => 'form-control']) !!}
</div>

<!--- Fecha Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('fecha', 'Fecha:') !!}
   {!! Form::input('date', 'fecha', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<!--- Nombre Responsable Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombre_responsable', 'Nombre Responsable:') !!}
    {!! Form::text('nombre_responsable', null, ['class' => 'form-control']) !!}
</div>

<!--- Dependencia Responsable Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('dependencia_responsable', 'Dependencia Responsable:') !!}
    {!! Form::text('dependencia_responsable', null, ['class' => 'form-control']) !!}
</div>


<!--- Revision Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('revision_id', 'Revision:') !!}
    {!! Form::select('revision_id', $revision,null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
