<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAnswer;
use App\Models\CourseQuestion;
use App\Models\CourseStudent;
use App\Models\User;
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
            $question = $course->Questions()->create([ // ini tdk perlu di course_id, krn sdh otomatis relasi
                'question' => $request->question,
                // 'course_id' => $course,
            ]);

            // $question = CourseQuestion::create([
            //     'question' => $request->question,  // pake ini juga bisa tanpa relasi dan harus isi course id manual
            //     'course_id' => $course->id,
            // ]);

            // nambah ke table course_answers
            foreach ($request->answers as $index => $answerText) {
                $isCorrect = ($request->correct_answer == $index); // jwban yg benar
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseQuestion $courseQuestion)
    {
        $course = Course::where('id', $courseQuestion->course_id)->first();
        // $course = $courseQuestion->Course; // utk mengambil course berdasarkan id utk course_id di table question
        $students = $course->Students()->orderBy('id', 'DESC')->get();

        return view('admin.questions.edit', [
            'courseQuestion' => $courseQuestion, // utk mndptkn question brdsrkan id yang ingin di tampikan
            'course' => $course, // utk mengisi cover judul kelas
            'students' => $students, // tuk melihat kelas ini userya siapa aja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseQuestion $courseQuestion)
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

            $courseQuestion->update([
                'question' => $request->question,
                //course_id gamungkin karena ini hanya edit pertanyaan saja tidak edit kelas
            ]);

            $courseQuestion->Answers()->delete(); // hapus jawaban dari pertanyaan tersebut semuanya

            // edit ke table course_answers
            foreach ($request->answers as $index => $answerText) {
                $isCorrect = ($request->correct_answer == $index); // jwban yg benar
                $courseQuestion->Answers()->create([ // kalo update semuanya td ke ganti 
                    'answer' => $answerText,
                    'is_correct' => $isCorrect,
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.courses.show', $courseQuestion->course_id);
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([ // kembalikan ke halam sebelumnya dan mengirimkan pesan error
                'system_error' => ['System_error!!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseQuestion $courseQuestion)
    {
        try {
            $courseQuestion->delete(); // hapus berdasarkan id
            $answer = CourseAnswer::where('course_question_id', $courseQuestion->id); // hapus jawban berdsarkan course_question_id
            $answer->delete();
            return redirect()->route('dashboard.courses.show', $courseQuestion->course_id);
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([ // kembalikan ke halam sebelumnya dan mengirimkan pesan error
                'system_error' => ['System_error!!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
}
