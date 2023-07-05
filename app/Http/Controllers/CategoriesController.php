<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\QueryBuilder;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    protected QueryBuilder $categoriesQueryBuilder;

    public function __construct(
        CategoriesQueryBuilder $categoriesQueryBuilder,
    )
    {
        $this->categoriesQueryBuilder = $categoriesQueryBuilder;
    }

    public function index (): View
    {
        return view('categories.index', ['categories' => $this->categoriesQueryBuilder->getAll()]);
    }

    public function show ($id): View
    {
        return view('news.index', [
            'news' => $this->categoriesQueryBuilder->getById($id)->news->where('status', 'active'),
            'categories' => $this->categoriesQueryBuilder->getById($id)
        ]);
    }


}
