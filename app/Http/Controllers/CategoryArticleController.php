<?php

namespace App\Http\Controllers;

use App\Actions\SaveArticleGroupAction;
use App\Http\Requests\CategoriesArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        session(['previous_page' => url()->current()]);

        $articles = $category->articles()->with(['user', 'tags', 'category'])->get();

        return view('categories-articles.index', compact('articles', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        $tags = Tag::get();

        return view('categories-articles.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesArticleRequest $request, Category $category, SaveArticleGroupAction $saveArticleGroupAction)
    {
        $data = $request->validated();

        $processedData = $saveArticleGroupAction($data['title'], $data['image'] ?? null, $data['tag_ids']);

        $data = array_merge($data, $processedData);

        $data['category_id'] = $category->id;

        $article = auth()->user()->articles()->create($data);
        $article->tags()->attach($data['tag_ids']);

        if ($article->tags()->exists($data['tag_ids'])) {
            return redirect(route('categories.articles.index', $category))->with('flash', [
                'class' => 'success',
                'message' => "Article $data[title] with Category $category->name was created succesfully",
            ]);
        }

        return redirect(route('categories.articles.index', $category))->with('flash', [
            'class' => 'danger',
            'message' => "Article $data[title] was not created",
        ]);
    }
}
