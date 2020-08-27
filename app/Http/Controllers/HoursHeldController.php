<?php

namespace App\Http\Controllers;

use App\HourHeld;
use Illuminate\Http\Request;

class HoursHeldController extends Controller
{
    public function store()
    {
        HourHeld::create($this->validateRequest());
    }

    public function update(HourHeld $hour)
    {
        $hour->update($this->validateRequest());
        return redirect($hour->path());
    }

    public function destroy(HourHeld $hour)
    {
        $hour->delete();
        return redirect('/hours');
    }

    /**
     * @return array
     */
    private function validateRequest(): array
    {
        return request()->validate([
            'hs_date' => 'required',
            'hs_day' => 'required',
            'group_id' => 'required',
            'student_id' => 'required',
            'points' => 'required',
        ]);
    }
}
