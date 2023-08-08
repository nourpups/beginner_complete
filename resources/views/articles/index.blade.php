@extends('layouts.app')

@section('title', 'Articles')

@section('content')

    <a href="{{route('articles.create')}}" class="btn btn-success mb-2">Add Articles</a>
    <div class="row">
        @forelse($articles as $article)
            @include('partials.card', ['routeName' => 'articles'])
        @empty
            @include('partials.empty-page', ['value' => 'Articles'])
        @endforelse
    </div>


@endsection
