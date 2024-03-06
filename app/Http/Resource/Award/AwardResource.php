<?php

declare(strict_types=1);

namespace App\Http\Resource\Award;

use Illuminate\Http\Resources\Json\JsonResource;

class AwardResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'year' => $this->year,
        ];
    }
}
