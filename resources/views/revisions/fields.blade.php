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


<!--- Observaciones Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, ['class' => 'form-control']) !!}
</div>


<!--- Formatolista Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('formatoLista_id', 'Formato lista:') !!}          
    {!!  Form::select('formatoLista_id', $formatolista, null, ['class' => 'form-control', 'id' => 'nombre_formato'])  !!}
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>




<script>
 $(document).ready(function(){
    $('#nombre_formato').change(function(){
      $.get("{{ url('formato')}}",
      { option: $(this).val() },
      function(data) {
        $('#nombre_dato').empty();
        $.each(data, function(key, element) {
        
         $('#nombre_dato').append("<tr><td>" + element.nombre_dato + "</td><td><input type='checkbox' name='datos_generales[]' value='"+element.id+"' id='datos_generales_"+element.id+"'></td><td><input type='text' class='form-control' id='nombre_datosGenerales' name='nombre_datosGenerales[]'/></td></tr>");

        });
      });
    });


     $('#nombre_formato').change(function(){
      $.get("{{ url('legal')}}",
      { option: $(this).val() },
      function(data) {
        $('#legalizacion').empty();
        $('#legalizacion').append("<thead><th>Documentos</th><th>Supervisor</th><th>DAC</th><th>Observaciones</th></thead>");
        $.each(data, function(key, element) {
        
        
         $('#legalizacion').append(" <tbody><tr><td>" + element.documentos_legalizacion + "</td><td><input type='text' class='form-control' id='nombre_supervisor' name='nombre_supervisor[]'/></td><td><input type='checkbox' name='legalizacion_id[]' value='"+element.id+"' id='"+element.id+"'></td><td><input type='text' class='form-control' id='observacion' name='observacion[]'/></td></tr> </tbody>");

        });
      });
    });
  });  
  
    
</script>
 
<!--- Datosgenerales Id Field --->
<div class="form-group col-sm-12">
    {!! Form::label('nombre_dato', 'Datos generales:') !!}
    
    <table class="table" id="nombre_dato">
      <tr>
      <td></td>
      </tr>  
    </table>
    </div>


  <!--- formato legalizacion Id Field --->
<div class="form-group col-sm-12">
    {!! Form::label('legalizacion', 'Legalizacion:') !!}
    
    <table class="table table-striped" id="legalizacion">
      <thead>
      <th>Documentos</th>
      <th>Supervisor</th>
      <th>DAC</th>
      <th>Observaciones</th>
      </thead>
      <tbody>
      <tr>
      <td></td>
      </tr>  
      </tbody>
    </table>
    </div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
       {!! link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-danger']) !!}
</div>