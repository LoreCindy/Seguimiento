@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">proyectos</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('proyectos.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($proyectos->isEmpty())
                <div class="well text-center">No proyectos found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Fecha Radicacion</th>
			<th>Nombre Contratatista</th>
			<th>Nombre Modalidad</th>
			<th>Nombre Tipocontratacion</th>
                    <th width="50px">Action</th>
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
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection