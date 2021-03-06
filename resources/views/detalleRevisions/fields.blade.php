<!--- Estado Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::select('estado', ['Devolucion' => 'Devolución', 'Aprobado' => 'Aprobado'], null, ['class' => 'form-control']) !!}
</div>

<!--- Nombre Responsable Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nombre_responsable', 'Nombre Responsable:') !!}
    {!! Form::text('nombre_responsable', null, ['class' => 'form-control']) !!}
</div>


<!--- Revision Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('revision_id', 'Revision:') !!}
    <select name= 'revision_id' class='selectpicker show-tick', data-live-search='true', data-size='10', data-header='Seleccione:'>
     @foreach($revision as $key=> $revision)
     <option value='{!! $revision->id!!}'>{!! $revision->nombre_contratatista !!}</option>
      @endforeach
    </select>
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
       {!! link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-danger']) !!}
</div>
