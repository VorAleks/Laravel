<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function getNews(int $id = null): array
    {
        $news = [];
        if ($id === null) {
            for ($j=0; $j <7; $j++) {
                for ($i = 0; $i < 10; $i++) {
                    $news[] = [
                        'id' => $i,
                        'category_id' => $j,
                        'title' => fake()->jobTitle(),
                        'author' => fake()->userName(),
                        'status' => 'draft',
                        'description' => fake()->text(100),
                        'created_at' => now(),
                    ];
                }
            }
            return $news;
        }

        return [
            'id' => $id,
            'category_id' => fake()->numberBetween(1,7),
            'title' => fake()->jobTitle(),
            'author' => fake()->userName(),
            'status' => 'draft',
            'description' => fake()->text(100),
            'created_at' => now(),
        ];
    }

    protected function getCategories(int $id = null): array
    {
        $categories = [];
        if ($id === null) {
            for ($i=0; $i < 7; $i++) {
                $categories[] = [
                    'id' => $i,
                    'title' => fake()->jobTitle(),
                    'status' => 'draft',
                    'created_at' => now(),
                ];
            }

            return $categories;
        }

        return [
            'id' => $id,
            'title' => fake()->jobTitle(),
            'status' => 'draft',
            'created_at' => now(),
        ];
    }

    protected function getNewsByCategory ($id): array
    {
        $news = [];
           for ($i = 0; $i < 10; $i++) {
                    $news[] = [
                        'id' => $i,
                        'category_id' => $id,
                        'title' => fake()->jobTitle(),
                        'author' => fake()->userName(),
                        'status' => 'draft',
                        'description' => fake()->text(100),
                        'created_at' => now(),
                    ];
           }
           return $news;
    }
}
