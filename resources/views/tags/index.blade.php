@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <a href="{{route('tags.create')}}" class="btn btn-success mb-2">Add Tag</a>
    <table class="table table-light">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th style="width: 30%">Actions</th>
            </tr>
        </thead>
        <tbody>
           @forelse($tags as $tag)
               <tr>
                   <td>{{$tag->id}}</td>
                   <td>{{$tag->name}}</td>
                   <td>
                       <a href="{{route('tags.articles.index', $tag)}}" class="btn btn-info">Posts</a>
                       <a href="{{route('tags.edit', $tag)}}" class="btn btn-warning">Edit</a>
                       <form class="d-inline-block" action="{{route('tags.destroy', $tag)}}" method="POST">
                           @csrf @method('DELETE')
                           <button class="btn btn-danger">Delete</button>
                       </form>
                   </td>
               </tr>
           @empty
              <tr>
                  <td colspan="3"> @include('partials.empty-page', ['value' => 'Tags']) </td>
              </tr>
           @endforelse
        </tbody>
    </table>
@endsection
