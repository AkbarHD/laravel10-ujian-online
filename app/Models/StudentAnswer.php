<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    //
    public function question()
    {
        // jawban murid pilih salah satu a,b,c,d
        return $this->belongsTo(CourseQuestion::class, 'course_question_id');
    }
}
