<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasTranslations;
    protected $translatable = ['name'];
    protected $guarded = [];

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }

    public function specialisations()
    {
        return $this->belongsTo(Specialisation::class, 'specialist_id', 'id');
    }
     
    // Related Teacher With Sections
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teachers_sections','teacher_id','section_id');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'teacher_grades');
    }

    protected $casts = [
        'name' => 'array',
    ];

}