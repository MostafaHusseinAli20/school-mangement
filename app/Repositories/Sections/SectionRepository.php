<?php

namespace App\Repositories\Sections;

use App\Interfaces\Sections\SectionInterface;
use App\Models\Classe;
use App\Models\Grade;
use App\Models\Section;

class SectionRepository implements SectionInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with(['sections'])->get();
        $list_grades = Grade::all();

        return view('dashboard.pages.Sections.index', compact('grades', 'list_grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        try {
            Section::create([
                'name_section' => ['ar' => $request->name_section, 'en' => $request->name_section_en],
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'status' => 1,
            ]);

            toastr()->success(trans('trans.message_sections_store'));
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
        try {
            $section = Section::find($id);
            $section->update([
                'name_section' => ['ar' => $request->name_section, 'en' => $request->name_section_en],
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
            ]);

            if(isset($request->status)){
                $section->status = 1;
            }else{
                $section->status = 0;
            }

            $section->save();

            toastr()->success(trans('trans.message_sections_update'));
            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return back();
    }

    public function getclasses($id)
    {
        $list_classes = Classe::where("grade_id", $id)->pluck("classe_name", "id");
        return $list_classes;
    }
}
