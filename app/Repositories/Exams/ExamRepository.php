<?php

namespace App\Repositories\Exams;

use App\Interfaces\Exams\ExamInterface;
use App\Models\exam;
use Illuminate\Support\Facades\DB;

class ExamRepository implements ExamInterface
{
    public function index()
    {
        $exams = exam::get();
        return view('dashboard.pages.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('dashboard.pages.exams.create');
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            exam::create([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                
                'term' => $request->term,
                'academic_year' => $request->academic_year,
            ]);

            DB::commit();
            toastr()->success(__('trans.message_added_exam'));
            return redirect()->route('exams.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',  $e->getMessage());
        }
    }

    public function edit($id)
    {
        $exam = exam::findOrFail($id);
        return view('dashboard.pages.exams.edit', compact('exam'));
    }

    public function update($request, $id)
    {
        try {
            $exam =exam::findOrFail($id);
            $exam->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                
                'term' => $request->term,
                'academic_year' => $request->academic_year,
            ]);

            toastr()->success(__('trans.message_updated_exam'));
            return redirect()->route('exams.index');

        } catch (\Exception $e) {
            return back()->with('error',  $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            exam::findOrFail($id)->delete();

            toastr()->error(__('trans.message_deleted_exam'));
            return redirect()->route('exams.index');

        } catch (\Exception $e) {
            return back()->with('error',  $e->getMessage());
        }
    }
}