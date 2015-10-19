@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <a class="btn btn-primary pull-left" style="margin-top: 10px"href="{!! route('chequeos.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregar Chequeo</a>
             <a class="btn btn-default"   href="chequeosExcel" style="margin-top: 8px; margin-left:40%"data-url="">
               <i class="glyphicon glyphicon-download-alt"></i>
               <span class="hidden-xs floatL l5">Exportar</span>
           </a>
            {!! Form::open(['route' => 'chequeos.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                    {!! Form::select('tipo', ['0'=>'seleccione campo','nombre_supervisor' => 'Nombre supervisor', 'dac' => 'DAC'], null, ['class' => 'form-control'])!!}
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
       
    
        </div>

        <div class="row">
            @if($chequeos->isEmpty())
                <div class="well text-center">No chequeos found.</div>
            @else
                <table class="table">
                    <thead>
                    
			<th>Formato Legalización</th>
			<th>Nombre Supervisor</th>
			<th>DAC</th>
			<th>Observaciones</th>
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($chequeos as $chequeo)
                        <tr>
                       
					<td>{!! $chequeo->legalizacion->documentos_legalizacion !!}</td>
					<td>{!! $chequeo->nombre_supervisor !!}</td>
					<td>{!! $chequeo->dac !!}</td>
					<td>{!! $chequeo->observaciones !!}</td>
                            <td>
                                <a href="{!! route('chequeos.edit', [$chequeo->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('chequeos.delete', [$chequeo->id]) !!}" onclick="return confirm('Are you sure wants to delete this chequeo?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <td> 
                    {!! $chequeos->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection