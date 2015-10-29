@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')
       
    

        <div class="row">
             <a class="btn btn-primary pull-left" style="margin-top: 10px" href="{!! route('revisions.create') !!}"><i class="glyphicon glyphicon-plus"></i> &nbsp;Agregar Revisión</a>
           
            <a class="btn btn-default"   href="revisionExcel" style="margin-top: 8px; margin-left:40%"data-url="">
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
				
					<td  class="con">{!! $revision->proyecto->nombre_contratatista !!}</td>
					<td>{!! $revision->formato->nombre_formato !!}</td>
					<td>{!! $revision->observaciones !!}</td>
          <td></td>
          <td></td>
				
                              
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
        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    </div>
@endsection