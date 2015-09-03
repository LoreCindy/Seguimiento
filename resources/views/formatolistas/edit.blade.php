@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($formatolista, ['route' => ['formatolistas.update', $formatolista->id], 'method' => 'patch']) !!}

        @include('formatolistas.fields')

    {!! Form::close() !!}
</div>
@endsection
