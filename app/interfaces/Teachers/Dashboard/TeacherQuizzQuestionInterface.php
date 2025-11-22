<?php

namespace App\Interfaces\Teachers\Dashboard;

use Illuminate\Http\Request;

interface TeacherQuizzQuestionInterface
{
    public function index();
    public function create($quizze_id);
    public function store(Request $request, $quizze_id);
    public function show();
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy($id);

    public function searchQuizzes(Request $request);
}
