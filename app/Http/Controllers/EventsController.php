<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function store()
    {
        Event::create($this->validateRequest());
    }

    public function update(Event $event){
        $event->update($this->validateRequest());
    }

    public function validateRequest()
    {
        return request()->validate([
            'group' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
            'location' => 'required',
            'capacity' => 'required',
        ]);
    }
}
