<?php

namespace App\Repositories\Students\ReceiptStudent;

use App\Interfaces\Students\ReceiptStudentInterface;
use App\Models\FundAccounts;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccounts;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentInterface
{
    public function index()
    {
        $receipt_students = ReceiptStudent::get();
        return view('dashboard.pages.students.receipt.index', compact('receipt_students'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            // insert in receipt students table (1 step)
            $receipt_students = ReceiptStudent::create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'debit' => $request->debit,
                'description' => $request->description
            ]);

            // insert in fund accounts table (2 step)
            FundAccounts::create([
                'date' => date('Y-m-d'),
                'receipt_id' => $receipt_students->id,
                'debit' => $request->debit,
                'credit' => 0.00,
                'description' => $request->description
            ]);

            // insert in student accaounts table (3 step)
            StudentAccounts::create([
                'date' => date('Y-m-d'),
                'type' => 'receipt',
                'debit' => 0.00,
                'credit' => $request->debit,
                'description' => $request->description,
                'student_id' => $request->student_id,
                'receipt_id' => $receipt_students->id,
                'grade_id' => $request->grade_id,
                'classe_id' => $request->classe_id
            ]);

            DB::commit();
            toastr()->success(__('trans.message_added_receipt'));
            return redirect()->route('student-receipt.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('dashboard.pages.students.receipt.add', compact('student'));
    }

    public function edit($id)
    {
        $receipt_student = ReceiptStudent::findOrFail($id);
        return view('dashboard.pages.students.receipt.edit', compact('receipt_student'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            
            // insert in receipt students table (1 step)
            $receipt_students = ReceiptStudent::findOrFail($request->id);
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->debit = $request->debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            // insert in fund accounts table (2 step)
            $fund_accounts = FundAccounts::where('receipt_id', $request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_students->id;
            $fund_accounts->debit = $request->debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // insert in student accaounts table (3 step)
            $student_accounts = StudentAccounts::where('receipt_id', $request->id)->first();
            $student_accounts->date = date('Y-m-d');
            $student_accounts->type = 'receipt';
            $student_accounts->student_id = $request->student_id;
            $student_accounts->receipt_id = $receipt_students->id;
            $student_accounts->debit = 0.00;
            $student_accounts->credit = $request->debit;
            $student_accounts->description = $request->description;
            $student_accounts->save();

            DB::commit();
            toastr()->success(__('trans.message_updated_receipt'));
            return redirect()->route('student-receipt.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $receipt_student = ReceiptStudent::findOrFail($id);
        $receipt_student->delete();
        toastr()->error(__('trans.message_deleted_receipt'));
        return back();
    }
}