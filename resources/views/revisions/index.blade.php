@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')
       

 
        <div class="row">
             <a class="btn btn-primary pull-left" style="margin-top: 10px" href="{!! route('revisions.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregar Revisión</a>

             <a class="btn btn-default"   href="detalleExcel" style="margin-top: 8px; margin-left:41%"data-url="">
               <i class="glyphicon glyphicon-download-alt"></i>
               <span class="hidden-xs floatL l5">Exportar</span>
        </a>
             {!! Form::open(['route' => 'revisions.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group" >
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                    {!! Form::select('tipo', ['0'=>'seleccione campo','nombre_revision' => 'Nombre Revision'], null, ['class' => 'form-control'])!!}
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}




    
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
			<th>Datos Generales</th>
			<th>Formato Legalizacion</th>
			<th>Chequeo(Supervisor)</th>
            <th>Observaciones</th>
                    <th width="50px">Opciones</th>
                    </thead>
                    <tbody>
                     
                    @foreach($revisions as $revision)
                        <tr>
                    <td>{!! $revision->nombre_revision !!}</td>
				
					<td>{!! $revision->proyecto->nombre_contratatista !!}</td>
					<td>{!! $revision->formato->nombre_formato !!}</td>
					<td>{!! $revision->general->nombre_dato !!}</td>
    				<td>{!! $revision->legalizacion->documentos_legalizacion !!}</td>
					<td>{!! $revision->chequeo->nombre_supervisor!!}</td>
                    <td>{!! $revision->observaciones !!}</td>

                              
                            <td>
                                <a href="{!! route('revisions.edit', [$revision->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('revisions.delete', [$revision->id]) !!}" onclick="return confirm('Are you sure wants to delete this revision?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <td> 
                     {!! $revisions->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
            @endif  
        </div>
    </div>
@endsection