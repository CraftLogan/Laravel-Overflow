<?php

namespace CraftLogan\LaravelOverflow\Requests;

use CraftLogan\LaravelOverflow\Models\TestModel;

class TestOverflowFormRequest extends OverflowFormRequest
{
    public function __construct()
    {
        parent::__construct(new TestModel);
    }
}
