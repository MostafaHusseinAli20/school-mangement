<?php

namespace App\Http\Controllers\Dashboard\Exams;

use App\Http\Controllers\Controller;
use App\Interfaces\Exams\QuizzeInterface;
use Illuminate\Http\Request;

class QuizzeController extends Controller
{
    private $quizzeInterface;
    public function __construct(QuizzeInterface $quizzeInterface)
    {
        $this->quizzeInterface = $quizzeInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->quizzeInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->quizzeInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->quizzeInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->quizzeInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->quizzeInterface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->quizzeInterface->destroy($id);
    }
}
