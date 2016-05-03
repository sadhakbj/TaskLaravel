@extends('layouts.app')

@section('title')
    Editing: {{ $article->title }}
@stop

@section('content')
    <h1>Edit {{ $article->title }} </h1>

    {!! Form::model($article, ['route' => ['articles.update', $article->id], 'method' => 'patch']) !!}

    @include('articles.form' , ['submitButtonText' => 'Update Post.'])

    {!! Form::close() !!}
@stop