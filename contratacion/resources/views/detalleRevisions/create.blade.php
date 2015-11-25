@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'detalleRevisions.store']) !!}

        @include('detalleRevisions.fields')

    {!! Form::close() !!}
</div>
@endsection
