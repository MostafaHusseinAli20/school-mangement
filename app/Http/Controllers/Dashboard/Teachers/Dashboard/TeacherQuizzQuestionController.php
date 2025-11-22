<?php

namespace App\Http\Controllers\Dashboard\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Teachers\Dashboard\TeacherQuizzQuestionInterface;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherQuizzQuestionController extends Controller
{
    private $teacherQuizzQuestionInterface;
    public function __construct(TeacherQuizzQuestionInterface $teacherQuizzQuestionInterface)
    {
        $this->teacherQuizzQuestionInterface = $teacherQuizzQuestionInterface;
    }

    public function index()
    {
        return $this->teacherQuizzQuestionInterface->index();
    }

    public function create($quizze_id)
    {
        return $this->teacherQuizzQuestionInterface->create($quizze_id);
    }

    public function store(Request $request, $quizze_id)
    {
        return $this->teacherQuizzQuestionInterface->store($request, $quizze_id);
    }

    public function show()
    {
        return $this->teacherQuizzQuestionInterface->show();
    }

    public function edit($id)
    {
        return $this->teacherQuizzQuestionInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->teacherQuizzQuestionInterface->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->teacherQuizzQuestionInterface->destroy($id);
    }

    public function searchQuizzes(Request $request)
    {
        return $this->teacherQuizzQuestionInterface->searchQuizzes($request);
    }
}