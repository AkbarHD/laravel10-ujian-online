<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CourseQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    //  bisa juga string $id
    public function create(Course $course) // dgn seperti ini dia sdh otomatis mendaptkan course_id
    {
        // create berdasarkan id, jd tempat createnya sesaui dgn id course 
        // dd($course);
        return view('admin.questions.create', [
            'course' => $course,
            'students' => $course->Students()->orderBy('id', 'DESC')->get(), // many to many
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            // name dari field
            'question' => 'required|string|max:255',
            'answers' => 'required|array', // array
            'answers.*' => 'required|string', // pecahan sting dari array
            'correct_answer' => 'required|integer'
        ]);

        DB::beginTransaction(); // ini bagus ketika ada kecacatan data bisa di rollback

        try {

            // nambah ke table question
            $question = $course->Questions()->create([
                'question' => $request->question, // ini tdk perlu di course_id, krn sdh otomatis relasi
                // 'course_id' => $course,
            ]);

            // nambah ke table course_answers
            foreach ($request->answers as $index => $answerText) {
                $isCorrect = ($request->correct_answer == $index);
                $question->Answers()->create([
                    'answer' => $answerText,
                    'is_correct' => $isCorrect,
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.courses.show', $course);
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
    public function show(CourseQuestion $courseQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseQuestion $courseQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseQuestion $courseQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseQuestion $courseQuestion)
    {
        //
    }
}
