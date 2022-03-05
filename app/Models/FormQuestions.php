<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormQuestions extends Model
{
    use HasFactory;

    public function formQuestion_options()
    {
        return $this->hasMany(QuestionOptions::class, 'question_id', 'id')->where('is_active', 1);
    }
}