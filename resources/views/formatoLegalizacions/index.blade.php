@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">FormatoLegalizacions</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('formatoLegalizacions.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($formatoLegalizacions->isEmpty())
                <div class="well text-center">No FormatoLegalizacions found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Nombredato</th>
			<th>Formatolista Id</th>
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($formatoLegalizacions as $formatoLegalizacion)
                        <tr>
                            <td>{!! $formatoLegalizacion->nombreDato !!}</td>
					<td>{!! $formatoLegalizacion->formatoLista_id !!}</td>
                            <td>
                                <a href="{!! route('formatoLegalizacions.edit', [$formatoLegalizacion->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('formatoLegalizacions.delete', [$formatoLegalizacion->id]) !!}" onclick="return confirm('Are you sure wants to delete this FormatoLegalizacion?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection