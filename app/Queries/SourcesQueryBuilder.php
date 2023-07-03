<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Source;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;


class SourcesQueryBuilder extends QueryBuilder
{

    public function getModel(): Builder
    {
        return Source::query();
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->getModel()->paginate(10);
    }

}
