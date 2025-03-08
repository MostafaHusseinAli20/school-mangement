<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
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

    protected $casts = [
        'name' => 'array',
    ];

}