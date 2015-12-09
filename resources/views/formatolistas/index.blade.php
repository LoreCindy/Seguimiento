@extends('app')

@section('content')

     <ul class="nav nav-tabs">
      <li role="presentation"class="active"><a href="{!! asset('formatolistas')!!}">Nombre Formato</a></li>
      @if($formatolistas->isEmpty())
      <li role="presentation"><a class="btn btn-primary btn-lg disabled" href="{!! asset('datosGenerales')!!}">Datos Generales</a></li>
      <li role="presentation"><a class="btn btn-primary btn-lg disabled" href="{!! asset('formatoLegalizacions')!!}">Datos Legalizacion</a></li>
     @else
     <li role="presentation"><a href="{!! asset('datosGenerales')!!}">Datos Generales</a></li>
      <li role="presentation"><a href="{!! asset('formatoLegalizacions')!!}">Datos Legalizacion</a></li>
       @endif
    </ul>
        @include('flash::message')

        <div class="row">
            <a class="btn btn-primary pull-left" style="margin-top: 10px"href="{!! route('formatolistas.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp; Agregar Formato Lista</a>
              
            <a class="btn btn-primary pull-left"  href="formatoExcel" style="margin-top:10px; margin-left:5px" data-url="">
               <i class="glyphicon glyphicon-download-alt"></i>
               <span class="hidden-xs floatL l5">Exportar</span>
           </a>
             {!! Form::open(['route' => 'formatolistas.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                    {!! Form::select('tipo', ['0'=>'seleccione campo','nombre_formato' => 'nombre Formato','fecha_formato'=>'Fecha formato'], null, ['class' => 'form-control'])!!}
                </div>
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
        </div>

        <div class="row">
            @if($formatolistas->isEmpty())
                <div class="well text-center">No formatolistas found.</div>
            @else

             {!! Form::open(['route' => 'deleteFormatoLista', 'method' => 'get']) !!}
                <table class="table">
                    <thead>
                     <th><input type="checkbox" id="checkTodos"/><button  id="btn" class="btn btn-link" type="submit" onclick="return confirm('esta usted seguro que desea eliminar?')"><i class="glyphicon glyphicon-trash"></i> <span class="hidden-xs floatL l5">Eliminar</span></button> </th>
                    <th>Nombre Formato</th>
			               <th>Fecha Formato</th>
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($formatolistas as $key => $formatolista)
                        <tr>
                    <td>
                    <input type="checkbox" class="proyectoEliminar" id="proyectoEliminar_{!! $key !!}" name="eliminar[]" value="{!! $formatolista->id !!}">
                    </td>
                            <td>{!! $formatolista->nombre_formato !!}</td>
					                   <td>{!! $formatolista->fecha_formato !!}</td>
                            <td>
                                <a href="{!! route('formatolistas.edit', [$formatolista->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('formatolistas.delete', [$formatolista->id]) !!}" onclick="return confirm('Are you sure wants to delete this formatolista?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <td> 
                      {!! $formatolistas->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
                {!! Form::close() !!}
            @endif
        </div>

        <script src="{{asset('js/seleccionarVariosDelete.js')}}"></script>
  
@endsection