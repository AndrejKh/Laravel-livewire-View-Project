<?php

namespace Gustavinho\LaravelViews\Views;

use Illuminate\Http\Request;

class TableFiltersView extends View
{
    protected $view = 'filters';

    private $fieldsToSearch = null;
    private $filters = null;

    protected function getData(Request $request)
    {
        // Only get filters with value
        $filterValues = collect($request->query('filters', []))->filter(function ($value) {
            if ($value != "" && $value != null) {
                return true;
            }

            return false;
        });

        return [
            'fieldsToSearch' => $this->fieldsToSearch,
            'searchValue' => $request->query('query', ''),
            'filtersValues' => $filterValues->toArray(),
            'filters' => $this->filters
        ];
    }

    public function setFieldsToSearch($fields)
    {
        $this->fieldsToSearch = $fields;

        return $this;
    }

    public function setFilters($filters)
    {
        if ($filters && count($filters)) {
            foreach ($filters as $filter) {
                $this->filters[$filter->id] = $filter;
            }
        }

        return $this;
    }
}
