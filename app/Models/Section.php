<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['name_section'];
    protected $fillable = ['grade_id', 'classe_id', 'name_section', 'status'];

    public function classes()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }


    // Related Sections With Teachers
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teachers_sections','section_id','teacher_id');
    }

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    protected $casts = [
        'name_section' => 'array',
    ];
}
