<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // hasmany utk menarik 5 pertanyaan dari coursequestion
    public function Questions(): HasMany
    {
        return $this->hasMany(CourseQuestion::class, 'course_id', 'id');
    }


    public function Students(): BelongsToMany
    {
        // belongtomany (many to many), 3 table berelasi course,  user, course_students
        // course ini bisa meilhat siapa aja user yg masuk kelas tertentu course student hanya penadah saja
        return $this->belongsToMany(User::class, 'course_students',  'user_id', 'course_id');
    }
}
