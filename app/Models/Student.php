<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasTranslations, SoftDeletes;
    protected $translatable = ['name'];
    //
    protected $guarded = [];

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function myParent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccounts::class, 'student_id');
    }

    // Realtion Between Student with Image (Polymorphic)
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
