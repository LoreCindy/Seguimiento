@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

     @if (Session::has('message'))

   <div class="alert alert-danger">
	{{Session::get('message')}}
	</div>

  @endif

    {!! Form::open(['route' => 'revisions.store']) !!}

        @include('revisions.fields')

    {!! Form::close() !!}
</div>
@endsection
