@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($formatoLegalizacion, ['route' => ['formatoLegalizacions.update', $formatoLegalizacion->id], 'method' => 'patch']) !!}

        @include('formatoLegalizacions.fields')

    {!! Form::close() !!}
</div>
@endsection
