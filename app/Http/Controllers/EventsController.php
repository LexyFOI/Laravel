<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function store()
    {
        $event = Event::create($this->validateRequest());

        return redirect($event->path());
    }

    public function update(Event $event){
        $event->update($this->validateRequest());

        return redirect($event->path());
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect('/events');
    }

    private function validateRequest()
    {
        return request()->validate([
            'event_name' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'payment' => 'required',
            'price'=> 'required',
            'event_points'=>'required',
            'event_description'=>'required',
        ]);
    }
}
