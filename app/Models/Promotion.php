<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];
    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
    public function f_grade()
    {
        return $this->belongsTo(Grade::class,'from_grade');
    }

    public function t_grade()
    {
        return $this->belongsTo(Grade::class,'to_grade');
    }

    public function f_classe()
    {
        return $this->belongsTo(Classe::class,'from_classe');
    }

    public function t_classe()
    {
        return $this->belongsTo(Classe::class,'to_classe');
    }

    public function f_section()
    {
        return $this->belongsTo(Classe::class,'from_section');
    }

    public function t_section()
    {
        return $this->belongsTo(Classe::class,'to_section');
    }
}
