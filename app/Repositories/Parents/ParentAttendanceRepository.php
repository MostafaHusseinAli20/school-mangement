<?php

namespace App\Repositories\Parents;

use App\Interfaces\Parents\ParentAttendanceInterface;
use App\Models\Attendance;
use App\Models\Student;

class ParentAttendanceRepository implements ParentAttendanceInterface
{
    public function attendance($id)
    {
        $parent = auth()->guard('parent')->user();
        Student::where('id', $id)
            ->where('parent_id', $parent->id)->firstOrFail();
        
        // لو الطالب ابنه فعلاً.. هات حضور الطالب
        $attendances = Attendance::where('student_id', $id)->get();

        return view('dashboard.pages.parents.attendance.index',[
            'attendances' => $attendances
        ]);
    }
}