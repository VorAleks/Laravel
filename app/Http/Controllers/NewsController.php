<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index ($id = null): View
    {
        $news = $this->getNews();
        $categories = $this->getCategories();

        return view('news.index', ['news' => $news, 'categories' => $categories]);
    }

    public function show ($id): View
    {
       return view('news.show', ['newsItem' => $this->getNews($id)]);
    }

}
