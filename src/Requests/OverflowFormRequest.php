<?php

namespace CraftLogan\LaravelOverflow\Requests;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class OverflowFormRequest extends FormRequest
{
    protected $model;
    protected $overflow_column;

    public function __construct(Model $model, $overflow_column = "properties")
    {
        parent::__construct();
        $this->model = $model;
        $this->overflow_column = $overflow_column;
    }

    public function allWithOverflow()
    {
        $properties[$this->overflow_column] = $this->overflow();
        return array_merge($properties, $this->getColumns());
    }

    public function getColumns()
    {
        $columnNames = $this->getColumnNames();
        $attributes = array_intersect_key($this->all(), $columnNames);
        return $attributes;
    }

    public function overflow()
    {
        $columnNames = $this->getColumnNames();
        $attributes = array_diff_key($this->all(), $columnNames);
        $attributes = json_encode($attributes);
        return $attributes;
    }

    public function getTableColumns()
    {
        return Schema::getColumnListing($this->model->getTable());
    }

    public function getColumnNames()
    {
        $columnNames = $this->getTableColumns();
        $columnNames = array_fill_keys($columnNames, "");
        return $columnNames;
    }
}
