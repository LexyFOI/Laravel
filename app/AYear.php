<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AYear extends Model
{
    protected $guarded = [];

    public function path()
    {
        return 'ayears/'.$this->id;
    }
}
