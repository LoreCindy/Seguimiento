@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <a class="btn btn-primary pull-left" style="margin-top: 10px"href="{!! route('formatolistas.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp; Agregar Formato Lista</a>


             {!! Form::open(['route' => 'formatolistas.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                    {!! Form::select('tipo', ['0'=>'seleccione campo','nombre_formato' => 'nombre Formato','fecha_formato'=>'Fecha formato'], null, ['class' => 'form-control'])!!}
                </div>
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
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
                    <td> 
                      {!! $formatolistas->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection