@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Formato Listas</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('formatolistas.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($formatolistas->isEmpty())
                <div class="well text-center">No formatolistas found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Nombre Formato</th>
			<th>Fecha Formato</th>
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($formatolistas as $formatolista)
                        <tr>
                            <td>{!! $formatolista->nombre_formato !!}</td>
					<td>{!! $formatolista->fecha_formato !!}</td>
                            <td>
                                <a href="{!! route('formatolistas.edit', [$formatolista->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('formatolistas.delete', [$formatolista->id]) !!}" onclick="return confirm('Are you sure wants to delete this formatolista?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                      {!! $formatolistas->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection