<?php

namespace App\Http\Controllers;

use App\Apology;
use Illuminate\Http\Request;

class ApologiesControlller extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'student_id'=>'required',
            'valid_from'=>'required',
            'valid_to'=>'required',
            'nof_weeks'=>'required',
            'comment'=>'required',
        ]);

        Apology::create($data);
    }

    public function update(Apology $apology)
    {
        $data = request()->validate([
            'student_id'=>'required',
            'valid_from'=>'required',
            'valid_to'=>'required',
            'nof_weeks'=>'required',
            'comment'=>'required',
        ]);

        $apology->update($data);
    }

    public function destroy(Apology $apology)
    {
        $apology->delete();
        return redirect('/apologies');
    }
}
