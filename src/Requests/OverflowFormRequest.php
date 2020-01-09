<?php

namespace CraftLogan\LaravelOverflow\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CraftLogan\LaravelOverflow\Overflowable;

class OverflowFormRequest extends FormRequest
{
    use Overflowable;
    public $table = 'test_models';
    public $overflow_column = 'properties';
}

