@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">Students</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('students.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($students->isEmpty())
                <div class="well text-center">No Students found.</div>
            @else
                <table class="table">
                    <thead>
                    <th>Nombre</th>
			<th>Apellido</th>
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($students as $student)
                        <tr>
                            <td>{!! $student->nombre !!}</td>
					<td>{!! $student->apellido !!}</td>
                            <td>
                                <a href="{!! route('students.edit', [$student->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('students.delete', [$student->id]) !!}" onclick="return confirm('Are you sure wants to delete this Student?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection