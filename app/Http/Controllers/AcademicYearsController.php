<?php

namespace App\Http\Controllers;

use App\AYear;
use Illuminate\Http\Request;

class AcademicYearsController extends Controller
{

    public function store()
    {
        $ayear = AYear::create($this->validateRequest());

        return redirect($ayear->path());
    }

    public function update(AYear $ayear){
        $ayear->update($this->validateRequest());

        return redirect($ayear->path());
    }

    public function destroy(AYear $ayear)
    {
        $ayear->delete();

        return redirect('/ayears');
    }

    private function validateRequest()
    {
        return request()->validate([
            'ayear'=>'',
            'course_id'=>'',
            'semestar1_start'=>'',
            'semestar1_end'=>'',
            'semestar2_start'=>'',
            'semestar2_end'=>'',
        ]);
    }
}
