@extends('layouts.app')

@section('title', "Create Article with Tag $tag->name")

@section('content')
    <form class="form-control" action="{{route('tags.articles.store', $tag)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Why Uzbekistan Sucks?">
            @error('title')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Uzbekistan - country of free people with..." style="height: 200px"></textarea>
            @error('description')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Select Category</label>
            <select class="form-select mb-3 @error('category_id') is-invalid @enderror" name="category_id">
                @forelse($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @empty
                    <option selected disabled>No comments yet</option>
                @endforelse
            </select>
            @error('category_id')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input class="form-control @error('image') is-invalid @enderror" name="image" type="file">
            @error('image')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary"> Create Article </button>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $('#multiple-select-custom-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            tags: true
        });
    </script>
@endsection
