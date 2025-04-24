<?php

namespace App\Http\Controllers\Dashboard\Students\ReceiptStudents;

use App\Http\Controllers\Controller;
use App\Interfaces\Students\ReceiptStudentInterface;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{
    private $receiptStudentInterface;

    public function __construct(ReceiptStudentInterface $receiptStudentInterface)
    {
        $this->receiptStudentInterface = $receiptStudentInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->receiptStudentInterface->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->receiptStudentInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->receiptStudentInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->receiptStudentInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->receiptStudentInterface->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->receiptStudentInterface->destroy($id);
    }
}
