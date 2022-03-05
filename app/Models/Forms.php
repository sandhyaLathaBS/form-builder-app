<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forms extends Model
{
    use HasFactory;

    public function formQuestions()
    {
        return $this->hasMany(FormQuestions::class, 'form_token', 'formToken')->where('is_active', 1);
    }
    public function formQuestion_options()
    {
        return $this->hasMany(QuestionOptions::class, 'form_token', 'formToken')->where('is_active', 1);
    }
}