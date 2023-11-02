<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       $user_id = User::find(1);
       $category_id = Category::inRandomOrder()->first()->id;

       $title = fake()->sentence();
       $slug = str($title)->slug();

//       $image = fake()->image(
//             dir: storage_path('app/public/articles'),
//             width: 250,
//             height: 300,
//             fullPath: false
//       );
//       $image = 'articles/'.$image;

        return [
            'user_id' => $user_id,
            'category_id' => $category_id,
            'title' => $title,
            'slug' => $slug,
            'description' => fake()->sentences(asText: true),
            'image' => null
        ];
    }
}
