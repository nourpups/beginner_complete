@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
    <form class="form-control" action="{{route('tags.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="e.g mylifemyrules">
            @error('name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary"> Create Tag </button>
        </div>
    </form>
@endsection

