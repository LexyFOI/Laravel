<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentRecordedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Student $student)
    {
        //student->recorded($ayear);
        $student->recorded(auth()->user());
    }
}
