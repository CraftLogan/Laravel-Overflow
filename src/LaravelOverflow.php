<?php

namespace CraftLogan\LaravelOverflow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use CraftLogan\LaravelOverflow\Overflowable;

class LaravelOverflow
{
    use Overflowable;

    protected $model;
    protected $overflow_column;
    protected $request;

    public function __construct(Request $request, Model $model, $overflow_column = "properties")
    {
        $this->request = $request;
        $this->model = $model;
        $this->overflow_column = $overflow_column;
    }

}
