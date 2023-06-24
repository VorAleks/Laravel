<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index ($id = null): View
    {
        $modelNews = app(News::class);
        $modelCategories = app(Category::class);

        return view('news.index', ['news' => $modelNews->getNews(true), 'categories' => $modelCategories->getCategories()]);
    }

    public function show ($id): View
    {
        $model = app(News::class);

        return view('news.show', ['newsItem' => $model->getNewsById($id)]);
    }

}
