@extends('layouts.app')

@section('title', "Edit $tag->name")

@section('content')
    <form class="form-control" action="{{route('tags.update', $tag)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $tag->name)}}"  placeholder="e.g mylifemyrules" />
            @error('name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary"> Update Tag </button>
        </div>
    </form>
@endsection
