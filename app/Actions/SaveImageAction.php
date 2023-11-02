<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

class SaveImageAction
{
    public function __invoke(string $name, $imageData)
    {
        $newImage = null;
        $oldImage = null;

        if (is_array($imageData)) {
            $newImage = $imageData['new_image'];
            $oldImage = $imageData['old_image'];
        } else {
            $newImage = $imageData;
        }

        if (is_null($newImage)) {
            return $oldImage;
        }

        if (! is_null($oldImage)) {
            Storage::delete($oldImage);
        }

        $fileName = $name.'_'.time().'.'.$newImage->extension();

        return $newImage->storeAs('articles', $fileName);
    }
}
