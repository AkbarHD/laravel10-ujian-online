<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAnswer;
use App\Models\CourseQuestion;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StudentAnswerController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course, $question)
    {
        //
        $question_detail = CourseQuestion::where('id', $question)->first();

        $validated = $request->validate([
            'answer_id' => 'required|exists:course_answers,id' 
        ]);

        DB::beginTransaction();
        try{
            $selected_answer = CourseAnswer::find($validated['answer_id']); // cari courseAnswer dgn id yang dikirim dari radio button

            if($selected_answer->course_question_id != $question){ // jika jawaban yang d
                $error = ValidationException::withMessages([
                    'system_error' => ['System_error!' . ['Jawaban tidak tersedia pada pertanyaan']],
                ]);

                throw $error;
            }

            $studentAnswer = StudentAnswer::where('user_id', Auth::id())->where('course_question_id', $question)->first();

            if($studentAnswer){
                $error = ValidationException::withMessages([
                    'system_error' => ['System_error!' . ['Kamu telah menjawab pertanyaan ini sebelumnya ']],
                ]);

                throw $error;
            }

            $answerValue = $selected_answer->is_correct ? 'correct' : 'wrong'; // jika 1 correct jika 0 wrong

            StudentAnswer::create([
                'user_id' => Auth::id(),
                'course_question_id' => $question,
                'answer' => $answerValue,
            ]);

            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System_error!' . $e->getMessage()],
            ]);

            throw $error;
        }

        // jika blm selesai makan ke pertanyaan selanjutnya "DESC"
        $nextQuestion = CourseQuestion::where('course_id', $course->id)->where('id', '>' , $question)->orderBy('id', 'DESC')->first(); 
        if($nextQuestion){
            return redirect()->route('dashboard.learning.course', ['course' => $course->id, 'question' => $nextQuestion->id]);
        }else{
            // jika sudah selesai
            return redirect()->route('dashboard.learning.finished.course', $course->id);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentAnswer $studentAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentAnswer $studentAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentAnswer $studentAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentAnswer $studentAnswer)
    {
        //
    }
}
