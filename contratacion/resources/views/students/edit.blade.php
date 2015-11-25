@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($student, ['route' => ['students.update', $student->id], 'method' => 'patch']) !!}

        @include('students.fields')

    {!! Form::close() !!}
</div>
@endsection
