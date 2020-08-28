<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function store(){
        $student = Student::create($this->validateRequest());

        return redirect($student->path());
    }

    public function update(Student $student)
    {
        $student->update($this->validateRequest());

        return redirect($student->path());
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect('/students');
    }

    /**
     * @return array
     */
    private function validateRequest(): array
    {
        return request()->validate([
            'oib' => 'required',
            'student_name' => 'required',
            'student_last_name' => 'required',
            'email' => 'required',
            'year' => 'required',
            'course_id' => 'required',
            'excuse_id' => 'required',
            'group_id' => 'required',
            'no_excused_weekends' => 'required',
            'no_worked_hours' => 'required',
            'comment' => 'required',
        ]);
    }
}
