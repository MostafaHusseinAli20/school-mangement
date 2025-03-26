<?php

namespace App\Http\Controllers\Dashboard\Fees;

use App\Http\Controllers\Controller;
use App\Interfaces\Fees\ProcessingFeeInterface;
use Illuminate\Http\Request;

class ProcessingFeeController extends Controller
{
    private $processingFeeInterface;

    public function __construct(ProcessingFeeInterface $processingFeeInterface)
    {
        $this->processingFeeInterface = $processingFeeInterface;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->processingFeeInterface->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->processingFeeInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->processingFeeInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->processingFeeInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->processingFeeInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->processingFeeInterface->destroy($id);
    }
}
