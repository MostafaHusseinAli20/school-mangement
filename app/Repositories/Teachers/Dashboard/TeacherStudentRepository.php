<?php

namespace App\Repositories\Teachers\Dashboard;

use App\Interfaces\Teachers\Dashboard\TeacherStudentInterface;
use App\Models\Attendance;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeacherStudentRepository implements TeacherStudentInterface
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

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('dashboard.pages.teachers.dashboard.students.show', compact('student'));
    }

    public function getAttendance()
    {
        $students = Student::where(function ($query) {
            $ids = DB::table('teachers_sections')
                ->where('teacher_id', auth()->guard('teacher')->user()->id)
                ->pluck('section_id');
            $query->whereIn('section_id', $ids);
        })->get();

        return view('dashboard.pages.teachers.dashboard.students.attendance', compact('students'));
    }

    public function editAttendance(Request $request)
    {
        DB::beginTransaction();
        try {

            foreach ($request->attendences as $studentId => $attendence) {
                if ($attendence == 'presence') {
                    $attendance_status = true;
                } else if ($attendence == 'absent') {
                    $attendance_status = false;
                }

                Attendance::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'attendance_date' => date('Y-m-d'),
                    ],
                    [
                        'attendance_status' => $attendance_status,
                        'student_id' => $studentId,
                        'grade_id' => $request->grade_id,
                        'section_id' => $request->section_id,
                        'classe_id' => $request->classe_id,
                        'teacher_id' => auth()->guard('teacher')->user()->id,
                    ]
                );
            }

            DB::commit();
            toastr()->success(__('trans.message_attendence'));
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show_attachment($student_name, $file_name)
    {
        $file = Storage::disk('public')->path("students_attachments/$student_name/$file_name");

        if (Storage::disk('public')->exists("students_attachments/$student_name/$file_name")) {
            return response()->file($file);
        } else {
            return abort(404, 'File not found.');
        }
    }

    public function attendanceReport()
    {
        $students = Student::where(function ($query) {
            $ids = DB::table('teachers_sections')
                ->where('teacher_id', auth()->guard('teacher')->user()->id)
                ->pluck('section_id');
            $query->whereIn('section_id', $ids);
        })->get();
        return view('dashboard.pages.teachers.dashboard.students.attendance_report', compact('students'));
    }

    public function attendanceReportSearch(Request $request)
    {
        if ($request->from > $request->to) {
            toastr()->error(__('trans-teacher.error_date'));
            return back();
        }

        // الأقسام اللي المدرس مسؤول عنها
        $ids = DB::table('teachers_sections')
            ->where('teacher_id', auth()->guard('teacher')->user()->id)
            ->pluck('section_id');

        $students = Student::whereIn('section_id', $ids)->get();

        // الاستعلام الأساسي
        $query = Attendance::whereBetween('attendance_date', [$request->from, $request->to])
            ->whereIn('section_id', $ids);

        // لو محدد طالب معين
        if ($request->student_id != 0) {
            $query->where('student_id', $request->student_id);
        }

        // فلترة حسب حالة الحضور
        // 0 => الكل، 1 => حضور، 2 => غياب
        if ($request->attendance_status == 1) {
            $query->where('attendance_status', 1); // الحاضرين فقط
        } elseif ($request->attendance_status == 2) {
            $query->where('attendance_status', 0); // الغياب فقط
        }

        $Students = $query->get();

        return view('dashboard.pages.teachers.dashboard.students.attendance_report', 
        compact('Students', 'students'));
    }

    public function getClasses($id)
    {
        $classes = Classe::where("grade_id", $id)->pluck("classe_name", "id");
        return response()->json($classes);
    }

    public function getSections($id)
    {
        $sections = Section::where("classe_id", $id)->pluck("name_section", "id");
        return response()->json($sections);
    }
}