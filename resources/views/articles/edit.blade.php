@extends('layouts.app')

@section('content')
    <div class="container mt-4" style="max-width:800px;">

        <h2 class="mb-3">Edit here</h2>
        <form method="post">
            @csrf
            <div class="mb-2">
                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $title }}" />
            </div>

            <div class="mb-2">
                <textarea name="body" class="form-control" placeholder="Body">{{ $body }}</textarea>
            </div>

            {{-- <span hidden class="categoryId">{{ $category_id }}</span> --}}

            <div class="mb-2">
                <select name="category_id" class="form-select">
                    {{-- <option value="1" id="news">News</option>
                    <option value="2" id="tech">Tech</option>
                    <option value="3" id="global">Global</option>
                    <option value="4" id="language">Language</option>
                    <option value="5" id="general">General</option> --}}

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" class="options"
                            @if ($category_id == $category->id) selected @endif>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary mt-2 px-3">Update</button>
        </form>
    </div>
    <script>
        // cat = Number(document.querySelector(".categoryId").textContent);

        // switch (cat) {
        //     case 1:
        //         document.querySelector('#news').setAttribute("selected", "selected");
        //         break;
        //     case 2:
        //         document.querySelector('#tech').setAttribute("selected", "selected");
        //         break;
        //     case 3:
        //         document.querySelector('#global').setAttribute("selected", "selected");
        //         break;
        //     case 4:
        //         document.querySelector('#language').setAttribute("selected", "selected");
        //         break;
        //     case 5:
        //         document.querySelector('#general').setAttribute("selected", "selected");
        //         break;
        // }
    </script>
@endsection
