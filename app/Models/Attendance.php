<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = [
        'attendance_date', 
        'attendance_status',
        'student_id',
        'grade_id',
        'classe_id',
        'section_id',
        'teacher_id'
    ];
}
