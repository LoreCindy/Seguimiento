@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Formato Legalización</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('formatoLegalizacions.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($formatoLegalizacions->isEmpty())
                <div class="well text-center">No FormatoLegalizacions found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Documentos Legalización</th>
			<th>Formato Lista </th>
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($formatoLegalizacions as $formatoLegalizacion)
                        <tr>
                            <td>{!! $formatoLegalizacion->documentos_legalizacion !!}</td>
					       <td>{!! $formatoLegalizacion-> formato->nombre_formato !!}</td>
                            <td>
                                <a href="{!! route('formatoLegalizacions.edit', [$formatoLegalizacion->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('formatoLegalizacions.delete', [$formatoLegalizacion->id]) !!}" onclick="return confirm('Are you sure wants to delete this FormatoLegalizacion?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                     {!! $formatoLegalizacions->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection