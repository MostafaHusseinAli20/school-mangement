<?php

namespace App\Repositories\Fees;

use App\Interfaces\Fees\ProcessingFeeInterface;
use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccounts;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeInterface
{
    public function index()
    {
        $processingFees = ProcessingFee::get();
        return view('dashboard.pages.fees.processingFees.index', compact('processingFees'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {

            // insert processing fee
            $processingFee = ProcessingFee::create([
                'student_id' => $request->student_id,
                'amount' => $request->debit,
                'date' => date('Y-m-d'),
                'description' => $request->description,
            ]);

            // inster in student account table
            StudentAccounts::create([
                'student_id' => $request->student_id,
                'date' => date('Y-m-d'),
                'type' => 'processingFee',
                'debit' => 0.00,
                'credit' => $request->debit,
                'processing_id' => $processingFee->id,
                'description' => $request->description,
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id,
            ]);

            DB::commit();
            toastr()->success(__('trans.message_added_processing_fee'));
            return redirect()->route('processing-fees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('dashboard.pages.fees.processingFees.add', compact('student'));
    }

    public function edit($id)
    {
        $processingFee = ProcessingFee::findOrFail($id);
        return view('dashboard.pages.fees.processingFees.edit', compact('processingFee'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {

            // update processing fee
            $processingFee = ProcessingFee::findOrFail($id);
            $processingFee->update([
                'student_id' => $request->student_id,
                'amount' => $request->debit,
                'date' => date('Y-m-d'),
                'description' => $request->description,
            ]);

            // update student account table
            $studentAccount = StudentAccounts::where('processing_id', $id)->first();
            $studentAccount->update([
                'student_id' => $request->student_id,
                'date' => date('Y-m-d'),
                'type' => 'processingFee',
                'debit' => 0.00,
                'credit' => $request->debit,
                'processing_id' => $processingFee->id,
                'description' => $request->description
            ]);

            DB::commit();
            toastr()->success(__('trans.message_updated_processing_fee'));
            return redirect()->route('processing-fees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $processingFee = ProcessingFee::findOrFail($id);
            $processingFee->delete();

            StudentAccounts::where('processing_id', $id)->delete();

            DB::commit();
            toastr()->error(__('trans.message_deleted_processing_fee'));
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
