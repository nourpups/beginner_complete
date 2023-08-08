@extends('layouts.app')

@section('title', 'Cabinet')
@section('content')

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('articles.index')}}" class="text-success">
                    <div class="lead">Articles</div>
                    </a>
                    <h2 class="card-title">{{$totalArticles}}</h2>
                    <a href="{{route('articles.create')}}" class="btn btn-primary">Create Article</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('categories.index')}}" class="text-success">
                        <div class="lead">Categories</div>
                    </a>
                    <h2 class="card-title">{{$totalCategories}}</h2>
                    <a href="{{route('categories.create')}}" class="btn btn-primary">Create Category</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('tags.index')}}" class="text-success">
                        <div class="lead">Tags</div>
                    </a>
                    <h2 class="card-title">{{$totalTags}}</h2>
                    <a href="{{route('tags.create')}}" class="btn btn-primary">Create Tag</a>
                </div>
            </div>
        </div>
    </div>

@endsection

