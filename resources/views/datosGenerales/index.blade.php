@extends('app')

@section('content')

    <div class="container">
         <ul class="nav nav-tabs">
          <li role="presentation"><a href="{!! asset('formatolistas')!!}">Nombre Formato</a></li>
          <li role="presentation" class="active"><a href="{!! asset('datosGenerales')!!}">Datos Generales</a></li>
          <li role="presentation"><a href="{!! asset('formatoLegalizacions')!!}">Datos Legalizacion</a></li>
        </ul>
        @include('flash::message')

        <div class="row">
            <a class="btn btn-primary pull-left" style="margin-top: 10px"href="{!! route('datosGenerales.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregrar Datos generales</a>
             {!! Form::open(['route' => 'datosGenerales.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                    {!! Form::select('tipo', ['0'=>'seleccione campo','nombre_dato' => 'nombre Dato','formatolistas.nombre_formato'=>'formato lista'], null, ['class' => 'form-control'])!!}
                </div>
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
        </div>
        <div class="row">
            @if($datosGenerales->isEmpty())
                <div class="well text-center">No datosGenerales found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Nombre Dato</th>
			<th>Formato Lista </th>
			
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($datosGenerales as $datoGeneral)
                        <tr>
                            <td>{!! $datoGeneral->nombre_dato !!}</td>
					<td>{!! $datoGeneral->lista->nombre_formato !!}</td>
                            <td>
                                <a href="{!! route('datosGenerales.edit', [$datoGeneral->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('datosGenerales.delete', [$datoGeneral->id]) !!}" onclick="return confirm('Are you sure wants to delete this datosGenerales?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach

            <td> 
                      {!! $datosGenerales->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection