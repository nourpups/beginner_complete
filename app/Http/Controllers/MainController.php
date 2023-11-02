<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
    {
        $articles = Article::with('category', 'user', 'tags')->latest()->get();


        return view('main', compact('articles'));
    }
}
