<?php

namespace App\Actions;

use Illuminate\Support\Str;

class SaveArticleGroupAction
{
    public function __construct(
        private SaveImageAction $saveImageAction,
        private ToBeAttachedTagsAction $toBeAttachedTagsAction
    ) {
    }

    public function __invoke($name, $images, $tags = null): array
    {
        $slug = Str::slug($name);
        $image = ($this->saveImageAction)($slug, $images);

        $data = [
            'slug' => $slug,
            'image' => $image,
        ];

        if(!is_null($tags))
        {
            $tagIds = ($this->toBeAttachedTagsAction)($tags);
            $data['tag_ids'] = $tagIds;
        }

        return $data;
    }
}
