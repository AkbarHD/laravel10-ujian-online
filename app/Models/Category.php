<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    // fungsi dari guarded ini jadi ini di isi otomatis oleh laravel tdk di isi manual, semacam di lindungin attribut idnya
    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'slug'
    ];
}
