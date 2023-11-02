<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{

   use HasFactory;

   protected $fillable = [
               'user_id',
               'category_id',
               'slug',
               'title',
               'description',
               'image',
         ];

   public function user(): BelongsTo
   {
      return $this->belongsTo(User::class);
   }

   public function category(): BelongsTo
   {
      return $this->belongsTo(Category::class);
   }

   public function tags(): BelongsToMany
   {
      return $this->belongsToMany(Tag::class);
   }

   public function getImage(): string
   {
      return asset($this->image
               ? 'storage/'.$this->image
               : 'article-default.jfif'
            );
   }

}
