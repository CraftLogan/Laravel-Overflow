<?php

namespace CraftLogan\LaravelOverflow;
use Illuminate\Support\Facades\Schema;

trait Overflowable{

    public function allWithOverflow()
    {
        $properties[$this->overflow_column] = json_encode($this->overflow());
        return array_merge($properties, $this->getColumns());
    }

    public function getColumns()
    {
        $columnNames = $this->getTableColumns();
        $columnNames = array_fill_keys($columnNames, "");
        $attributes = array_intersect_key($this->all(), $columnNames);
        return $attributes;
    }

    public function overflow()
    {
        $columnNames = $this->getTableColumns();
        $columnNames = array_fill_keys($columnNames, "");
        $attributes = array_diff_key($this->all(), $columnNames);
        return $attributes;
    }

    public function getTableColumns()
    {
        return Schema::getColumnListing($this->table);
    }
}
