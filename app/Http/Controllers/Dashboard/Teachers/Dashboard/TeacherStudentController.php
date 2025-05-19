<?php

namespace App\Http\Controllers\Dashboard\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherStudentController extends Controller
{
    public function index()
    {
        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->guard('teacher')->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('dashboard.pages.teachers.dashboard.students.index', compact('students'));
    }

    public function sections()
    {
        $ids = DB::table('teachers_sections')->where('teacher_id', auth()->guard('teacher')->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id', $ids)->get();
        return view('dashboard.pages.teachers.dashboard.sections.index', compact('sections'));
    }
}
