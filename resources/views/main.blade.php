@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    <div class="row">
        @forelse($articles as $article)
            @include('partials.card', ['routeName' => 'articles'])
        @empty
            @include('partials.empty-page', ['value' => 'Articles'])
        @endforelse
    </div>
@endsection
