<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HourHeld extends Model
{
    protected $guarded = [];

    public function path()
    {
        return 'hours/'.$this->id;
    }
}
