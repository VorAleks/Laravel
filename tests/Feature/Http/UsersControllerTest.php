<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccessUsersOrder(): void
    {
        $response = $this->get( route('users.order'));

        $response->assertStatus(200);
    }

       public function testSuccessStoreResponse(): void
    {
        $postData =[
            'user_name' => fake()->userName(),
            'user_phone' => fake()->phoneNumber(),
            'user_email' => fake()->email(),
            'user_order' => fake()->text(100),
        ];

        $response = $this->post(route('users.store'), $postData);

        $response->assertStatus(200);
        $response->assertJson($postData);
    }

}
