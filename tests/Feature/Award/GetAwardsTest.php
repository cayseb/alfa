<?php

declare(strict_types=1);

namespace Award;

use App\Models\Award;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAwardsTest extends TestCase
{
    use RefreshDatabase;
    public function test_awards_index()
    {
        $award1 = Award::factory()->create();
        $award2 = Award::factory()->create();
        $award3 = Award::factory()->create();
        $award4 = Award::factory()->create();

        $route = route('award.index');
        $response = $this->getJson($route);

        $response
            ->assertJsonCount(4, 'data')
            ->assertJsonStructure(['data'=>[['id','name','year']]])
            ->assertJsonPath('data.0.id',$award1->id)
            ->assertJsonPath('data.0.name',$award1->name)
            ->assertJsonPath('data.0.year',$award1->year)
            ->assertJsonPath('data.1.id',$award2->id)
            ->assertJsonPath('data.1.name',$award2->name)
            ->assertJsonPath('data.1.year',$award2->year)
            ->assertJsonPath('data.2.id',$award3->id)
            ->assertJsonPath('data.2.name',$award3->name)
            ->assertJsonPath('data.2.year',$award3->year)
            ->assertJsonPath('data.3.id',$award4->id)
            ->assertJsonPath('data.3.name',$award4->name)
            ->assertJsonPath('data.3.year',$award4->year)
            ->assertStatus(200);
    }
}
