<?php

declare(strict_types=1);

namespace News;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class GetNewsItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_show()
    {
        $news1 = News::factory()->create(['published_at'=>Carbon::now()->addDays()]);
        $news2 = News::factory()->create(['published_at'=>Carbon::now()->addDays(2)]);

        $route = route('news.show',$news1->slug);
        $response = $this->getJson($route);
        $response->dump();
        $response
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonStructure(['data' => ['name','published_at','description']])
            ->assertJsonFragment(['name'=> $news1->name])
            ->assertJsonFragment(['description'=> $news1->description])
            ->assertJsonFragment(['published_at'=>Carbon::parse($news1->published_at)->format('Y-m-d H:i:s')]);

        $response->assertStatus(200);
    }
}
