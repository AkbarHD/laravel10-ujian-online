<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\StudentAnswer;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        // display at admin
        $tudents = $course->Students()->orderBy('id', 'DESC')->get(); // ambil semua student dari kelas tertentu
        $question = $course->Questions()->orderBy('id', 'DESC')->get(); // ambil semua qeustion
        $totalQuestion = $question->count(); // lalu hitung dan dptkan semua question

        foreach ($tudents as $student) { //pecah semua student
            $studentAnswer = StudentAnswer::whereHas('question', function ($query) use ($course) { // cari jwbn student
                $query->where('course_id', $course->id);
            })->where('user_id', $student->id)->get();

            $answerCount = $studentAnswer->count();
            $correctAnswerCount = $studentAnswer->where('answer', 'correct')->count();

            if ($answerCount == 0) {
                $student->status = "Belum Mengerjakan";
            } elseif ($correctAnswerCount < $totalQuestion) {
                $student->status = "Tidak Lulus";
            } elseif ($correctAnswerCount == $totalQuestion) {
                $student->status = "Lulus";
            }
        }

        // besok buat bikin list student di dashboard

        return view('admin.students.index', [
            'course' => $course,
            'question' => $question,
            'students' => $tudents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        // dd($course);
        return view('admin.students.add_student', [
            'course' => $course,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'email' => 'string|required',
        ]);

        // penjagaan jika user dgn email tertentu tidak ada di table users
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error = ValidationException::withMessages([ // feedback pesan error
                'system_error' => ['email Student tidak tersedia'], // notifikasi yang muncul
            ]);
            throw $error; // kembalikan pesan error
        }

        // penjagaan jika user sudah masuk kelas dan tidak bisa masuk kelas lagi
        $studentExist = $course->Students()->where('user_id', $user->id)->exists(); // dgn relasi course bisa masuk ke table
        if ($studentExist) {
            $error = ValidationException::withMessages([
                'system_error' => ['Student sudah memiliki hakm akses kelas'],
            ]);
            throw $error;
        }

        DB::beginTransaction();
        try {
            $course->Students()->attach($user->id); // berlaku pada many to many
            DB::commit();
            return redirect()->route('dashboard.course.course_students.index', $course);
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([ // kembalikan ke halam sebelumnya dan mengirimkan pesan error
                'system_error' => ['System_error!!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseStudent $courseStudent)
    {
        //
    }
}
