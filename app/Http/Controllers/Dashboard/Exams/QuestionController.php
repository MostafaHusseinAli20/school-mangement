<?php

namespace App\Http\Controllers\Dashboard\Exams;

use App\Http\Controllers\Controller;
use App\Interfaces\Exams\QuestionInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $questionInterface;
    public function __construct(QuestionInterface $questionInterface)
    {
        $this->questionInterface = $questionInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->questionInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->questionInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->questionInterface->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->questionInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->questionInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->questionInterface->destroy($id);
    }
}
