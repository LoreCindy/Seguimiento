@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($chequeo, ['route' => ['chequeos.update', $chequeo->id], 'method' => 'patch']) !!}

        @include('chequeos.fields')

    {!! Form::close() !!}
</div>
@endsection
