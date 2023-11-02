@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <a href="{{route('categories.create')}}" class="btn btn-success mb-2">Add Category</a>
    <table class="table table-light">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th style="width: 30%">Actions</th>
            </tr>
        </thead>
        <tbody>
           @forelse($categories as $category)
               <tr>
                   <td>{{$category->id}}</td>
                   <td>{{$category->name}}</td>
                   <td>
                       <a href="{{route('categories.articles.index', $category)}}" class="btn btn-info">Posts</a>
                       <a href="{{route('categories.edit', $category)}}" class="btn btn-warning">Edit</a>
                       <form class="d-inline-block" action="{{route('categories.destroy', $category)}}" method="POST">
                           @csrf @method('DELETE')
                           <button class="btn btn-danger">Delete</button>
                       </form>
                   </td>
               </tr>
           @empty
              <tr>
                  <td colspan="3"> @include('partials.empty-page', ['value' => 'Categories']) </td>
              </tr>
           @endforelse
        </tbody>
    </table>
@endsection
