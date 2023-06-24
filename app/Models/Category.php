<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function getCategories(bool $isJoin = false): Collection
    {
        if ($isJoin === true) {
            return DB::table($this->table)
//                ->where('status', '=', 'active')
//                ->select('news.*', 'categories.title as categoryTitle')
//                ->join('category_has_news', 'category_has_news.news_id', '=', 'news.id')
//                ->join('categories', 'category_has_news.category_id', '=', 'categories.id')
                ->get();
        }
        return DB::table($this->table)->get();

    }

    public function getCategoriesById($id): mixed
    {
        return DB::table($this->table)->find($id);
    }
}
