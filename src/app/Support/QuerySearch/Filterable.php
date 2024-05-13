<?php

namespace App\Support\QuerySearch;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query, SearchQuery $filter): Builder
    {
        return $filter->apply($query, $this->getTable());
    }
}
