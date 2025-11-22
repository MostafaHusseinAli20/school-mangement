<?php

namespace App\Http\Controllers\Dashboard\Students\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Students\StudentExamInterface;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    private $studentExamInterface;
    public function __construct(StudentExamInterface $studentExamInterface)
    {
        $this->studentExamInterface = $studentExamInterface;

        $this->middleware('preventRetakeExam')->only('show');
        $this->middleware('forbidenIfDosntExam')->only('result');
    }

    /**
     * Display a listing of the resource.
    */

    public function index()
    {
        return $this->studentExamInterface->index();
    }

    /**
     * Display the specified resource.
     */
    public function show($quizze_id)
    {
        return $this->studentExamInterface->show($quizze_id);
    }

    public function questions($quizze_id)
    {
        return $this->studentExamInterface->questions($quizze_id);
    }

    public function answers(Request $request)
    {
        return $this->studentExamInterface->answers($request);
    }

    public function result($quizze_id)
    {
        return $this->studentExamInterface->result($quizze_id);
    }

    public function calculateResult($quizze_id, $student_id)
    {
        return $this->studentExamInterface->calculateResult($quizze_id, $student_id);
    }
}
