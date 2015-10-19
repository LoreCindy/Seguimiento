@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'revisions.store']) !!}

        @include('revisions.fields')

    {!! Form::close() !!}
</div>
@endsection
