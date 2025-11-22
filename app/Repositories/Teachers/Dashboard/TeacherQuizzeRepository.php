<?php

namespace App\Repositories\Teachers\Dashboard;

use App\Interfaces\Teachers\Dashboard\TeacherQuizzeInterface;
use App\Models\Answer;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Result;

class TeacherQuizzeRepository implements TeacherQuizzeInterface
{
    public function index()
    {
        $quizzes = Quizze::where('teacher_id', auth()->guard('teacher')->user()->id)->get();
        return view('dashboard.pages.teachers.dashboard.quizzes.index', [
            'quizzes' => $quizzes
        ]);
    }

    public function create()
    {
        $teacherId = auth()->guard('teacher')->id();
        $gradeIds = DB::table('teacher_grades')
            ->where('teacher_id', $teacherId)
            ->pluck('grade_id');

        $grades = Grade::whereIn('id', $gradeIds)->get();
        $subjects = Subject::get(); 
        return view('dashboard.pages.teachers.dashboard.quizzes.create',[
            'subjects' => $subjects,
            'grades' => $grades
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Quizze::create([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                'grade_id' => $request->grade_id,
                'subject_id' => $request->subject_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
                'teacher_id' => auth()->guard('teacher')->user()->id,
            ]);

            DB::commit();
            // Toastr message for success
            toastr()->success(__('trans.message_added_quizze'));
            return redirect()->route('quizzes.index');

        } catch (\Exception $e) {
            DB::rollBack();
            // Toastr message for error
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function show($id)
    {
        // TODO:implement show
    }

    public function edit($id)
    {
        $quizze = Quizze::findOrFail($id);
        $grades = Grade::get();
        $subjects = Subject::get();
        return view('dashboard.pages.teachers.dashboard.quizzes.edit', [
            'quizze' => $quizze,
            'grades' => $grades,
            'subjects' => $subjects
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'sometimes|required|string|min:3|max:255',
            'name_en' => 'sometimes|required|string|min:3|max:255',
            'subject_id' => 'sometimes|required|exists:subjects,id',
            'grade_id' => 'sometimes|required|exists:grades,id',
            'classe_id' => 'sometimes|required|exists:classes,id',
            'section_id' => 'sometimes|required|exists:sections,id',
        ]);
        DB::beginTransaction();
        try {
            $quizze = Quizze::findOrFail($id);
            $quizze->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                'grade_id' => $request->grade_id,
                'subject_id' => $request->subject_id,
                'classe_id' => $request->classe_id,
                'section_id' => $request->section_id,
            ]);

            DB::commit();
            // Toastr message for success
            toastr()->success(__('trans.message_updated_quizze'));
            return redirect()->route('quizzes.index');

        } catch (\Exception $e) {
            DB::rollBack();
            // Toastr message for error
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function destroy(Request $request)
    {
        Quizze::findOrFail($request->id)->delete();
        toastr()->success(__('trans.message_deleted_quizze'));
        return redirect()->route('quizzes.index');
    }

    public function countStudentsExams($id)
    {
        $quiz = Quizze::with('results.student')->findOrFail($id);

        return view('dashboard.pages.teachers.dashboard.quizzes.count-students-exams', [
            'results' => $quiz->results,
            'quiz' => $quiz
        ]);
    }

    public function getStatusResults(Request $request)
    {
        if ($request->status == 0) {
            $results = Result::where('quiz_id', $request->quiz_id)
                ->with('student')
                ->get();

        } elseif ($request->status == 'passed') {
            $results = Result::where('quiz_id', $request->quiz_id)
                ->where('status', 'passed')
                ->with('student')
                ->get();

        } else {
            $results = Result::where('quiz_id', $request->quiz_id)
                ->where('status', 'failed')
                ->with('student')
                ->get();
        }

        return response()->json($results);
    }

    public function cancelledExamForStudent($quiz_id, $student_id)
    {
        $questionIds = Question::where('quizze_id', $quiz_id)->pluck('id');
        Answer::where('student_id', $student_id)
            ->whereIn('question_id', $questionIds)
            ->delete();

        Result::where('quiz_id', $quiz_id)
            ->where('student_id', $student_id)
            ->delete();

        toastr()->success(__('trans.message_cancelled_exam'));
        return redirect()->route('teacher.quizzes.count.exam', $quiz_id);
    }
}