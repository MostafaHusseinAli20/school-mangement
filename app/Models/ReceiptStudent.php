<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptStudent extends Model
{
    protected $fillable = ['date', 'student_id', 'debit', 'description'];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
