@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($revision, ['route' => ['revisions.update', $revision->id], 'method' => 'patch']) !!}

        @include('revisions.fields')

    {!! Form::close() !!}
</div>
@endsection
