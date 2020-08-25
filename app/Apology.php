<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apology extends Model
{
    protected $guarded = [];

    public function path()
    {
        return 'apologies/'.$this->id;
    }
}
