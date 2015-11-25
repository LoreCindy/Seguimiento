@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <a class="btn btn-primary pull-left" style="margin-top: 10px"href="{!! route('formatoLegalizacions.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregar Legalización</a>
             {!! Form::open(['route' => 'formatoLegalizacions.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                    {!! Form::select('tipo', ['0'=>'seleccione campo','documentos_legalizacion' => 'Nombre Documento'], null, ['class' => 'form-control'])!!}
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
    
    
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
                    <td> 
                     {!! $formatoLegalizacions->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection