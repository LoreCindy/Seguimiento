@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Detalle Revisión</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('detalleRevisions.create') !!}">Add New</a>
        </div>


        <div class="row">
            @if($detalleRevisions->isEmpty())
                <div class="well text-center">No detalleRevisions found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Estado</th>
			<th>Fecha</th>
			<th>Nombre Responsable</th>
			<th>Dependencia Responsable</th>
			<th>Revisión</th>
			                 <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($detalleRevisions as $detalleRevision)
                        <tr>
                            <td>{!! $detalleRevision->estado !!}</td>
					<td>{!! $detalleRevision->fecha !!}</td>
					<td>{!! $detalleRevision->nombre_responsable !!}</td>
					<td>{!! $detalleRevision->dependencia_responsable !!}</td>
					<td>{!! $detalleRevision->revision->nombre_revision !!}</td>
					
                            <td>
                                <a href="{!! route('detalleRevisions.edit', [$detalleRevision->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('detalleRevisions.delete', [$detalleRevision->id]) !!}" onclick="return confirm('Are you sure wants to delete this detalleRevision?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                     {!! $detalleRevisions->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection