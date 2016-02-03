@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($proyecto, ['route' => ['proyectos.update', $proyecto->id], 'method' => 'patch']) !!}

        @include('proyectos.editarField')

    {!! Form::close() !!}
</div>
@endsection
