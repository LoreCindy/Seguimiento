@extends('app')

@section('content')

<style type="text/css">
.btn{
   position:relative;
   padding:8px 16px;
   font-family:'psychotik';
   font-size:1.2em;
   font-weight:normal;
   color:#fff;
   text-shadow:none;
   border-radius:16px;
   background:#00A6B6;
   box-shadow:inset 2px 2px 1px #007f8b;
}
.btn:hover{
   background:#FF9C00;
   box-shadow:inset 2px 2px 1px #995f02;
}
/* Un bloque que ocupe toda la pantalla y contendrá nuestra modal... */
#modalContent{
   position:absolute;
   top:50%;
   left:50%;
   z-index:6;
   margin:-2% 0px 0px -150px;
   float:left;
   width:300px;
   color:#fff;
   line-height:22px;
   padding:15px;
   border-radius:5px;
   background:#00A6B6;
   border:1px solid #fff;
   box-shadow:0px 2px 1px #999;
}
/* ... los estilos de la ventana central ... */
#modal{
   position:fixed;
   top:0px;
   left:0px;
   z-index:5;
   float:left;
   width:100%;
   height:100%;
   background:rgba(0,0,0,0.2);
   display:none;
   opacity:0;
}
/* ... y un ‹a› transparente que ocupa todo el espacio para poder cerrar la modal desde cualquier punto */
#modal > td{
   position:fixed;
   top:0px;
   left:0px;
   z-index:1;
   float:left;
   width:100%;
   height:100%;
}
:target{
   display:block!important;
   opacity:1!important;
}
/* Un botón de cerrar para no despistar al usuario */
#modalContent > a{
   position:absolute;
   top:-4px;
   right:-4px;
   color:#00A6B6;
   border-radius:2px;
   background:#fff;
   padding:4px;
}

</style>


  <script type="text/javascript">
        $(document).ready(function(){
          alert("hola");
          $(".con").parentNode.css("background-color:yellow;");
        });
        
       </script>
    <div class="container">

        @include('flash::message')

   <style>
       {
        background-color: yellow;
       }
       </style>




<link type="text/css" rel="stylesheet" href="modal.css" />
<script type="text/javascript" src="jquery-1.2.3.min.js"></script>
<script type="text/javascript" src="modal.js"></script>

<script src="http://code.jquery.com/jquery-latest.js"></script>
 <link href="bootstrap.css" rel="stylesheet">

         <div class="row">
         <a class="btn btn-primary pull-left" style="margin-top: 10px" href="{!! route('proyectos.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp; Agregar Proyecto</a>
         <a class="btn btn-default"   href="proyectoExcel" style="margin-top: 8px; margin-left:40%"data-url="">
               <i class="glyphicon glyphicon-download-alt"></i>
               <span class="hidden-xs floatL l5">Exportar</span>
           </a>

           {!! Form::open(['route' => 'proyectos.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                    {!! Form::select('tipo', ['0'=>'seleccione campo','nombre_contratatista' => 'nombre contratatista','nombre_modalidad'=>'nombre modalidad','fecha_radicacion'=>'fecha radicacion', 'nombre_tipoContratacion'=>'tipo Contratacion'], null, ['class' => 'form-control'])!!}
                </div>
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
           <!-- <h1 class="pull-left">Proyectos</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('proyectos.create') !!}">Agregar Nuevo</a>
           -->
        </div>
        <div class="row">
            @if($proyectos->isEmpty())
                <div class="well text-center">No hay proyectos.</div>
            @else
                <table class="table">
                    <thead>
                    <th class="con">Fecha Radicacion</th>
			<th>Nombre Contratatista</th>
			<th>Nombre Modalidad</th>
			<th>Tipo Contratacion</th>
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($proyectos as $proyecto)
                        <tr>


 <div class="modal fade bs-example-modal-lg" id="PlaceModal-{!! $proyecto->fecha_radicacion !!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="ok" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> {!! $proyecto->fecha_radicacion !!}</h4>
        </div>
      </div>
      
    </div>
  </div>

 <a href="#PlaceModal-{{$proyecto->fecha_radicacion}}" id="{!!$proyecto->fecha_radicacion !!}" class="btn">pincha aqui</a>
           <script type="text/javascript">
            $(document).ready(function(){
           $(".close").click(function(){
           $("#ok").modal('close');
            });
          });
          </script>          


         <td>{!! $proyecto->fecha_radicacion !!}</td>
					<td>{!! $proyecto->nombre_contratatista !!}</td>
					<td>{!! $proyecto->nombre_modalidad !!}</td>
					<td>{!! $proyecto->nombre_tipoContratacion !!}</td>
                            <td>
                                <a href="{!! route('proyectos.edit', [$proyecto->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('proyectos.delete', [$proyecto->id]) !!}" onclick="return confirm('Are you sure wants to delete this proyecto?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>



                            
         @endforeach
                    <td> 
                         {!! $proyectos->appends(Request::only(['name','tipo']))->render()!!} 
                    </tbody>
                </table>
            @endif
        </div>
    </div>

   
@endsection