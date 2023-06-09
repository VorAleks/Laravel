<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index (): View
    {
        $categories = $this->getCategories();

        return view('categories.index', ['categories' => $categories]);
    }

    public function show ($id): View
    {
        $news = $this->getNewsByCategory($id);
        $categories = $this->getCategories($id);
        return view('news.index', ['news' => $news, 'categories' => $categories]);
    }


}
