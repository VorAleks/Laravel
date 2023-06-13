<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccessCategoriesList(): void
    {
        $response = $this->get( route('categories.index'));

        $response->assertStatus(200);
    }

    public function testSuccessView(): void
    {
        $this->get(route('categories.index'))
            ->assertViewIs('categories.index');

        $this->get(route('categories.show', ['id'=> 1]))
            ->assertViewIs('news.index');
    }

    public function testSuccessInputData(): void
    {
        $this->get(route('categories.index'))
            ->assertViewHas('categories');

        $this->get(route('categories.show', ['id' => 1]))
            ->assertViewHasAll(['news', 'categories']);
    }
}
