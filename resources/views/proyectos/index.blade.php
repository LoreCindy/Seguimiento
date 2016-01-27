@extends('app')

@section('content')

        @include('flash::message')
<script src="{{asset('js/confirm-bootstrap.js')}}"></script>
<script src="{{asset('js/seleccionarVariosDelete.js')}}"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
         <div class="row">
         <a class="btn btn-primary pull-left" style="margin-top: 10px" href="{!! route('proyectos.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp; Agregar Proyecto</a>
         <a class="btn btn-primary pull-left"  href="proyectoExcel" style="margin-top:10px; margin-left:5px"data-url="">
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
             {!! Form::open(['route' => 'deleteProyectos', 'method' => 'get']) !!}
                <table class="table table-bordered table-hover">
                    <thead>
            <th><input type="checkbox" id="checkTodos"/><button  id="btn" class="btn btn-link" type="submit" onclick="return confirm('esta usted seguro que desea eliminar?')"><i class="glyphicon glyphicon-trash"></i> <span class="hidden-xs floatL l5">Eliminar</span></button> </th>
            <th>N°</th>
            <th class="con">Fecha Radicacion</th>
            <th>Numero Contrato</th>
			<th>Nombre Contratatista</th>
            <th>Dependencia de Origen</th>
			<th>Nombre Modalidad</th>
			<th>Tipo Contratacion</th>
            <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                    @foreach($proyectos as $key => $proyecto)
                        <tr>
                    <td>
                    <input type="checkbox" class="proyectoEliminar" id="proyectoEliminar_{!! $key !!}" name="proyectoEliminar[]" value="{!! $proyecto->id !!}">
                    </td>
                     <td>{!! $proyecto->id !!}</td>
                    <td>{!! $proyecto->fecha_radicacion !!}</td>
                     <td>{!! $proyecto->numero_contrato !!}</td>                    
					<td>{!! $proyecto->nombre_contratatista !!}</td>
                     <td>{!! $proyecto->dependencia_origen !!}</td>                    
					<td>{!! $proyecto->nombre_modalidad !!}</td>
					<td>{!! $proyecto->nombre_tipoContratacion !!}</td>
                            <td>
                                <a href="{!! route('proyectos.edit', [$proyecto->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href"{!! route('proyectos.delete', [$proyecto->id]) !!}" id="confirm" onclick="return confirm('Are you sure wants to delete this FormatoLegalizacion?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                 @endforeach
                    <td> 
                         {!! $proyectos->appends(Request::only(['name','tipo']))->render()!!} 
                    </tbody>
                </table>
                {!! Form::close() !!}
            @endif
        </div>


<script type="text/javascript">
  $(document).ready(function(){
     $('#confirm').confirmModal();
  });
 

</script>

@endsection