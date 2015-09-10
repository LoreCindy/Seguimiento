@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($detalleRevision, ['route' => ['detalleRevisions.update', $detalleRevision->id], 'method' => 'patch']) !!}

        @include('detalleRevisions.fields')

    {!! Form::close() !!}
</div>
@endsection
