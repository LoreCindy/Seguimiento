@extends('app')

@section('content')

    <div class="container">
        @include('flash::message')

        <div class="row">
         <a class="btn btn-primary pull-left" style="margin-top: 10px" href="{!! route('detalleRevisions.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregar detalles Revisión</a>
            
        <a class="btn btn-default"   href="detalleExcel" style="margin-top: 8px; margin-left:32%"data-url="">
               <i class="glyphicon glyphicon-download-alt"></i>
               <span class="hidden-xs floatL l5">Exportar</span>
        </a>
             {!! Form::open(['route' => 'detalleRevisions.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'busqueda']) !!}
                     {!! Form::select('tipo', ['0'=>'seleccione campo','estado' => 'estado','nombre_responsable' => 'Nombre Responsable', 'dependencia_responsable'=> 'Dependencia Responsable'], null, ['class' => 'form-control'])!!}
                 </div>
                <button type="submit" class="btn search-button t5 btn-primary"><i class="glyphicon glyphicon-search"></i></button>
            {!! Form::close() !!}
       
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
                    @if($detalleRevision->estado=='Recibido')
                       <td> <div style = "color:black ; background-color:blue" > Recibido</div></td>
                    @elseif($detalleRevision->estado=='Devolucion')
                        <td> <div style = "color: black ; background-color:red"> Devolucion </div></td>
                    @else 
                       <td><div style = "color:black ; background-color:whitek"> Aprobado </div></td>
                    @endif

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
                    <td> 
                     {!! $detalleRevisions->appends(Request::only(['name','tipo']))->render()!!}
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection