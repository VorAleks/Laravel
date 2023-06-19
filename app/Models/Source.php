<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Source extends Model
{
    use HasFactory;

    protected $table = 'sources';

    public function getSources(bool $isJoin = false): Collection
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

    public function getSourcesById($id): mixed
    {
        return DB::table($this->table)->find($id);
    }
}
