<?php

namespace App\Interfaces\Teachers\Dashboard;

use Illuminate\Http\Request;

interface TeacherQuizzeInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function show($id);
    public function update(Request $request, $id);
    public function destroy(Request $request);
    public function countStudentsExams($id);
    public function getStatusResults(Request $request);
    public function cancelledExamForStudent($qizze_id, $student_id);
}
