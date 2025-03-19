<?php

namespace App\Repositories\Students\StudentGraduate;

use App\Interfaces\Students\StudentGraduateInterface;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentGraduateRepository implements StudentGraduateInterface
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('dashboard.pages.students.graduated.index', compact('students'));
    }

    public function create()
    {
        $grades = Grade::get();
        return view('dashboard.pages.students.graduated.create', compact('grades'));
    }

    public function softDelete($request)
    {
        DB::beginTransaction();
        try {
            $students = Student::where('grade_id', $request->grade_id)
                ->where('classe_id', $request->classe_id)
                ->where('section_id', $request->section_id)
                ->get();

            if ($students->count() < 1) {
                return back()->withErrors(['error' => __('trans.error_Graduated')]);
            }

            foreach ($students as $student) {
                $ids = explode(',', $student->id);
                Student::whereIn('id', $ids)->delete();
            }

            DB::commit();
            toastr()->success(trans('trans.message_success'));
            return redirect()->route('student-graduate.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function returnData($id)
    {
        Student::onlyTrashed()->where('id', $id)->first()->restore();
        toastr()->success(trans('trans.message_success_restore_student'));
        return redirect()->route('students.index');
    }

    public function destroy($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->forceDelete();
        toastr()->error(trans('trans.message_delete_student_graduate'));
        return back();
    }
}
