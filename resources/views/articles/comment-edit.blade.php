@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post">
            @csrf
            <div class="mb-2">
                <input type="text" name="content" class="form-control" value="{{ $comment->content }}" />
            </div>

            <button class="btn btn-secondary">
                Update Comment
            </button>
        </form>
    </div>
@endsection
