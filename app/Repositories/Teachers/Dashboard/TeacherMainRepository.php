<?php

namespace App\Repositories\Teachers\Dashboard;

use App\Interfaces\Teachers\Dashboard\TeacherMainInterface;
use App\Models\Event;
use App\Models\Student;
use App\Models\Teacher;

class TeacherMainRepository implements TeacherMainInterface
{
    public function index()
    {
        $events = Event::select('id', 'title', 'start')->get();

        $teacher_id = auth()->guard('teacher')->user()->id;
        $ids = Teacher::findOrFail($teacher_id)->sections()->pluck('section_id');
        $sections_count = $ids->count(); // Count the number of sections
        $students_count = Student::whereIn('section_id', $ids)->count(); // Initialize student count

        return view(
            'dashboard.pages.teachers.dashboard.dashboard',
            compact('events', 'sections_count', 'students_count')
        );
    }
}