<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    //  ini belongsto utk 4 pertanyaan ini punya nya kelas siapa? misal mtk atau ipa
    public function Course(): BelongsTo
    {
        // pertanyaan ini punya course siapa?
        return $this->belongsTo(Course::class, 'course_id');
    }

    // dan di pertanyaan ini punya 4 jawaban yang akan di pilih salah satu jadi hasMany ke table Answer
    public function Answers(): HasMany
    {
        //  pertanyaan ini sekalian di tampilkan jawaban dari user 1 - 4
        return $this->hasMany(CourseAnswer::class, 'course_question_id', 'id');
    }
}
