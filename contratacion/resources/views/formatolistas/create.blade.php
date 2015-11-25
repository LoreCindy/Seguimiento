@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'formatolistas.store']) !!}

        @include('formatolistas.fields')

    {!! Form::close() !!}
</div>
@endsection
