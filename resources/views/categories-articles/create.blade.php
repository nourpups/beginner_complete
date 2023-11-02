@extends('layouts.app')

@section('title', "Create Article with Category $category->name")

@section('content')
    <form class="form-control" action="{{route('categories.articles.store', $category)}}" method="POST" enctype="multipart/form-data">
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
            <label>Create or Select Tags</label>
            <select class="form-select @error('tag_ids') is-invalid @enderror" name="tag_ids[]" id="multiple-select-custom-field" data-placeholder="Select tags or create them by writing and selecting" multiple>
                @forelse($tags as $tag)
                    <option value="{{$tag->name}}">{{$tag->name}}</option>
                @empty
                    <option disabled>No saved tags, create them by writing and selecting</option>
                @endforelse
            </select>
            @error('tag_ids')
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
