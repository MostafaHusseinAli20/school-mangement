<?php

namespace App\Http\Controllers\Dashboard\Fees;

use App\Http\Controllers\Controller;
use App\Interfaces\Fees\FeeInvoiceInterface;
use Illuminate\Http\Request;

class FeeInvoiceController extends Controller
{
    private $feeInvoiceInterface;

    public function __construct(FeeInvoiceInterface $feeInvoiceInterface)
    {
        $this->feeInvoiceInterface = $feeInvoiceInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->feeInvoiceInterface->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->feeInvoiceInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->feeInvoiceInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->feeInvoiceInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->feeInvoiceInterface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->feeInvoiceInterface->destroy($id);
    }
}
