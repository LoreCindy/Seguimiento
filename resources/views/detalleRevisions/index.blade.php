@extends('app')

@section('content')

<style type="text/css">
.recibido {  background-color: #AFD2F2; }
.devolucion { background-color: #E7909B; }
.aprobado  { background-color: #F5E8EA;   }
.modal-body
{
    background-color: #DAFDFD;
}
.modal-header
{
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
     background-color: #263963

}
.modal-footer
{
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
     background-color: #263963
   
}



</style>
    
        @include('flash::message')

        <div id="resultado"></div>


        <div class="row">
         <a class="btn btn-primary pull-left" style="margin-top: 10px" href="{!! route('detalleRevisions.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregar detalles Revisión</a>
            
        <a class="btn btn-primary pull-left"  href="detalleExcel" style="margin-top:10px; margin-left:5px"data-url="">
               <i class="glyphicon glyphicon-download-alt"></i>
               <span class="hidden-xs floatL l5">Exportar</span>
        </a>
             {!! Form::open(['route' => 'detalleRevisions.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                     {!! Form::select('tipo', ['0'=>'seleccione campo','estado' => 'estado','nombre_responsable' => 'Nombre Responsable', 'dependencia_responsable'=> 'Dependencia Responsable'], null, ['class' => 'form-control'])!!}
                 </div>
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
       
        </div>

        <div class="row">
            @if($detalleRevisions->isEmpty())
                <div class="well text-center">No detalleRevisions found.</div>
            @else

          
                <table class="table table-bordered table-hover">
                    <thead>
      <th><input type="checkbox" id="checkTodos" name='eliminar[]'/>
      <button  id="btn" class="btn btn-link" type="submit" onclick="return confirm('esta usted seguro que desea eliminar?')"><i class="glyphicon glyphicon-trash"></i> <span class="hidden-xs floatL l5">Eliminar</span></button> 
      </th>
      <th>Estado</th>
			<th>Fecha</th>
			<th>Nombre Responsable</th>
			<th>Dependencia Responsable</th>
			<th>Revisión</th>
			<th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($detalleRevisions as $key=> $detalleRevision)
                       
                      
                    @if($detalleRevision->estado=='Recibido')
                        <tr class="recibido">
                         <td>
                        <input type="checkbox" class="proyectoEliminar" id="proyectoEliminar_{!! $key !!}" name="eliminar[]" value="{!! $detalleRevision->id !!}">
                        </td>
                       <td> Recibido</td>
                    @elseif($detalleRevision->estado=='Devolucion')
                        <tr class="devolucion">
                        <td>
                        <input type="checkbox" class="proyectoEliminar" id="proyectoEliminar_{!! $key !!}" name="eliminar[]" value="{!! $detalleRevision->id !!}">
                        </td>
                        <td>Devolucion</td>
                    @else 
                        <tr class="aprobado">
                        <td>
                        <input type="checkbox" class="proyectoEliminar" id="proyectoEliminar_{!! $key !!}" name="eliminar[]" value="{!! $detalleRevision->id !!}">
                        </td>
                       <td> Aprobado</td>
                    @endif

					<td>{!! $detalleRevision->fecha !!}</td>
					<td>{!! $detalleRevision->nombre_responsable !!}</td>
					<td>{!! $detalleRevision->dependencia_responsable !!}</td>
					<td>{!! $detalleRevision->revision->nombre_revision !!}</td>
					
                            <td>
                                <a href="{!! route('detalleRevisions.edit', [$detalleRevision->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('detalleRevisions.delete', [$detalleRevision->id]) !!}" onclick="return confirm('Are you sure wants to delete this detalleRevision?')"><i class="glyphicon glyphicon-remove"></i></a>
                                <a href="#myModal{{$detalleRevision->id}}" data-backdrop="false"  data-toggle="modal" data-target="#myModal{{$detalleRevision->id}}"><i class="glyphicon glyphicon-envelope"></i></a>
                            </td>

 <div class="modal fade" id="myModal{{$detalleRevision->id}}" tabindex="-1" role="dialog" aria-labelledby="prueba">
               
   <div class="modal-dialog" >
                  <div class="modal-content">
                       <div class="modal-header" >
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" style="color:#E4E9F5;"id="exampleModalLabel">Enviar Correo</h4>
                      </div>
                      <div class="modal-body">
                         {!! Form::open(['route' => 'send', 'method' => 'post']) !!} 
                        
                          <div class="form-group">
                             <datalist id="email">
                              <option value="cindychamorro@live.com">cindy</option>
                            </datalist>
                            {!! Form::label('email', 'E-Mail') !!}
                           {!!Form::input('list','email', null,array('class'=>'form-control', 'placeholder' => 'Correo electrónico ', 'list'=>'email'   ))!!}
                           {{ $errors->first('email', '<span class="error-message">:message</span>') }}
                          </div>
                          <div class="form-group">
                            {!! Form::label('subject', 'Asunto') !!}
                            {!!Form::input('text','subject', null,array('class'=>'form-control' , 'placeholder' => 'Asunto'))!!}
                          </div>
                                                   
                          <div class="form-group">
                            {!! Form::label('body', 'Mensaje') !!}
                            {!! Form::textarea('body',null, ['class' => 'ckeditor' ]) !!}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                          </div>
                          <div class="form-group">
                            {!! Form::label('name', 'Nombre Responsable') !!}
                           <input name="name" type="text" value="{{$detalleRevision->nombre_responsable}}" id="name" class = 'form-control' disabled>
                            {!!Form::hidden('name',$detalleRevision->nombre_responsable)!!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('dep', 'Dependecia Responsable') !!}
                            <input name="dep" type="text" value="{{$detalleRevision->dependencia_responsable}}" id="dep" class = 'form-control' disabled>
                            {!!Form::hidden('dep',$detalleRevision->dependencia_responsable)!!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('rev', 'Nombre Revision') !!}
                           <input name="rev" type="text" value="{{$detalleRevision->revision->nombre_revision}}" id="dev" class = 'form-control' disabled>
                            {!!Form::hidden('rev',$detalleRevision->revision->nombre_revision )!!}
                          </div>
                          <div class="form-group">
                           {!! Form::label('a', 'Observaciones') !!}
                          {!!Form::textarea('a',$detalleRevision->revision->observaciones,array('class'=>'form-control', 'disabled'))!!}
                           {!!Form::hidden('a' ,$detalleRevision->revision->observaciones)!!}

                          </div>
                         
                      </div>  
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        {!! Form::submit('Enviar', ['class' => 'btn btn-default','name'=>'submit1' ] ) !!}
                          {!! Form::close() !!}
                      </div>
         
                  </div>
                </div>
</div>
   
                    @endforeach
                    {!! $detalleRevisions->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
                
               
            @endif

        </div>
        
        <script src="{{asset('js/seleccionarVariosDelete.js')}}"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            var array = new Array();
            $('#btn').on( 'click', function() {
              $(".proyectoEliminar:checked").each(function() {
                array.push($(this).val());
               });
                 $.ajax({
                  method: "GET",
                  url: "eliminarVarios",
                  data:{data:array},
                  success: function() {
                  location.reload();
                    //$("#resultado").html(response);
                  }
                });
              });
            });
        </script>
      
@endsection

