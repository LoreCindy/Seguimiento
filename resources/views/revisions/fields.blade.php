

<!--- Nombre Revision Field --->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('nombre_revision', 'Nombre Revision:') !!}
    {!! Form::text('nombre_revision', null, ['class' => 'form-control']) !!}
</div>

<!--- Proyecto Id Field --->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('proyecto_id', 'Proyecto:') !!}
    {!! Form::select('proyecto_id', $proyectos,null, ['class' => 'form-control']) !!}
</div>

  <!--- Observaciones Field --->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows'=>'8']) !!}
</div>

<!--- Formatolista Id Field --->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('formatoLista_id', 'Formato lista:') !!}          
    {!!  Form::select('formatoLista_id',['seleccione un formato',''=>$formatolista],null, ['class' => 'form-control', 'id' => 'nombre_formato'])  !!}
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
        
         $('#nombre_dato').append("<tr><td><input type='text' style='width:10px;visibility:hidden' name='datosGenerales[]' value='"+element.id+"'/>" + element.nombre_dato + "</td><td><input type='text'  class='form-control' id='nombre_datosGenerales_"+key+"' name='nombre_datosGenerales[]'/></td></tr>");
        
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
         $('#legalizacion').append(" <tbody><tr class='css_"+key+"'><td><input type='text' style='width:10px;visibility:hidden'  name='legalizacion_id[]' value='"+element.id+"' id='legalizacion_id'/>" + element.documentos_legalizacion + "</td><td><input type='text' class='form-control' id='nombre_supervisor' name='nombre_supervisor[]'/></td><td ><label class='check_"+key+"'><input class='input' type='checkbox' id='dac_"+key+"'/></label><input style='width:10px;visibility:hidden' type='text' class='form-control' name='dac[]' value='false' id='datos_"+key+"'/></td><td><textarea rows='3' class='form-control' id='observacion' name='observacion[]'></textarea></td></tr> </tbody>");
       
    $('#dac_'+key).on( 'click', function() {
        if( $(this).is(':checked') ){
          
           $('.check_'+key).attr('class','c_on');
           $('#datos_'+key).attr("value", "true");
           $('.css_'+key).css( "background-color","rgb(227, 255, 224)" );
        } else {
         $('#datos_'+key).attr("value", "false");
         $('.css_'+key).css( "background-color","white" );
          }
        });

  
        });


    
      });
    });

   
  
  });  
  
    
</script>
 
<!--- Datosgenerales Id Field --->
<div class="form-group col-sm-6 col-lg-6">
{!! Form::label('nombre_dato', 'Datos generales:') !!}
    <table class="table" id="nombre_dato" >
       <tr>
       <td></td>
       <td></td>
       <td></td>
       </tr>
    </table>
    </div>

<!--- formato legalizacion Id Field --->
<div class="form-group col-sm-6 col-lg-12">
    {!! Form::label('legalizacion', 'Legalizacion:') !!}
    
    <table class="table" id="legalizacion">
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