@extends('app')

@section('content')
<style type="text/css">

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
    <div class="container">

        @include('flash::message')
       
<link type="text/css" rel="stylesheet" href="modal.css" />
<script type="text/javascript" src="jquery-1.2.3.min.js"></script>
<script type="text/javascript" src="modal.js"></script>

<script src="http://code.jquery.com/jquery-latest.js"></script>
 <link href="bootstrap.css" rel="stylesheet">
    

        <div class="row">
             <a class="btn btn-primary pull-left" style="margin-top: 10px" href="{!! route('revisions.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregar Revision</a>
           
            <a class="btn btn-primary pull-left" href="revisionExcel" style="margin-top: 8px; margin-left:40%"data-url="">
               <i class="glyphicon glyphicon-download-alt"></i>
               <span class="hidden-xs floatL l5">Exportar</span>
           </a>
           
  {!! Form::open(['route' => 'revisions.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group" >
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                    {!! Form::select('tipo', ['0'=>'seleccione campo','nombre_revision' => 'Nombre Revision'], null, ['class' => 'form-control'])!!}
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
        </div>
        </div>
        <div class="row">
            @if($revisions->isEmpty())
                <div class="well text-center">No revisions found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Nombre Revision</th>

      <th>Contratista </th>
      <th>Formato Lista</th>
      <th>Observaciones</th>
      <th>Datos Generales</th>
      <th>Formato Legalizacion</th>
      
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($revisions as $revision)
                        <tr>
                    <td>{!! $revision->nombre_revision !!}</td>
        
          <td  class="con">{!! $revision->proyecto->nombre_contratatista !!}</td>
          <td>{!! $revision->formato->nombre_formato !!}</td>
          <td>{!! $revision->observaciones !!}</td>
        <!--  boton Modal datos generales -->
          <td><a href="#myModal{{$revision->id}}" class="btn btn-primary" data-backdrop="false"data-toggle="modal" data-target="#myModal{{$revision->id}}">detalles</a></td>

        <!-- Modal datos generales -->
          <div class="modal fade" id="myModal{{$revision->id}}"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header">
          <h4 class="modal-title"style="color:#E4E9F5" >Datos Generales</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>
          </div>
          <div class="modal-body">
         @foreach($revision->general as $dato_general)
            <h4 class="modal-title" id="myModalLabel1"><i class="fa fa-plus-square"></i>Nombre: {!!$dato_general->nombre_dato!!}</h4>
         @endforeach
          </div>
          <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </div>
         </div>
          </div>  

      <!-- boton Modal legalizacion  -->
      <td><a class="btn btn-primary" data-backdrop="false" href="#PlaceModal-{{$revision->id}}" data-toggle="modal">Detalles</a></td>
      
     <!-- Modal legalizacion  -->
            
      <div class="modal fade" id="PlaceModal-{{$revision->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="color:#E4E9F5">Formato Legalizacion</h4>
        <button type="button"  i class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="false">&times;</span></button>

      </div>
      <div class="modal-body">
      @foreach($revision->legalizacion as $legalizacion)
       <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>Legalizacion: {!! $legalizacion->documentos_legalizacion !!} </h4>
       @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

</td>
    <td>
     <a href="{!! route('revisions.edit', [$revision->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
     <a href="{!! route('revisions.delete', [$revision->id]) !!}" onclick="return confirm('Are you sure wants to delete this revision?')"><i class="glyphicon glyphicon-remove"></i></a>
    </td>
       </tr>
                    @endforeach

                    <td> 
                     {!! $revisions->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
            @endif  
        </div>
  
    </div>
@endsection