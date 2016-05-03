@extends('layouts.app')

@section('title')
    Create a new article here.
@stop

@section('content')

    @if ($errors->any())
        <ul class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @foreach($errors->all() as $error)
                <li> {{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h3>Create a new blog post.</h3>
    {!! Form::open(['route' => 'articles.store', 'method' => 'post' ]) !!}

    @include('articles.form' , ['submitButtonText' => 'Create a new post.'])

    {!! Form::close() !!}
@stop