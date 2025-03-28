<?php

namespace App\Http\Controllers\Dashboard\Exams;

use App\Http\Controllers\Controller;
use App\Interfaces\Exams\ExamInterface;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    private $examInterface;
    public function __construct(ExamInterface $examInterface)
    {
        $this->examInterface = $examInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->examInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->examInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->examInterface->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->examInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->examInterface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->examInterface->destroy($id);
    }
}
