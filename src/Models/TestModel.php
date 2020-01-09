<?php

namespace CraftLogan\LaravelOverflow\Models;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{

    protected $guarded = [];

    public function properties(){
        return json_decode($this->properties);
    }

}
