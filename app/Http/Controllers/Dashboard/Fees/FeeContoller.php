<?php

namespace App\Http\Controllers\Dashboard\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Fees\FeeRequest;
use App\Interfaces\Fees\FeeInterface;
use Illuminate\Http\Request;

class FeeContoller extends Controller
{
    private $feeInterface;

    public function __construct(FeeInterface $feeInterface)
    {
        $this->feeInterface = $feeInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->feeInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->feeInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeeRequest $request)
    {
        return $this->feeInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->feeInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->feeInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeeRequest $request, string $id)
    {
        return $this->feeInterface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->feeInterface->destroy($id);
    }
}
