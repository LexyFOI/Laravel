<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function store()
    {
        $course = Course::create($this->validateRequest());

        return redirect($course->path());
    }

    public function update(Course $course){
        $course->update($this->validateRequest());

        return redirect($course->path());
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect('/courses');
    }

    public function validateRequest()
    {
        return request()->validate([
            'course_shortName' => '',
            'course_longName' => '',
        ]);
    }
}
