@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <form class="form-control" action="{{route('categories.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  placeholder="e.g Lifehacks" autofocus />
            @error('name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary"> Create Category </button>
        </div>
    </form>
@endsection
