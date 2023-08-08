@extends('layouts.app')

@section('title', 'Edit Article')

@section('content')
    <form class="form-control" action="{{route('articles.update', $article)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{old('title', $article->title)}}" class="form-control @error('title') is-invalid @enderror" placeholder="Why Uzbekistan Sucks?">
            @error('title')
           <div class="alert alert-danger"> {{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea class="form-control" name="description" placeholder="Uzbekistan - country of free people with..." style="height: 200px">{{old('description', $article->description)}}</textarea>
            @error('description')
            <div class="alert alert-danger"> {{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Create or Select Tags</label>
            <select class="form-select" name="tag_ids[]" id="multiple-select-custom-field" data-placeholder="Select tags or create them by writing and selecting" multiple>
                @forelse($tags as $tag)
                    <option @foreach(old('tag_ids', $article->tags->pluck('name')->all()) as $selected) {{$tag->name == $selected ? 'selected' : '' }} @endforeach value="{{$tag->name}}">{{$tag->name}}</option>
                @empty
                    <option disabled>No saved tags, create them by writing and selecting</option>
                @endforelse
            </select>
            @error('tag_ids')
            <div class="alert alert-danger"> {{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Select Category</label>
            <select class="form-select mb-3" name="category_id">
                @forelse($categories as $category)
                    <option {{$article->category == $category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                @empty
                    <option selected disabled>No comments yet</option>
                @endforelse
            </select>
            @error('category_id')
            <div class="alert alert-danger"> {{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input class="form-control" name="image" type="file">
            @error('image')
            <div class="alert alert-danger"> {{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary"> Edit Article </button>
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
