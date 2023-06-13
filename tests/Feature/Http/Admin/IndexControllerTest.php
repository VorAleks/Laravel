<?php

namespace Tests\Feature\Http\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccessIndexPage(): void
    {
        $response = $this->get( route('admin.index'));

        $response->assertStatus(200);
    }

    public function testTextOnPage(): void
    {
        $text = 'Точка входа для Админа';
        $this->get(route('admin.index'))
            ->assertOk()
            ->assertSeeText($text);
    }

    public function testSuccessView(): void
    {
        $response = $this->get( route('admin.index'));

        $response->assertViewIs('admin.index');
    }
}
