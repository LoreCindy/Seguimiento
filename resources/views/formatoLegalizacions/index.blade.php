@extends('app')

@section('content')

    <ul class="nav nav-tabs">
          <li role="presentation"><a href="{!! asset('formatolistas')!!}">Nombre Formato</a></li>
          <li role="presentation" ><a href="{!! asset('datosGenerales')!!}">Datos Generales</a></li>
          <li role="presentation" class="active"><a href="{!! asset('formatoLegalizacions')!!}">Datos Legalizacion</a></li>
        </ul>
        @include('flash::message')

        <div class="row">
            <a class="btn btn-primary pull-left" style="margin-top: 10px"href="{!! route('formatoLegalizacions.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregar Legalización</a>
             {!! Form::open(['route' => 'formatoLegalizacions.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                    {!! Form::select('tipo', ['0'=>'seleccione campo','documentos_legalizacion' => 'Nombre Documento'], null, ['class' => 'form-control'])!!}
                 </div>
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
        </div>
        <div class="row">
            @if($formatoLegalizacions->isEmpty())
                <div class="well text-center">No FormatoLegalizacions found.</div>
            @else
            {!! Form::open(['route' => 'deleteFormatoLegalizacion', 'method' => 'get']) !!}
                <table class="table">
                    <thead>
                     <th><input type="checkbox" id="checkTodos"/><button  id="btn" class="btn btn-link" type="submit" onclick="return confirm('esta usted seguro que desea eliminar?')"><i class="glyphicon glyphicon-trash"></i> <span class="hidden-xs floatL l5">Eliminar</span></button> </th>
                    <th>Documentos Legalización</th>
			        <th>Formato Lista </th>
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($formatoLegalizacions as $key => $formatoLegalizacion)
                        <tr>
                         <td>
                    <input type="checkbox" class="proyectoEliminar" id="proyectoEliminar_{!! $key !!}" name="eliminar[]" value="{!! $formatoLegalizacion->id !!}">
                    </td>
                            <td>{!! $formatoLegalizacion->documentos_legalizacion !!}</td>
					       <td>{!! $formatoLegalizacion-> formato->nombre_formato !!}</td>
                            <td>
                                <a href="{!! route('formatoLegalizacions.edit', [$formatoLegalizacion->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('formatoLegalizacions.delete', [$formatoLegalizacion->id]) !!}" onclick="return confirm('Are you sure wants to delete this FormatoLegalizacion?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <td> 
                     {!! $formatoLegalizacions->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
            @endif
        </div>

           <script src="{{asset('js/seleccionarVariosDelete.js')}}"></script>

@endsection