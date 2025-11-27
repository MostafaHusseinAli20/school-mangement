<?php

namespace App\Repositories\Parents;

use App\Interfaces\Parents\ParentResultStudentInterface;
use App\Models\Student;
use App\Models\Result;

class ParentResultStudentRepository implements ParentResultStudentInterface
{
    public function result($id)
    {
        $student = Student::findOrFail($id);
        if($student->parent_id != auth()->guard('parent')->user()->id){
            abort(403, __('trans-parent.message_forbidden'));
        }
        $results = Result::where('student_id', $id)->get();

        return view('dashboard.pages.parents.results.result_student',[
            'results' => $results
        ]);
    }
}