<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccessCategoriesList(): void
    {
        $response = $this->get( route('news.index'));

        $response->assertStatus(200);
    }

    public function testSuccessView(): void
    {
        $this->get(route('news.index'))
            ->assertViewIs('news.index');

        $this->get(route('news.show', ['id' => 1]))
            ->assertViewIs('news.show');
    }

    public function testSuccessInputData(): void
    {
        $this->get(route('news.index'))
            ->assertViewHasAll(['news', 'categories']);

        $this->get(route('news.show', ['id' => 1]))
            ->assertViewHas('newsItem');
    }
}
