<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function asu(Course $course)
    {
        return view('student.courses.learning_rapport', [
            'course' => $course,
        ]);
    }

  
}
