<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoriesQueryBuilder extends QueryBuilder
{

    public function getModel(): Builder
    {
        return Category::query();
    }

    public function getAllPaginate(): LengthAwarePaginator
    {
        return $this->getModel()->paginate(10);
    }

    public function getAll(): Collection
    {
        return $this->getModel()->get();
    }

    public function getById($id): Model|Collection|Builder|array|null
    {
//        dd($this->getModel()->find($id)->news);
        return $this->getModel()->find($id);
    }
}
