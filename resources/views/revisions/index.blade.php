@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Revisión</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('revisions.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($revisions->isEmpty())
                <div class="well text-center">No revisions found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Nombre Revision</th>

			<th>Contratista </th>
			<th>Formato Lista</th>
			<th>Observaciones</th>
			<th>Datos Generales</th>
			<th>Formato Legalizacion</th>
			<th>Chequeo(Supervisor)</th>
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($revisions as $revision)
                        <tr>
                            <td>{!! $revision->nombre_revision !!}</td>
				
					<td>{!! $revision->proyecto->nombre_contratatista !!}</td>
					<td>{!! $revision->formato->nombre_formato !!}</td>
					<td>{!! $revision->observaciones !!}</td>
					<td>{!! $revision->general->nombre_dato !!}</td>
    				<td>{!! $revision->legalizacion->documentos_legalizacion !!}</td>
					<td>{!! $revision->chequeo->nombre_supervisor!!}</td>

                              
                            <td>
                                <a href="{!! route('revisions.edit', [$revision->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('revisions.delete', [$revision->id]) !!}" onclick="return confirm('Are you sure wants to delete this revision?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                     {!! $revisions->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection