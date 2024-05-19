<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseQuestionController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\StudentAnswerController;
use App\Models\CourseQuestion;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// bawaan dari breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// bawaan dari breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ketika ingin mengakses harus ke dashboard dlu
    // agar pretty url atau mengikuti dari breeze yg defaultnya ke dashboard maka yg masuk ke course harus ke dashboard dlu
    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        // yg bisa masuk hanya yg rolenya teacher
        // sama aja seperti "dashboard/courses/nama method yg dituju"
        Route::resource('courses', CourseController::class)->middleware('role:teacher');

        //  form membuat pertanyaan where id
        Route::get('/course/question/create/{course}', [CourseQuestionController::class, 'create'])->middleware('role:teacher')->name('course.create.question');

        // post form proses simpan where id
        Route::post('/course/question/save/{course}', [CourseQuestionController::class, 'store'])->middleware('role:teacher')->name('course.create.question.store');

        //  
        Route::resource('course_questions', CourseQuestionController::class)->middleware('role:teacher');

        // utk melihat studentnya siapa aja dari kelas tertentu
        Route::get('/course/students/show/{course}', [CourseStudentController::class, 'index'])->middleware('role:teacher')->name('course.course_students.index');


        // form utk menambahkan student baru masuk ke dalam kelas
        Route::get('/course/students/create/{course}', [CourseStudentController::class, 'create'])->middleware('role:teacher')->name('course.course_students.create');

        // utk post (menyimpan)
        Route::post('/course/students/save/{course}', [CourseStudentController::class, 'store'])->middleware('role:teacher')->name('course.course_students.store');




        // utk murid melihat dia punya keals apa aja yg sdh diberikan oleh guru
        Route::get('/learning', [LearningController::class, 'index'])->middleware('role:student')->name('learning.index');

        // utk murid mengerjakan kelasnya tampilan
        Route::get('/learning/{course}/{question}', [LearningController::class, 'learning'])->middleware('role:student')->name('learning.course');

        // utk murid mengerjakan kelasnya tersimpan disni
        Route::post('/learning/{course}/{question}', [StudentAnswerController::class, 'store'])->middleware('role:student')->name('learning.course.answer.store');

        // hasil nilai murid after learning
        Route::get('/learning/finished/{course}', [LearningController::class, 'learning_finished'])->middleware('role:student')->name('learning.finished.course');
         
        // ----------------------------------
        Route::get('/rapport/learning/{course}', [LearningController::class, 'learning_rapport'])
        ->middleware('role:student')
        ->name('learning.rapport.course');
        // -----------------------------------

        // ----------------fiks bug ----------------------
        // Route::resource('rapport', RapportController::class)->middleware('role:student')->only(['show']);
        // Route::get('rapport/learning/apa/{course}', [RapportController::class, 'asu'])->middleware('role:student')->name('rapport.show');


    });
});

require __DIR__ . '/auth.php';
