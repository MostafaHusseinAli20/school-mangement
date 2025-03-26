<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    protected $fillable = ['date', 'student_id', 'amount', 'description'];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
