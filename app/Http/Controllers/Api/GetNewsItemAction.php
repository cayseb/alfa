<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resource\NewsItemResource;
use App\Models\News;

class GetNewsItemAction
{
    public function __invoke(News $news): NewsItemResource
    {
        return new NewsItemResource(News::whereSlug($news->slug)->first());
    }
}
