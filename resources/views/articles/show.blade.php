@extends('layouts.app')

@section('title')
    {{ $article->title }}
@stop

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
        </div>
    @endif
    <div class="article_title">{{ $article->title }} by {{ $article->user->name }}</div>
    @can('modify' , $article)
    <a href="{{ route('articles.edit' , $article->id) }}" class="btn btn-warning">Edit</a>

    {!! Form::open(['route' => ['articles.destroy' , $article->id], 'method' => 'delete', 'class' => 'form_delete']) !!}

    {!! Form::submit('Delete', ['class' => 'btn btn-danger confirm', 'data-confirm' => 'Are you sure you want to delete?']) !!}

    {!! Form::close() !!}

    @endcan

    <hr>
    <article>
        {{ $article->body }}
    </article>
    @unless($article->tags->isEmpty())
        <h5>Tags:</h5>
        <ul>
            @foreach($article->tags as $tag)
                <li> {{ $tag->name }} </li>
            @endforeach
        </ul>
    @endunless
@stop

@section('comment_form')
    @if ($errors->any())
        <ul class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" id="closeAlert">&times;</a>
            @foreach($errors->all() as $error)
                <li> {{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="form-group {{ $errors->has('contents') ? ' has-error' : '' }}">
        {!! Form::open(['route' => ['comments.store' , $article->id], 'method' => 'post']) !!}
        {!! Form::textarea('contents', null, ['class' => 'form-control' , 'rows' => '3' , 'placeholder' => 'Comment here']) !!} <br>
        {!! Form::submit('Post Comment', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@stop
@section('comments')
    @if(count($comments) > 0)
        <h4>Recent Comments</h4>
        @foreach($comments as $comment)
            <strong>{{ $comment->user->name }}</strong> commented ({{ $comment->updated_at->diffForHumans() }})
            @can('modify' , $comment)

            <input type="hidden" id="article" value="{{$article->id}}">
            <input type="hidden" id="comment" value="{{$comment->id}}">
            <button id="updateComment" class="btn btn-warning" onclick="makeEditable({{$comment->id}})">Edit</button>
            <button id="deleteComment" class="btn btn-danger" onclick="deleteComment({{ $comment->id }})">Delete</button>
            @endif <br>
            <div id="commentcontents-{{$comment->id}}" onkeypress="updateContents(event ,{{ $comment->id }}  , this.innerHTML)">{!! nl2br($comment->contents) !!}</div>
            <hr>
        @endforeach
        @endcan
@stop
