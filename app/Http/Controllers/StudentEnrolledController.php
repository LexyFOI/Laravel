<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentEnrolledController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Student $student)
    {
        //$student->enrolled($group);
        $student->enrolled(auth()->user());
    }
}
