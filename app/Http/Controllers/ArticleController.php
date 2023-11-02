<?php

namespace App\Http\Controllers;

use App\Actions\SaveArticleGroupAction;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        session(['previous_page' => url()->current()]);
        $articles = Article::with([
            'user',
            'tags',
            'category',
        ])->latest()->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();

        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request, SaveArticleGroupAction $saveArticleGroupAction)
    {
        $data = $request->validated();

        $processedData = $saveArticleGroupAction($data['title'], $data['image'] ?? null, $data['tag_ids']);

        $data = array_merge($data, $processedData);

        $article = auth()->user()->articles()->create($data);
        $article->tags()->attach($data['tag_ids']);

        if ($article->tags()->exists($data['tag_ids'])) {
            return redirect(route('articles.index'))->with('flash', [
                'class' => 'success',
                'message' => "Article $data[title] was created succesfully",
            ]);
        }

        return redirect(route('articles.index'))->with('flash', [
            'class' => 'danger',
            'message' => "Article $data[title] was not created",
        ]);
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        session(['previous_page' => url()->previous()]);

        $categories = Category::get();
        $tags = Tag::get();

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(ArticleRequest $request, Article $article, SaveArticleGroupAction $saveArticleGroupAction)
    {
        $data = $request->validated();

        $images = [
            'new_image' => $data['image'] ?? null,
            'old_image' => $article->image,
        ];

        $processedData = $saveArticleGroupAction($data['title'], $images, $data['tag_ids']);

        $data = array_merge($data, $processedData);

        $oldTitle = $article->title;

        if ($article->update($data) && $article->tags()->sync($data['tag_ids'])) {
            return redirect(session('previous_page'))->with('flash', [
                'class' => 'success',
                'message' => "Article $oldTitle was updated to $data[title] succesfully",
            ]);
        }

        return redirect(session('previous_page'))->with('danger', [
            'class' => 'warning',
            'message' => "Article $oldTitle was not updated",
        ]);
    }

    public function destroy(Article $article)
    {
        $title = $article->title;
        if (! is_null($article->image)) {
            Storage::delete($article->image);
        }
        $article->delete();

        if (Article::where('title', $title)->exists()) {
            return redirect(session('previous_page'))->with('warning', [
                'class' => 'warning',
                'message' => "Article $title was not deleted",
            ]);
        }

        return redirect(session('previous_page'))->with('flash', [
            'class' => 'danger',
            'message' => "Article $title was deleted",
        ]);
    }
}
