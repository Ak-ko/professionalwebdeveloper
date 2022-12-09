@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- For Comments -->
        @if (session('edit'))
            <div class="alert alert-info">
                {{ session('edit') }}
            </div>
        @endif
        <div class="card my-3">
            <div class="card-body border-1 border-success">
                <div class="card-title">
                    <h3>{{ $article->title }}</h3>
                </div>
                <small class="text-muted">
                    <span class="text-success fw-bold">{{ $article->user->name }}</span>,
                    {{ $article->created_at->diffForHumans() }},
                    Category: <span class="text-danger">{{ $article->category->name }}</span>
                </small>
                <div>
                    {{ $article->body }}
                </div>

                @auth
                    @can('article-delete', $article)
                        <a href='{{ url("articles/delete/$article->id") }}' class="btn btn-light btn-sm mt-2 text-danger fw-bold">
                            Delete
                        </a>
                        <a href='{{ url("/articles/details/edit/$article->id") }}'
                            class="btn btn-outline-success btn-sm ms-1 mt-2">Edit</a>
                    @endcan
                @endauth
            </div>
        </div>

        <h4 id="commentsection" class="h5 ms-1 mt-5">Comments ({{ count($article->comments) }})</h4>
        <ul class="list-group">
            @foreach ($article->comments as $comment)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <div>
                            <span class="text-success fw-bold">{{ $comment->user->name }}</span>
                            <small class="d-inline-block ms-1 text-muted">
                                @if (session('edit'))
                                    {{ $comment->updated_at->diffForHumans() }}                                    
                                @else
                                    {{ $comment->created_at->diffForHumans() }}
                                @endif
                            </small>
                        </div>
                        <span>
                            {{ $comment->content }}
                        </span>
                    </div>
                    <div class="">
                        @auth
                            @can('comment-edit', $comment)
                                <a href='{{ url("/comments/edit/$comment->id") }}' class="btn btn-sm btn-primary me-2">Edit</a>
                            @endcan
                            @can('comment-delete', $comment)
                                <a href='{{ url("/comments/delete/$comment->id") }}' class="btn btn-close fs-6"></a>
                            @endcan
                        @endauth
                    </div>
                </li>
            @endforeach
        </ul>

        @auth
            <form action="/comments/add" method="post">
                @csrf
                <div class="mb-2">
                    <input type="hidden" name="article_id" value="{{ $article->id }}" class="form-control" />
                </div>

                <div class="mb-2">
                    <textarea name="content" class="form-control" placeholder="Comment..." required></textarea>
                </div>

                <button class="btn btn-secondary ms-1">Add Comment</button>
            </form>
        @endauth
    </div>
@endsection
