@extends('layouts.app')

@section('title', "Edit $category->name")

@section('content')

    <form class="form-control" action="{{route('categories.update', $category)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $category->name)}}"  placeholder="e.g Lifehacks" />
            @error('name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary"> Update Category </button>
        </div>
    </form>
@endsection
