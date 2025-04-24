<?php

namespace App\Repositories\Exams;

use App\Interfaces\Exams\QuizzeInterface;
use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class QuizzeRepository implements QuizzeInterface
{
    public function index()
    {
        $quizzes = Quizze::get();
        return view('dashboard.pages.exams.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        $subjects = Subject::get();
        return view('dashboard.pages.exams.quizzes.create', compact('grades', 'teachers', 'subjects'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            Quizze::create([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                'grade_id' => $request->grade_id,
                'subject_id' => $request->subject_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
                'teacher_id' => $request->teacher_id,
            ]);

            DB::commit();
            // Toastr message for success
            toastr()->success(__('trans.message_added_quizze'));
            return redirect()->route('quizzes.index');

        } catch (\Exception $e) {
            DB::rollBack();
            // Toastr message for error
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        $subjects = Subject::get();
        $quizz = Quizze::findOrFail($id);
        return view('dashboard.pages.exams.quizzes.edit', 
        compact('quizz', 'grades', 'teachers', 'subjects'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $quizze = Quizze::findOrFail($id);
            $quizze->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],

                'term' => $request->term,
                'academic_year' => $request->academic_year,
                'grade_id' => $request->grade_id,
                'subject_id' => $request->subject_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
                'teacher_id' => $request->teacher_id,
            ]);
            
            DB::commit();
            // Toastr message for success
            toastr()->success(__('trans.message_updated_quizze'));
            return redirect()->route('quizzes.index');

        } catch (\Exception $e) {
            DB::rollBack();
            // Toastr message for error
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $quizze = Quizze::findOrFail($id);
            $quizze->delete();

            // Toastr message for success
            toastr()->success(__('trans.message_deleted_quizze'));
            return redirect()->route('quizzes.index');

        } catch (\Exception $e) {

            // Toastr message for error
            toastr()->error($e->getMessage());
            return back();
        }
    }
}