<?php

namespace App\Repositories\Fees;

use App\Interfaces\Fees\FeeInterface;
use App\Models\Classe;
use App\Models\Fee;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class FeeRepository implements FeeInterface
{
    public function index()
    {
        $fees = Fee::get();
        return view('dashboard.pages.fees.index', compact('fees'));
    }

    public function create()
    {
        $grades = Grade::get();
        return view('dashboard.pages.fees.create', compact('grades'));
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            Fee::create([
                'title' => [
                    'ar' => $request->title_ar,
                    'en' => $request->title_en
                ],

                'amount' => $request->amount,
                'description' => $request->description,
                'year' => $request->year,
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
                'fee_type' => $request->fee_type,
            ]);

            DB::commit();
            toastr()->success(__('trans.message_added_fee'));
            return redirect()->route('fees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {

        $fee = Fee::findOrFail($id);

        // Filter by Grades & Classes
        $students = Student::where('grade_id', $fee->grade_id)
        ->where('classe_id', $fee->classe_id)
        ->get();

        return view('dashboard.pages.fees.show', compact('fee', 'students'));
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $grades = Grade::get();
        return view('dashboard.pages.fees.edit', compact('fee', 'grades'));
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $fee = Fee::findOrFail($id);

            $fee->update([
                'title' => [
                    'ar' => $request->title_ar,
                    'en' => $request->title_en
                ],

                'amount' => $request->amount,
                'description' => $request->description,
                'year' => $request->year,
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id
            ]);

            DB::commit();
            toastr()->success(__('trans.message_updated_fee'));
            return redirect()->route('fees.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $fee = Fee::findOrFail($id);
        $fee->delete();
        toastr()->error(__('trans.message_deleted_fee'));
        return back();
    }
}
