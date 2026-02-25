<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = ['question', 'type', 'options', 'category'];
    // Agar options JSON hai, toh isse array/object mein cast kar dein
    protected $casts = [
        'options' => 'array',
    ];
}
