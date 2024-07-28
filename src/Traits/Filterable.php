<?php

namespace Dipesh79\LaravelHelpers\Traits;

use Dipesh79\LaravelHelpers\Exception\FilterableColumnsNotSpecifiedException;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Filterable
 *
 * This trait provides a method to filter query results based on specified columns.
 */
trait Filterable
{
    /**
     * Applies a custom filter to the query based on the specified filterable columns.
     *
     * @param Builder $query The query builder instance.
     * @param string $filterQuery The filter query string.
     * @param array $columns The columns to filter on.
     *
     * @return Builder The modified query builder instance.
     * @throws FilterableColumnsNotSpecifiedException If no filterable columns are specified.
     *
     */
    public function scopeCustomFilter(Builder $query, string $filterQuery, array $columns = []): Builder
    {
        $filterableColumns = $columns ?: $this->filterable;
        if (empty($filterableColumns)) {
            throw new FilterableColumnsNotSpecifiedException();
        }
        foreach ($filterableColumns as $column) {
            $query->orWhere($column, 'LIKE', '%' . $filterQuery . '%');
        }
        return $query;
    }
}
