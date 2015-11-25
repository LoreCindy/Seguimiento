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
    {!! Form::label('formatoLista_id',  'Formato lista:') !!}          
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
          $('#nombre_dato').append("<option value='" + element.id + "'>" + element.nombre_dato  + "</option>");
        });
      });
    });
  });   

  $(document).ready(function(){
    $('#nombre_formato').change(function(){

      $.get("{{ url('legal')}}",
      { option: $(this).val() },
      function(data) {
     
        $('#nombre_legal').empty();

        $.each(data, function(key, element) {
          $('#nombre_legal').append("<option value='" + element.id + "'>" + element.documentos_legalizacion + "</option>");
        });
      });
    });
  });   
</script>



<!--- Observaciones Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('observaciones', 'Observaciones:') !!}
    {!! Form::text('observaciones', null, ['class' => 'form-control']) !!}
</div>


<!--- Datosgenerales Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('datosGenerales_id', 'Datos generales:') !!}
    {!! Form::select('datosGenerales_id', $datosgenerales, null, ['class' => 'form-control', 'id' => 'nombre_dato']) !!}

    </div>


<!--- Formatolegalizacion Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('formatoLegalizacion_id', 'Formato legalizacion:') !!}
    {!! Form::select('formatoLegalizacion_id', $legal, null, ['class' => 'form-control', 'id' => 'nombre_legal']) !!}

</div>


<!--- Chequeo Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('chequeo_id', 'Chequeo(Supervisor):') !!}
   {!! Form::select('chequeo_id', $chequeos, null, ['class' => 'form-control']) !!}
</div>
 
                           


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
       {!! link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-danger']) !!}
</div>

<body>


