<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Award;

use App\Http\Resource\Award\AwardResource;
use App\Models\Award;

class GetAwardsAction
{
    public function __invoke()
    {
        return AwardResource::collection(
            Award::orderBy('order')->get()
        );
    }
}
