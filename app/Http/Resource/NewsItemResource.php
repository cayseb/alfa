<?php

declare(strict_types=1);

namespace App\Http\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name'=>$this->name,
            'published_at'=>$this->published_at,
            'description'=>$this->description,
        ];
    }
}
