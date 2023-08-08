@extends('layouts.app')

@section('title', "$category->name articles")

@section('content')
    <a href="{{route('categories.articles.create', $category)}}" class="btn btn-success mb-2">Add Articles</a>
    <div class="row">
        @forelse($articles as $article)
            @include('partials.card')
        @empty
            @include('partials.empty-page', ['value' => "$category->name articles"])
        @endforelse
    </div>
@endsection
