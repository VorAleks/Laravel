<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index (): View
    {
        $modelCategories = app(Category::class);

        return view('categories.index', ['categories' => $modelCategories->getCategories()]);
    }

    public function show ($id): View
    {
        $modelNews = app(News::class);
        $modelCategories = app(Category::class);

        return view('news.index', ['news' => $modelNews->getNewsByCategories($id), 'categories' => $modelCategories->getCategoriesById($id)]);
    }


}
