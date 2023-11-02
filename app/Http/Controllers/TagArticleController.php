<?php

namespace App\Http\Controllers;

use App\Actions\SaveArticleGroupAction;
use App\Actions\SaveImageAction;
use App\Http\Requests\TagsArticleRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TagArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tag $tag)
    {
        session(['previous_page' => url()->current()]);
        $articles = $tag->articles()->with('user', 'category')->get();

        return view('tags-article.index', compact('articles', 'tag'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Tag $tag)
    {
        $categories = Category::get();

        return view('tags-article.create', compact('tag', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagsArticleRequest $request, Tag $tag, SaveArticleGroupAction $saveArticleGroupAction)
    {
        $data = $request->validated();

        $processedData = $saveArticleGroupAction($data['title'], $data['image'] ?? null);

        $data = array_merge($data, $processedData);

        $article = auth()->user()->articles()->create($data);
        $article->tags()->attach($tag->id);

        if ($article->tags()->exists($tag->id)) {
            return redirect(route('tags.articles.index', $tag))->with('flash', [
                'class' => 'success',
                'message' => "Article $data[title] with Tag $tag->name was created succesfully",
            ]);
        }

        return redirect(route('tags.articles.index', $tag))->with('flash', [
            'class' => 'danger',
            'message' => "Article $data[title] was not created",
        ]);
    }
}
