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

    public function create()
    {
        $promotions = Promotion::get();
        return view('dashboard.pages.students.promotions.management', compact('promotions'));
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
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new
                    ]);


                // insert in promotion table
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->grade_id,
                    'from_classe' => $request->classe_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->grade_id_new,
                    'to_classe' => $request->classe_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year_old' => $request->academic_year_old,
                    'academic_year_new' => $request->academic_year_new,
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

    public function destroy($request)
    {
        DB::beginTransaction();
        try {

            // Rollback for all
            if ($request->page_id == 1) {
                $promotions = Promotion::get();
                foreach ($promotions as $promotion) {
                    $ids = explode(',', $promotion->student_id);

                    // Update Student for old data
                    Student::whereIn('id', $ids)
                        ->update([
                            'grade_id' => $promotion->from_grade,
                            'classe_id' => $promotion->from_classe,
                            'section_id' => $promotion->from_section,
                            'academic_year' => $promotion->academic_year_old
                        ]);

                    // Delete Data in Promotion Table
                    Promotion::truncate();
                }

                // Save
                DB::commit();
                toastr()->error(trans('trans.message_rollback'));
                return back();
            }

            // Rollback for One Student
            else {
                $promotion = Promotion::findOrFail($request->id);

                Student::where('id', $promotion->student_id)
                    ->update([
                        'grade_id' => $promotion->from_grade,
                        'classe_id' => $promotion->from_classe,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->academic_year_old
                    ]);

                Promotion::destroy($request->id);

                // Save
                DB::commit();
                toastr()->error(trans('trans.message_rollback_student'));
                return back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
