<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.courses.index', [
            'courses' => Course::with('Category')->orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        return view('admin.courses.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // name dari field
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'cover' => 'required|image|mimes:png,jpg,svg'
        ]);

        DB::beginTransaction(); // ini bagus ketika ada kecacatan data bisa di rollback
        try {
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }
            $validated['slug'] = Str::slug($request->name);
            $newCourse = Course::create($validated);

            DB::commit();

            return redirect()->route('dashboard.courses.index');
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
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course) // kalo cara seperti biasa kan harusnya "string $id" karena kita pake model mcr
    {
        // Teknik hal baru menggunakan resouce like sdh otomatis
        $categories = Category::all();
        // $course = Course::findOrFail($id); // ini ga perlu
        return view('admin.courses.edit', [
            'course' => $course,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            // name dari field
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'cover' => 'sometimes|image|mimes:png,jpg,svg'
        ]);

        DB::beginTransaction(); // ini bagus ketika ada kecacatan data bisa di rollback
        try {
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }
            $validated['slug'] = Str::slug($request->name);

            $course->update($validated); // dgn sprti ini dia delete otomatis where id

            DB::commit();

            return redirect()->route('dashboard.courses.index');
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
    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->route('dashboard.courses.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([ // kembalikan ke halam sebelumnya dan mengirimkan pesan error
                'system_error' => ['System_error!!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
}
