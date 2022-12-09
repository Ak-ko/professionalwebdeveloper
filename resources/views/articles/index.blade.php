@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        {{ $articles->links() }}
        <h1>Articles</h1>
        @foreach ($articles as $article)
            <div class="card my-3">
                <div class="card-body">
                    <div class="card-title">
                        <h3>{{ $article->title }}</h3>
                    </div>
                    <small class="text-muted">
                        <span class="text-success fw-bold">{{ $article->user->name }}</span>,
                        {{ $article->created_at->diffForHumans() }},
                        {{-- Category: {{ $article->category()->first()->name }} --}}
                        Category: {{ $article->category->name }},
                        <a href='{{ url("/articles/details/$article->id#commentsection") }}'>{{ count($article->comments) }}
                            Comment(s)</a>
                    </small>
                    <div>
                        {{ $article->body }}
                    </div>
                    <a href="{{ url("/articles/details/$article->id") }}">View details...</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
