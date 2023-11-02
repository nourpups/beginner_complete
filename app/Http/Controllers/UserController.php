<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalArticles = Article::count();
        $totalCategories = Category::count();
        $totalTags = Tag::count();

        return view('dashboard', compact(
            'totalArticles',
            'totalCategories',
            'totalTags'));
    }
}
