<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quizze extends Model
{
    use HasTranslations;
    protected $translatable = ['name'];
    protected $fillable = [
        'name',
        'subject_id',
        'grade_id',
        'classe_id',
        'section_id',
        'teacher_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quizze_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'quiz_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'results', 'quiz_id', 'student_id')
            ->distinct();
    }
}
