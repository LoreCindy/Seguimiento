@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($datosGenerales, ['route' => ['datosGenerales.update', $datosGenerales->id], 'method' => 'patch']) !!}

        @include('datosGenerales.fields')

    {!! Form::close() !!}
</div>
@endsection
