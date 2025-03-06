<?php

namespace App\Repositories\Classes;

use App\Http\Controllers\Dashboard\Sections\SectionsController;
use App\Models\Classe;
use App\Models\Grade;

class ClasseRepository
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::get();
        $grades = Grade::get();
        return view('dashboard.pages.classes.index', compact('classes', 'grades'));
    }

    public function show(string $id)
    {
        return app(SectionsController::class)->getclasses($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $classes_list = $request->classes_list;

        try {

            $data = [];

            foreach ($classes_list as $classe) {
                $data[] = [
                    'classe_name' => json_encode([
                        'en' => $classe['classe_name_en'],
                        'ar' => $classe['classe_name']
                    ]),
                    'grade_id' => $classe['grade_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($data)) {
                Classe::insert($data);
            }

            toastr()->success(__('trans.message_added_classe'));
            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request)
    {
        try {
            $classe = Classe::findOrFail($request->id);
            $classe->update([
                $classe->classe_name = ['ar' => $request->classe_name, 'en' => $request->classe_name_en],
                $classe->grade_id = $request->grade_id,
            ]);

            toastr()->success(__('trans.message_updated_classe'));
            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classe = Classe::find($id);
        $classe->delete();
        toastr()->error(__('trans.message_deleted_classe'));
        return back();
    }

    public function delete_all($request)
    {
        try {
            $delete_all_id = explode(',', $request->delete_all_id);
            Classe::whereIn('id', $delete_all_id)->delete();
            toastr()->error(__('trans.message_deleted_classe'));
            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function filter_classe($request)
    {
        try {
            $grades = Grade::all();
            $serach = Classe::select('*')->where('grade_id', '=', $request->grade_id)->get();
            return view('dashboard.pages.classes.index', compact('grades'))->withDetails($serach);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
