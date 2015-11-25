@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'students.store']) !!}

        @include('students.fields')

    {!! Form::close() !!}
</div>
@endsection
