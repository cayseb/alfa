<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resource\NewsResource;
use App\Models\News;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetNewsAction
{
    public function __invoke(): AnonymousResourceCollection
    {
        return NewsResource::collection(
            News::query()
                ->select('id','name','published_at','img_path','slug')
                ->orderByDesc('published_at')
                ->where('published', true)
                ->get()
        );
    }
}
