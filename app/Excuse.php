<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Excuse extends Model
{
    protected $guarded = [];

    public function path()
    {
        return 'excuses/'.$this->id;
    }
}
