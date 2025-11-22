<?php

namespace App\Repositories\Fees;

use App\Interfaces\Fees\FeeInvoiceInterface;
use App\Models\Fee;
use App\Models\FeeInvocie;
use App\Models\Student;
use App\Models\StudentAccounts;
use Illuminate\Support\Facades\DB;

class FeeInvoiceRepository implements FeeInvoiceInterface
{
    public function index()
    {
        $feeInvoices = FeeInvocie::get();
        return view('dashboard.pages.feeInvoices.index', compact('feeInvoices'));
    }

    public function store($request)
    {

        $List_Fees = $request->List_Fees;
        DB::beginTransaction();

        try {
            foreach ($List_Fees as $List_Fee) { 
                // Save Data in Fee Invoices Table
                FeeInvocie::create([
                    'invoice_date' => date('Y-m-d'),
                    'amount' => $List_Fee['amount'],
                    'description' => $List_Fee['description'],
                    'student_id' => $List_Fee['student_id'],
                    'grade_id' => $request->grade_id,
                    'classe_id' => $request->classe_id,
                    'fee_id' => $List_Fee['fee_id']
                ]);

                // Save Data in Student Accaounts Table
                StudentAccounts::create([
                    'date' => date('Y-m-d'),
                    'student_id' => $List_Fee['student_id'],
                    'grade_id' => $request->grade_id,
                    'classe_id' => $request->classe_id,
                    'debit' => $List_Fee['amount'],
                    'credit' => 0.00,
                    'description' => $List_Fee['description']
                ]);
            }

            DB::commit();
            toastr()->success(__('trans.message_added_fee_invoice'));
            return redirect()->route('fee-invoices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('classe_id', $student->classe_id)->get();

        return view('dashboard.pages.feeInvoices.add', compact('student', 'fees'));
    }

    public function edit($id)
    {
        $fee_invoice = FeeInvocie::findOrFail($id);
        $fees = Fee::where('classe_id', $fee_invoice->classe_id)->get();
        return view('dashboard.pages.feeInvoices.edit', compact('fee_invoice', 'fees'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $fee_invoice = FeeInvocie::findOrFail($id);

            // Update Data in Student Accaounts Table
            StudentAccounts::where('student_id', $fee_invoice->student_id)
                ->where('debit', $fee_invoice->amount)
                ->where('description', $fee_invoice->description)
                ->update([
                    'debit' => $request->amount,
                    'description' => $request->description
                ]);

            // Update Data in Fee Invoices Table
            $fee_invoice->update([
                'amount' => $request->amount,
                'description' => $request->description,
                'fee_id' => $request->fee_id
            ]);

            DB::commit();
            toastr()->success(__('trans.message_updated_fee_invoice'));
            return redirect()->route('fee-invoices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $fee_invoice = FeeInvocie::findOrFail($id);

        $student_id = $fee_invoice->student_id;

        StudentAccounts::where('student_id', $student_id)
            ->where('debit', $fee_invoice->amount)
            ->where('description', $fee_invoice->description)
            ->delete();

        $fee_invoice->delete();

        toastr()->error(__('trans.message_deleted_fee_invoice'));
        return redirect()->route('fee-invoices.index');
    }
}
