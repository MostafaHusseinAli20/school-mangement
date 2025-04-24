<?php

namespace App\Repositories\Attendances;

use App\Interfaces\Attendances\AttendanceInterface;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class AttendanceRepository implements AttendanceInterface
{
    public function index()
    {
        $grades = Grade::with(['sections'])->get();
        $list_grades = Grade::get();
        return view('dashboard.pages.attendances.sections', compact('grades', 'list_grades'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {

            foreach($request->attendences as $studentId => $attendence){
                if( $attendence == 'presence' ) {
                    $attendance_status = true;
                } else if( $attendence == 'absent' ){
                    $attendance_status = false;
                }
            
            Attendance::create([
                'attendance_date' => date('Y-m-d'),
                'attendance_status' => $attendance_status,
                'student_id' => $studentId,
                'grade_id' => $request->grade_id,
                'section_id' => $request->section_id,
                'classe_id' => $request->classe_id,
                'teacher_id' => 1,
            ]);
        }

        DB::commit();
        toastr()->success(__('trans.message_attendence'));
        return back();

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('dashboard.pages.attendances.index', compact('students'));  
    }
}