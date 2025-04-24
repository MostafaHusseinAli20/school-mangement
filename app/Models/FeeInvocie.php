<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeInvocie extends Model
{
    protected $guarded = [];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

}
