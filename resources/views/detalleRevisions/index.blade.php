@extends('app')

@section('content')

<style type="text/css">
.recibido {  background-color: #E0ECFF; }
.devolucion { background-color: rgb(100%, 88%, 88%); }
.aprobado  { background-color: rgb(227, 255, 224);   }


</style>
    <div class="container">
        @include('flash::message')

        <div class="row">
         <a class="btn btn-primary pull-left" style="margin-top: 10px" href="{!! route('detalleRevisions.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregar detalles Revisión</a>
            
        <a class="btn btn-primary pull-left"  href="detalleExcel" style="margin-top: 8px; margin-left:32%"data-url="">
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
                <table class="table">
                    <thead>
                    <th>Estado</th>
			<th>Fecha</th>
			<th>Nombre Responsable</th>
			<th>Dependencia Responsable</th>
			<th>Revisión</th>
			                 <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($detalleRevisions as $detalleRevision)
                       
                    @if($detalleRevision->estado=='Recibido')
                        <tr class="recibido">
                       <td> Recibido</td>
                    @elseif($detalleRevision->estado=='Devolucion')
                        <tr class="devolucion">
                        <td>Devolucion</td>
                    @else 
                        <tr class="aprobado">
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
                       <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Enviar Correo</h4>
                      </div>
                      <div class="modal-body">
                         {!! Form::open(['route' => 'send', 'method' => 'post']) !!} 
                        
                          <div class="form-group">
                            {!! Form::label('email', 'E-Mail') !!}
                            {!!Form::input('email','email', null,array('class'=>'form-control'))!!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('subject', 'Asunto') !!}
                            {!!Form::input('text','subject', null,array('class'=>'form-control'))!!}
                          </div>
                                                   
                          <div class="form-group">
                            {!! Form::label('body', 'Mensaje') !!}
                            {!! Form::textarea('body',null, ['class' => 'form-control' ]) !!}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                          </div>
                          <div class="form-group">
                            {!! Form::label('name', 'Nombre Responsable') !!}
                            {!!Form::input('text','name',$detalleRevision->nombre_responsable, null,array('class'=>'form-control'))!!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('dep', 'Dependecia Responsable') !!}
                            {!!Form::input('text','dep',$detalleRevision->dependencia_responsable , null,array('class'=>'form-control'))!!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('rev', 'Nombre Revision') !!}
                            {!!Form::input('text','rev',$detalleRevision->revision->nombre_revision , null,array('class'=>'form-control'))!!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('a', 'Observaciones') !!}
                            {!!Form::textarea('a',$detalleRevision->revision->observaciones,array('class'=>'form-control'))!!}
                        
                          </div>
                         
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        {!! Form::submit('Enviar', ['class' => 'btn btn-primary' ] ) !!}
                          {!! Form::close() !!}
                      </div>
         
                  </div>
                </div>
              </div>
                    @endforeach
                    <td> 
                     {!! $detalleRevisions->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
            @endif

        </div>
    </div>
@endsection

