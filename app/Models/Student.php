<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Student extends Authenticatable
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

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function getTypeBloodAttribute()
    {
        $type_blood_id = DB::table('type_bloods')
            ->where('id', $this->type_blood_id)
            ->first();
        return $type_blood_id->name;
    }
    
    // Realtion Between Student with Image (Polymorphic)
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
