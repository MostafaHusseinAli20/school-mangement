<?php

namespace App\Repositories\Subjects;

use App\Interfaces\Subjects\SubjectInterface;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class SubjectRepository implements SubjectInterface
{
    public function index()
    {
        $subjects = Subject::get();
        return view('dashboard.pages.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('dashboard.pages.subjects.create', compact('grades', 'teachers'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {

            Subject::create([
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en,
                ],
                
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'teacher_id' => $request->teacher_id,
            ]);

            DB::commit();
            toastr()->success(__('trans.message_added_subject'));
            return redirect()->route('subjects.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('dashboard.pages.subjects.edit', compact('subject', 'grades', 'teachers'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $subject = Subject::findOrFail($id);
            $subject->update([
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en,
                ],
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'teacher_id' => $request->teacher_id,
            ]);
            DB::commit();
            toastr()->success(__('trans.message_updated_subject'));
            return redirect()->route('subjects.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $subject = Subject::findOrFail($id);
            $subject->delete();
            toastr()->success(__('trans.message_deleted_subject'));
            return back();
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}