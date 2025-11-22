<?php

namespace App\Interfaces\Students;

use Illuminate\Http\Request;

interface StudentExamInterface
{
    public function index();
    public function show($quizze_id);
    public function questions($quizze_id);
    public function answers(Request $request);
    public function result($quizze_id);
    public function calculateResult($quizze_id, $student_id);
}
