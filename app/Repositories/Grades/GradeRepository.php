<?php

namespace App\Repositories\Grades;

use App\Interfaces\Grades\GradeInterface;
use App\Models\Classe;
use App\Models\Grade;

class GradeRepository implements GradeInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::get();
        return view('dashboard.pages.grades.index', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        if (Grade::where('name->ar', $request->name)->orWhere('name->en', $request->name_en)->exists()) {
            return back()->withErrors(['error' => __('trans.grade_name_unique')]);
        }

        try {
            Grade::create([
                'name' => ['en' => $request->name_en, 'ar' => $request->name],
                'notes' => $request->notes
            ]);

            toastr()->success(__('trans.message_added_grade'));
            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        $grade = Grade::find($id);
        $grade->update([
            'name' => ['en' => $request->name_en, 'ar' => $request->name],
            'notes' => $request->notes
        ]);
        toastr()->success(__('trans.message_updated_grade'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($request)
    {
        $myClasse = Classe::where('grade_id', $request->id)->pluck('grade_id');
        if ($myClasse->count() == 0) {
            $grade = Grade::find($request->id);
            $grade->delete();
            toastr()->success(__('trans.message_deleted_grade'));
            return back();
        }
        toastr()->error(__('trans.grade_delete_erorr'));
        return back();
    }
}
