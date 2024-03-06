<?php

declare(strict_types=1);

namespace App\Http\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'img_path'=>$this->img_path,
            'slug'=>$this->slug,
            'published_at'=>$this->published_at,
        ];
    }
}
