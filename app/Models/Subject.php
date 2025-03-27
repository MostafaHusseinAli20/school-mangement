<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Subject extends Model
{
    use HasTranslations;
    protected $translatable = ['name'];
    protected $fillable = [
        'name',
        'grade_id',
        'classe_id',
        'teacher_id'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class,'classe_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }

    protected $casts = [
        'name' => 'array',
    ];
}
