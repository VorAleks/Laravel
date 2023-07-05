<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\News;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index (NewsQueryBuilder $newsQueryBuilder, CategoriesQueryBuilder $categoriesQueryBuilder): View
    {
        return view('news.index', [
            'news' => $newsQueryBuilder->getActiveNews(),
            'categories' => $categoriesQueryBuilder->getAll()
        ]);
    }

    public function show (News $news): View
    {
        return view('news.show', ['newsItem' => $news]);
    }

}
