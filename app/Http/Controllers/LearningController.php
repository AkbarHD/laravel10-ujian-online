<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Log;
use App\Models\CourseQuestion;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ini tu sama aja mengabil data yg sdh mengakses ini
        $my_course = $user->Courses()->with('Category')->orderBy('id', 'DESC')->get();

        foreach ($my_course as $course) { // pecah yang tadiny ada 2 coruse jadi satu
            $totalQuestionsCount = $course->Questions()->count(); // menhitung question dari masing" kelas
            $answerQuestionCount = StudentAnswer::where('user_id', $user->id)
                ->whereHas('question', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })->distinct()->count('course_question_id');

            if ($answerQuestionCount < $totalQuestionsCount) {
                $firstUnansweredQuestion = CourseQuestion::where('course_id', $course->id)
                    ->whereNotIn('id', function ($query) use ($user) {
                        $query->select('course_question_id')->from('student_answers')
                            ->where('user_id', $user->id);
                    })->orderBy('id', 'asc')->first();

                $course->nextQuestionId = $firstUnansweredQuestion ? $firstUnansweredQuestion->id : null;
            } else {
                $course->nextQuestionId = null;
            }
        }

        // dd($my_course);

        return view('student.courses.index', [
            'my_courses' => $my_course,
        ]);
    }




    public function learning(Course $course, $question)
    {
        $user = Auth::user(); // dptkan id yang login
        $isEnrolled = $user->Courses()->where('course_id', $course->id)->exists();
        if (!$isEnrolled) { // jika user tersebut tdk memiliki akses kelas trsbt
            return abort(404);
        }
        // cari pertanyaan berdasrkan id kelas yg di lempar
        $currentQuestion = CourseQuestion::where('course_id', $course->id)->where('id', $question)->firstOrFail();
        return view('student.courses.learning', [
            'course' => $course,
            'question' => $currentQuestion,
        ]);
    }


    public function learning_finished(Course $course)
    {
        return view('student.courses.learning_finished', [
            'course' => $course
        ]);
    }

    public function learning_rapport(Course $course)
    {

        $userId = Auth::id();
        $studentAnswers = StudentAnswer::with('question')->whereHas('question', function ($query) use ($course) {
            $query->where('course_id', $course->id); // tampilkan question berdasarkan id
        })->where('user_id', $userId)->get();

        $totalQuestion = CourseQuestion::where('course_id', $course->id)->count();
        $correctAnswer = $studentAnswers->where('answer', 'correct')->count();
        $passed = $correctAnswer == $totalQuestion;

        return view('student.courses.learning_rapport', [
            'course' => $course,
            'passed' => $passed,
            'studentAnswers' => $studentAnswers,
            'totalQuestion' => $totalQuestion,
            'correctAnswer' => $correctAnswer
        ]);
    }
}
