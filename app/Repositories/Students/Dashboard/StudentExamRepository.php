<?php

namespace App\Repositories\Students\Dashboard;

use App\Interfaces\Students\StudentExamInterface;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Result;

class StudentExamRepository implements StudentExamInterface
{
    public function index()
    {
        $quizzes = Quizze::where('grade_id', auth()->guard('student')->user()->grade_id)->
            where('classe_id', auth()->guard('student')->user()->classe_id)->
            where('section_id', auth()->guard('student')->user()->section_id)
            ->get();
        return view('dashboard.pages.students.dashboard.exams.index', [
            'quizzes' => $quizzes,
            'answer' => Answer::where('student_id', Auth::guard('student')->user()->id)->first(),
            'result' => Result::where('student_id', Auth::guard('student')->user()->id)->first()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($quizze_id)
    {
        $student_id = Auth::guard('student')->user()->id;
        return view('dashboard.pages.students.dashboard.exams.show', [
            'quizze_id' => $quizze_id,
            'student_id' => $student_id
        ]);
    }

    public function questions($quizze_id)
    {
        $questions = Question::where('quizze_id', $quizze_id)->get();
        return response()->json([
            'questions' => $questions
        ]);
    }

    public function answers(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.answer' => 'required|string|max:255',
        ]);
        DB::beginTransaction();
        try {
            foreach ($request->answers as $ans) {
                Answer::updateOrCreate(
                    [
                        'student_id' => $request->student_id,
                        'question_id' => $ans['question_id'],
                    ],
                    [
                        'answer' => $ans['answer'],
                    ]
                );
            }

            DB::commit();
            $this->calculateResult($request->quizze_id, $request->student_id);
            return response()->json([
                'success' => true,
                'message' => 'success'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function result($quizze_id)
    {
        $result = Result::with(['student', 'quizze'])
            ->where('quiz_id', $quizze_id)
            ->where('student_id', Auth::guard('student')->user()->id)->first();
        $quizze = Quizze::findOrFail($quizze_id);
        return view('dashboard.pages.students.dashboard.exams.resualt.show', compact(
            'quizze_id',
            'result',
                       'quizze'
        ));
    }

    public function calculateResult($quizze_id, $student_id)
    {
        request()->validate([
            'quizze_id' => 'required|exists:quizzes,id',
            'student_id' => 'required|exists:students,id'
        ]);

        $questions = Question::where('quizze_id', $quizze_id)->get();
        $answers = Answer::where('student_id', $student_id)
            ->whereHas('question', function ($query) use ($quizze_id) {
                $query->where('quizze_id', $quizze_id);
            })
            ->get()
            ->keyBy('question_id');

        $correct = 0;
        $studentScore = 0;
        $totalScore = $questions->sum('score');

        foreach ($questions as $question) {
            if (isset($answers[$question->id])) {
                $studentAnswer = $answers[$question->id]->answer;
                if (trim(strtolower($studentAnswer)) == trim(strtolower($question->right_answer))) {
                    $correct++;
                    $studentScore += $question->score; // إجابة صحيحة = ياخد درجة السؤال
                }
            }
        }

        $wrong = $questions->count() - $correct;
        $percentage = round(($studentScore / $totalScore) * 100, 2);
        $status = $percentage >= 50 ? 'passed' : 'failed';

        Result::updateOrCreate(
            [
                'student_id' => $student_id, 
                'quiz_id' => $quizze_id
            ],
            [
                'total_questions' => $questions->count(),
                'total_score' => $totalScore,
                'student_score' => $studentScore,
                'correct_answers' => $correct,
                'wrong_answers' => $wrong,
                'percentage' => $percentage,
                'status' => $status,
                'submitted_at' => now(),
            ]
        );

        return response()->json([
            'message' => 'تم حساب النتيجة بنجاح',
            'correct' => $correct,
            'wrong' => $wrong,
            'total_score' => $totalScore,
            'student_score' => $studentScore,
            'percentage' => $percentage,
            'status' => $status,
        ]);
    }
}