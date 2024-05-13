<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ini tu sama aja mengabil data yg sdh mengakses ini
        $my_course = $user->Courses()->with('Category')->orderBy('id', 'DESC')->get();

        // dd($my_course);

        return view('student.courses.index', [
            'my_courses' => $my_course,
        ]);
    }
}
