<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function store(){
        $data = request()->validate([
            'oib'=>'required',
            'student_name'=>'required',
            'student_last_name'=>'required',
            'year'=>'required',
            'course_id'=>'required',
            'excuse_id'=>'required',
            'event_id'=>'required',
            'no_excused_weekends'=>'required',
            'no_workd_hours'=>'required',
            'comment'=>'required',
        ]);
        $student = Student::create($data);

        return redirect($student->path());

    }

    public function update(Student $student)
    {
        $data = request()->validate([
            'oib'=>'required',
            'student_name'=>'required',
            'student_last_name'=>'required',
            'year'=>'required',
            'course_id'=>'required',
            'excuse_id'=>'required',
            'event_id'=>'required',
            'no_excused_weekends'=>'required',
            'no_workd_hours'=>'required',
            'comment'=>'required',
        ]);

        $student->update($data);

        return redirect($student->path());
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect('/students');
    }
}
