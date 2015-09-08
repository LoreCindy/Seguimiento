@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'chequeos.store']) !!}

        @include('chequeos.fields')

    {!! Form::close() !!}
</div>
@endsection
