<div class="col-4 py-2">

    <div class="card h-100">
        <img class="card-img-top" height="300" style="object-fit: cover" src="{{$article->getImage()}}" alt="Card image cap">
        <div class="card-body">
            @if(!Route::is('main'))
                    <h5 class="card-title">{{str($article->title)->words(5, '...')}}</h5>
                @else
                <a class="stretched-link" href="{{route("$routeName.show", $article)}}">
                    <h5 class="card-title">{{str($article->title)->words(5, '...')}}</h5>
                </a>
            @endif
            <h5 class="text-muted">Category: {{$article->category->name}}</h5>
            <p class="card-text">{{str($article->description)->words(10, '...')}}</p>
            <p class="card-text">
                @forelse($article->tags as $articleTag)
                    <small  class="text-muted {{ (isset($tag)) ? ($tag->name == $articleTag->name ? 'mark' : '') : ''}}">#{{$articleTag->name}} </small>
                @empty
                    no tags
                @endforelse
            </p>
            <p class="card-text">{{$article->user->name}} <small class="text-muted float-end">{{$article->created_at}}</small></p>
        </div>
        @if(!Route::is('main'))
            <div class="card-footer d-flex justify-content-between">
                <a href="{{route('articles.edit', $article)}}" class="btn btn-warning">Edit</a>
                <form class="d-inline-block" action="{{route('articles.destroy', $article)}}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        @endif
    </div>

</div>
