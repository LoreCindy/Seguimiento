@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
         <a class="btn btn-primary pull-left" style="margin-top: 10px" href="{!! route('proyectos.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp; Agregar Proyecto</a>
        

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
                    <th>Fecha Radicacion</th>
			<th>Nombre Contratatista</th>
			<th>Nombre Modalidad</th>
			<th>Tipo Contratacion</th>
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($proyectos as $proyecto)
                        <tr>
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
                         {!! $proyectos->appends(Request::only(['name','tipo']))->render()!!} 
                    </tbody>
                </table>
            @endif
        </div>
    </div>

   
@endsection