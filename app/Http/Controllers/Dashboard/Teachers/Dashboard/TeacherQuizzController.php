<?php

namespace App\Http\Controllers\Dashboard\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Teachers\Dashboard\TeacherQuizzeInterface;
use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Result;

class TeacherQuizzController extends Controller
{
    private $teacherQuizzeInterface;
    public function __construct(TeacherQuizzeInterface $teacherQuizzeInterface)
    {
        $this->teacherQuizzeInterface = $teacherQuizzeInterface;
    }

    public function index()
    {
        return $this->teacherQuizzeInterface->index();
    }

    public function create()
    {
        return $this->teacherQuizzeInterface->create();
    }

    public function store(Request $request)
    {
        return $this->teacherQuizzeInterface->store($request);
    }

    public function show($id)
    {
        return $this->teacherQuizzeInterface->show($id);
    }

    public function edit($id)
    {
        return $this->teacherQuizzeInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->teacherQuizzeInterface->update($request, $id);
    }

    public function destroy(Request $request)
    {
        return $this->teacherQuizzeInterface->destroy($request);
    }

    public function countStudentsExams($id)
    {
        return $this->teacherQuizzeInterface->countStudentsExams($id);
    }

    public function getStatusResults(Request $request)
    {
        return $this->teacherQuizzeInterface->getStatusResults($request);
    }

    public function cancelledExamForStudent($qizze_id, $student_id)
    {
        return $this->teacherQuizzeInterface->cancelledExamForStudent($qizze_id, $student_id);
    }
}

