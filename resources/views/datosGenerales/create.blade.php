@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'datosGenerales.store']) !!}

        @include('datosGenerales.fields')

    {!! Form::close() !!}
</div>
@endsection
