<?php

namespace App\Http\Controllers;

use App\HourHeld;
use Illuminate\Http\Request;

class HoursHeldController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'hs_date'=>'required',
            'hs_day'=>'required',
            'group_id'=>'required',
            'student_id'=>'required',
            'points'=>'required',
        ]);

        HourHeld::create($data);

    }

    public function update(HourHeld $hour)
    {
        $data = request()->validate([
            'hs_date'=>'required',
            'hs_day'=>'required',
            'group_id'=>'required',
            'student_id'=>'required',
            'points'=>'required',
        ]);

        $hour->update($data);

        return redirect($hour->path());
    }

    public function destroy(HourHeld $hour)
    {
        $hour->delete();

        return redirect('/hours');
    }

}
