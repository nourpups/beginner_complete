@extends('layouts.app')

@section('title', "")

@section('content')

    <div class="row">
        <div class="col-6 text-end">
            <img class="img-fluid" src="{{$article->getImage()}}" alt="{{$article->title}}">
        </div>
        <div class="col-6">
            <h4 class="card-title">{{str($article->title)->words(5, '...')}}</h4>
            <h5 class="card-text text-muted">Category: {{$article->category->name}}</h5>
            <p class="card-text">{{str($article->description)->words(10, '...')}}</p>
            <p class="card-text">
                @forelse($article->tags as $tag)
                    <small class="text-muted">#{{$tag->name}} </small>
                @empty
                    no tags
                @endforelse
            </p>
            <p class="card-text">{{$article->user->name}} <small class="text-muted float-end">{{$article->created_at}}</small></p>
        </div>
    </div>


@endsection
