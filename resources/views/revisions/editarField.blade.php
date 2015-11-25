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
    {!! Form::textarea('observaciones', null, ['class' => 'form-control','rows'=>'8']) !!}
</div>

<!--- Formatolista Id Field --->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('formatoLista_id', 'Formato lista:') !!}          
    {!! Form::select('formatoLista_id',['seleccione un formato',''=>$formatolista],null, ['class' => 'form-control', 'id' => 'nombre_formato'])  !!}
</div>

<!--- Datosgenerales Id Field --->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('id', 'Datos Generales:') !!}
     <table class="table">
       @foreach($datosGeneralesFormato as $key => $datos)
       <tr>
        <td><input type='text'value='{!! $datosGenerales[$key]->id !!}'name='id_datos[]' style='width:10px;visibility:hidden'/>{!! $datos->nombre_dato !!}</td>
        <td><input type='text'style='width:100%' value='{!! $datosGenerales[$key]->nombreChequeoDatos !!}'name='nombreChequeoDatos[]'/></td>
       </tr>
       @endforeach
    </table>
</div>

<!--- formato legalizacion Id Field --->
<div class="form-group col-sm-6 col-lg-12">
 {!! Form::label('id', 'Legalizacion:') !!}
     <table class="table">
      <thead>
      <th>documentos</th>
      <th>supervisor</th>
      <th>dac</th>
      <th>observaciones</th>
      </thead>
      <tbody>
       @foreach($legalizacionesFormato as $key => $legalizacion)
       <tr class='css_{!!$key!!}'>
        <td><input type='text' style='width:10px;visibility:hidden'value='{!! $legalizaciones[$key]->id !!}' name='id[]'/>{!! $legalizacion->documentos_legalizacion !!}</td>
        <td><input type='text' style='width:90%'value='{!! $legalizaciones[$key]->nombre_supervisor !!}' name='nombre_supervisor[]'></td>
        <td><input type='checkbox' class='dacCheck' id='dacCheck_{!!$key!!}' name='dacCheck[]' value='{!! $legalizaciones[$key]->dac !!}'/><input type='text' style='width:10px;visibility:hidden'value='{!! $legalizaciones[$key]->dac !!}' class='dac_{!!$key!!}' name='dac[]' id='dato_'+$key></td>
        <td><textarea rows='3' style='width:100%' name='observacion[]'>{!! $legalizaciones[$key]->observaciones !!}</textarea></td>
       </tr>
       @endforeach
       </tdoby>
    </table>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
 $(document).ready(function(){

 $('.dacCheck').each(function(key, element){
    
    if($(this).val()=='true')
    {
      $(this).prop("checked", "checked");
      $('.css_'+key).css( "background-color","rgb(227, 255, 224)" );
    }

 $(this).on( 'click', function() {
   if($(this).is(':checked'))
   {
    $('.dac_'+key).attr('value','true');
    $('.css_'+key).css( "background-color","rgb(227, 255, 224)" );
   }
   else{
    $('.dac_'+key).attr('value','false');
     $('.css_'+key).css( "background-color","white" );
   }

   });

 });

 });
 </script>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
       {!! link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-danger']) !!}
</div>


