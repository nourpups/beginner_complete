<?php

namespace App\Actions;

use App\Models\Tag;

class ToBeAttachedTagsAction
{
    public function __invoke(array $tagNames): array
    {
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tagIds[] = Tag::firstOrCreate(['name' => $tagName])['id'];
        }

        return $tagIds;
    }
}
