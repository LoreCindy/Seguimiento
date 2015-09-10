@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">revisions</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('revisions.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($revisions->isEmpty())
                <div class="well text-center">No revisions found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Nombre Revision</th>
			<th>Proyecto Id</th>
			<th>Proyecto Id</th>
			<th>Formatolista Id</th>
			<th>Formatolista Id</th>
			<th>Observaciones</th>
			<th>Datosgenerales Id</th>
			<th>Datosgenerales Id</th>
			<th>Formatolegalizacion Id</th>
			<th>Formatolegalizacion Id</th>
			<th>Chequeo Id</th>
			<th>Chequeo Id</th>
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($revisions as $revision)
                        <tr>
                            <td>{!! $revision->nombre_revision !!}</td>
					<td>{!! $revision->proyecto_id !!}</td>
					<td>{!! $revision->proyecto_id !!}</td>
					<td>{!! $revision->formatoLista_id !!}</td>
					<td>{!! $revision->formatoLista_id !!}</td>
					<td>{!! $revision->observaciones !!}</td>
					<td>{!! $revision->datosGenerales_id !!}</td>
					<td>{!! $revision->datosGenerales_id !!}</td>
					<td>{!! $revision->formatoLegalizacion_id !!}</td>
					<td>{!! $revision->formatoLegalizacion_id !!}</td>
					<td>{!! $revision->chequeo_id !!}</td>
					<td>{!! $revision->chequeo_id !!}</td>
                            <td>
                                <a href="{!! route('revisions.edit', [$revision->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('revisions.delete', [$revision->id]) !!}" onclick="return confirm('Are you sure wants to delete this revision?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection