@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">chequeos</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('chequeos.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($chequeos->isEmpty())
                <div class="well text-center">No chequeos found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Legalizacion Id</th>
			<th>Legalizacion Id</th>
			<th>Nombre Supervisor</th>
			<th>Dac</th>
			<th>Observaciones</th>
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($chequeos as $chequeo)
                        <tr>
                            <td>{!! $chequeo->legalizacion_id !!}</td>
					<td>{!! $chequeo->legalizacion_id !!}</td>
					<td>{!! $chequeo->nombre_supervisor !!}</td>
					<td>{!! $chequeo->dac !!}</td>
					<td>{!! $chequeo->observaciones !!}</td>
                            <td>
                                <a href="{!! route('chequeos.edit', [$chequeo->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('chequeos.delete', [$chequeo->id]) !!}" onclick="return confirm('Are you sure wants to delete this chequeo?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection