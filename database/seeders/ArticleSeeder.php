<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $tags = Tag::get();

      $articles = Article::factory()
            ->count(15)
            ->create()
            ->each(function ($article) use ($tags) {
               $article->tags()->attach($tags->random(rand(2,5))->pluck('id'));
               // attach random tags between 2 and 5 (count)
            });
   }

}
