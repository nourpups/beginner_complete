<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TagArticleController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('main');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('dashboard');

Route::resource('articles', ArticleController::class)->scoped([
    'article' => 'slug',
]);
Route::resources([
    'categories' => CategoryController::class,
    'tags' => TagController::class,
]);
Route::resource('categories.articles', CategoryArticleController::class)->scoped([
    'article' => 'slug',
    'category' => 'name',
])->shallow()->only('index', 'create', 'store');
Route::resource('tags.articles', TagArticleController::class)->scoped([
    'article' => 'slug',
    'tag' => 'name',
])->shallow()->only('index', 'create', 'store');
