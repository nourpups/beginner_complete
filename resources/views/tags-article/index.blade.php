@extends('layouts.app')

@section('title', "#$tag->name articles")

@section('content')
    <a href="{{route('tags.articles.create', $tag)}}" class="btn btn-success mb-2">Add Articles</a>
    <div class="row">
        @forelse($articles as $article)
            @include('partials.card')
        @empty
            @include('partials.empty-page', ['value' => "$tag->name articles"])
        @endforelse
    </div>
@endsection
