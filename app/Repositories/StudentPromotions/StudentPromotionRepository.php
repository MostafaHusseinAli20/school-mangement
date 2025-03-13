<?php

namespace App\Repositories\StudentPromotions;

use App\Interfaces\Students\StudentPromotionsInterface;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionsInterface
{
    public function index()
    {
        $grades = Grade::get();
        return view('dashboard.pages.students.promotions.index', compact('grades'));
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $students = Student::where('grade_id', $request->grade_id)
                ->where('classe_id', $request->classe_id)
                ->where('section_id', $request->section_id)
                ->get()
                ->setHidden([
                    'password',
                ]);

            if ($students->count() < 1) {
                return redirect()->back()->withErrors(['error_promotions' => __('trans.error_promotions')]);
            }

            // update in student table
            foreach ($students as $student) {
                $ids = explode(',', $student->id);
                Student::whereIn('id', $ids)
                    ->update([
                        'grade_id' => $request->grade_id_new,
                        'classe_id' => $request->classe_id_new,
                        'section_id' => $request->section_id_new
                    ]);


                // insert in promotion table
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->grade_id,
                    'from_classe' => $request->classe_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->grade_id_new,
                    'to_classe' => $request->classe_id_new,
                    'to_section' => $request->section_id_new
                ]);
            }
            DB::commit();
            toastr()->success(trans('trans.message_promotion_successfuly'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id) {}
    public function destroy($id) {}
}
