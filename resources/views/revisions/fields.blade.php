<!--- Nombre Revision Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('fecha_revision', 'Fecha Revision:') !!}
    {!! Form::input('Date','fecha_revision', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<!--- Proyecto Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('proyecto_id', 'Contratista:') !!}
<select class="selectpicker" name='proyecto_id' data-live-search="true" data-size="10"  data-header="Seleccione un proyecto">
       @foreach($proyectos as $key => $proyecto)
        <option value='{!! $proyecto->id !!}' >{!! $proyecto->nombre_contratatista !!}</option>
    @endforeach
      </select>
</div>

<!--- Formatolista Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('formatoLista_id', 'Formato lista Chequeo:') !!}          
    {!!  Form::select('formatoLista_id',['seleccione un formato',''=>$formatolista],null, ['class' => 'form-control', 'id' => 'nombre_formato'])  !!}
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
 $(document).ready(function(){

     $('#nombre_formato').change(function(){
      $.get("{{ url('legal')}}",
      { option: $(this).val() },
      function(data) {
        $('#legalizacion').empty();
        $('#legalizacion').append("<thead><th>Documentos</th><th>Si</th><th>Observaciones</th></thead>");
        $.each(data, function(key, element) {
         $('#legalizacion').append(" <tbody><tr class='css_"+key+"'><td><input type='text' style='width:10px;visibility:hidden'  name='legalizacion_id[]' value='"+element.id+"' id='legalizacion_id'/>" + element.documentos_legalizacion + "</td><td ><label class='check_"+key+"'><input class='input' type='checkbox' id='dac_"+key+"'/></label><input style='width:10px;visibility:hidden' type='text' class='form-control' name='dac[]' value='false' id='datos_"+key+"'/></td><td><textarea rows='3' class='form-control' id='observacion' name='observacion[]'></textarea></td></tr> </tbody>");
       
   
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
 
<!--- formato legalizacion Id Field --->
<div class="form-group col-sm-12 col-lg-12">
   {!! Form::label('legalizacion', 'Legalización de contratos') !!}
    
    <div class="table-responsive">
    <table class="table table-bordered" id="legalizacion">
      <thead>
      <th>Documentos</th>
      <th>Si</th>
      <th>Observaciones</th>
      </thead>
      <tbody>
      <tr>
      <td></td>
      </tr>  
      </tbody>
    </table>
  </div>
</div>


  <!--- Observaciones Field --->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'rows'=>'8']) !!}
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
       {!! link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-danger']) !!}
</div>