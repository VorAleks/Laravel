<?php

namespace Tests\Feature\Http\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccessCategoriesList(): void
    {
        $response = $this->get( route('admin.categories.index'));

        $response->assertStatus(200);
    }


}
