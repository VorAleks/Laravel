<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccess(): void
    {
        $response = $this->get('/')
            ->assertStatus(200);
    }

    public function testTextOnPage(): void
    {
        $text = 'Добро пожаловать на наш новостной сайт';
        $this->get(route('index'))
             ->assertSeeText($text);
    }
}
