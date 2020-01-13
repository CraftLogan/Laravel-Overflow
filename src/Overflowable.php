<?php

namespace CraftLogan\LaravelOverflow;
use Illuminate\Support\Facades\Schema;

trait Overflowable{

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
        return Schema::getColumnListing($this->table);
    }

    public function getColumnNames()
    {
        $columnNames = $this->getTableColumns();
        $columnNames = array_fill_keys($columnNames, "");
        return $columnNames;
    }

}
