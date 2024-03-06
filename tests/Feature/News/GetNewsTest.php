<?php

declare(strict_types=1);

namespace News;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class GetNewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_index()
    {
        $news1 = News::factory()->create(['published_at'=>Carbon::now()->addDays()]);
        $news2 = News::factory()->create(['published_at'=>Carbon::now()->addDays(2)]);
        $news3 = News::factory()->create(['published_at'=>Carbon::now()->addDays(3)]);
        $news4 = News::factory()->create(['published_at'=>Carbon::now()->addDays(4)]);
        $news5 = News::factory()->create(['published'=>false]);
        $news6 = News::factory()->create(['published'=>false]);

        $route = route('news.index');
        $response = $this->getJson($route);
        $response
            ->assertOk()
            ->assertJsonCount(4, 'data')
            ->assertJsonStructure(['data' => [
                ['id', 'name', 'img_path', 'slug','published_at']
            ]])
            ->assertJsonPath('data.0.id', $news4->id)
            ->assertJsonPath('data.1.id', $news3->id)
            ->assertJsonPath('data.2.id', $news2->id)
            ->assertJsonPath('data.3.id', $news1->id)
            ->assertJsonMissing(['id' => $news5->id])
            ->assertJsonMissing(['id' => $news6->id]);

        $response->assertStatus(200);
    }
}
