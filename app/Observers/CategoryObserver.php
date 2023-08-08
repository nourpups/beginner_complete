<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function created() {
        Cache::forget('latest-categories');
        Cache::forget('categories');
    }

}
