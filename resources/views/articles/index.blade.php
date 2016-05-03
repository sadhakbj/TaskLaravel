@extends('layouts.app')

@section('title')
    Welcome to index page.
@stop

@section('content')
    <h1>You can see the posts of all your friends here.</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
        </div>
    @endif
    @if(count($articles) >0)
        @foreach($articles as $key => $article)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key+1}}"><strong>{{ $article->title }}</strong> by {{ $article->user->name }}
                            ({{ $article->updated_at->diffForHumans() }})</a>
                    </h4>
                </div>
                <div id="collapse{{ $key+1 }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        {{ $article->body }}
                        <a href="{{ route('articles.show' , $article->id) }}">See More...</a>
                    </div>
                </div>
            </div>

        @endforeach
    @endif

    @if ($articles->lastPage() > 1)
        <ul class="pagination">
            <li class="{{ ($articles->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $articles->url(1) }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $articles->lastPage(); $i++)
                <li class="{{ ($articles->currentPage() == $i) ? ' active' : '' }}">
                    <a href="{{ $articles->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="{{ ($articles->currentPage() == $articles->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $articles->url($articles->currentPage()+1) }}">Next</a>
            </li>
        </ul>
        <ul>
            <li style="list-style: none">Showing {{ $articles->count() }} of {{ $articles->total() }} articles.</li>
        </ul>
    @endif


@stop