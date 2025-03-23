<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Fee extends Model
{
    use HasTranslations;
    protected $translatable = ['title'];
    protected $fillable = ['title', 'amount', 'description', 'year', 'grade_id', 'classe_id', 'fee_type'];

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
