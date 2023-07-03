<?php

declare(strict_types=1);

namespace App\Queries;

use App\Enums\NewsStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class OrdersQueryBuilder extends QueryBuilder
{

    public function getModel(): Builder
    {
        return Order::query();
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->getModel()->paginate(10);
    }

}
