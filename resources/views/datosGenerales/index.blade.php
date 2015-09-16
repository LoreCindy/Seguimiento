@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Datos Generales</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('datosGenerales.create') !!}">Add New</a>
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
                      {!! $datosGenerales->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection