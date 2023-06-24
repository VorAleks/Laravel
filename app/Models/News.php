<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    public function getNews(bool $isJoin = false): Collection
    {
        if ($isJoin === true) {
            return DB::table($this->table)
//                ->where('status', '=', 'active')
                ->select('news.*', 'categories.title as categoryTitle', 'sources.title as sourceTitle')
                ->leftjoin('category_has_news', 'category_has_news.news_id', '=', 'news.id')
                ->leftjoin('categories', 'category_has_news.category_id', '=', 'categories.id')
                ->leftjoin('news_sources', 'news_sources.news_id', '=', 'news.id')
                ->leftjoin('sources', 'news_sources.source_id', '=', 'sources.id')
                ->get();
        }
        return DB::table($this->table)->get();

    }

    public function getNewsById($id): mixed
    {
        return DB::table($this->table)->find($id);
    }

    public function getNewsByCategories($id): mixed
    {
        return DB::table($this->table)
            ->select('news.*', 'categories.title as categoryTitle')
            ->join('category_has_news', 'category_has_news.news_id', '=', 'news.id')
            ->join('categories', 'category_has_news.category_id', '=', 'categories.id')
            ->where('categories.id', '=', $id)
            ->get();
            ;
    }
}
