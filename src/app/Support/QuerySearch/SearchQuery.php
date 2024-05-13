<?php

namespace App\Support\QuerySearch;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

final class SearchQuery implements SearchQueryInterface
{
    protected Request $request;

    protected Builder $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder, string $table): Builder
    {
        $this->builder = $builder;

        foreach ($this->request->only('sort', 'include', 'filter') as $name => $value) {
            if (method_exists($this, $name) && count($value) > 0) {
                call_user_func_array([$this, $name], [$value, $table]);
            }
        }

        return $this->builder;
    }

    public function sort(array $value, string $table): Builder
    {
        $sorts = array_unique($value);

        foreach ($sorts as $column) {
            $colInTable = ltrim($column, '-+');
            if ($column[0] === '-' && Schema::hasColumn($table, $colInTable)) {
                $this->builder->orderByDesc($colInTable);
            } else if (Schema::hasColumn($table, $colInTable)) {
                $this->builder->orderBy($colInTable);
            }
        }

        return $this->builder;
    }

    public function filter(array $value, string $table): Builder
    {
        $filters = array_unique($value);

        foreach ($filters as $column => $val) {
            [$isLikeSearch, $colInTable] = $this->isLikeSearchColumn($column);
            if ($isLikeSearch && Schema::hasColumn($table, $colInTable)) {
                $this->builder->where($colInTable, 'like', "%$val%");
            } else if (Schema::hasColumn($table, $colInTable)) {
                $this->builder->where($colInTable, $val);
            }
        }

        return $this->builder;
    }

    public function include(array $value): Builder
    {
        $this->builder->with($value);

        return $this->builder;
    }


    private function isLikeSearchColumn(string $column): array
    {
        if (Str::contains($column, 'like_')) {
            return [true, str_replace('like_', '', $column)];
        }

        return [false, $column];
    }
}
