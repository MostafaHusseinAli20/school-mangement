<?php

namespace App\Repositories\Teachers\Dashboard;

use App\Interfaces\Teachers\Dashboard\TeacherQuizzQuestionInterface;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherQuizzQuestionRepository implements TeacherQuizzQuestionInterface
{
    public function index()
    {
        return view('dashboard.pages.teachers.dashboard.quizzes.questions.index',[
            'questions' => Question::with('quizze')
                ->whereHas('quizze', function ($query) {
                    $query->where('teacher_id', auth()->guard('teacher')->user()->id);
                })->get(),
            'quizzes' => Quizze::where('teacher_id', auth()->guard('teacher')->user()->id)->get()
        ]);
    }

    public function create($quizze_id)
    {
        return view('dashboard.pages.teachers.dashboard.quizzes.questions.create', [
            'quizze_id'  => $quizze_id
        ]);
    }

    public function store(Request $request, $quizze_id)
    {
        $request->validate([
            'List_Questions.*.title' => 'required|string',
            'List_Questions.*.answers' => 'required|string|regex:/-/',
            'List_Questions.*.right_answer' => 'required|string',
            'List_Questions.*.score' => 'required|numeric',
        ],[
            'List_Questions.*.title.required' => __('trans.title_required'),
            'List_Questions.*.answers.required' => __('trans.answers_required'),
            'List_Questions.*.right_answer.required' => __('trans.right_answer_required'),
            'List_Questions.*.score.required' => __('trans.score_required'),
            'List_Questions.*.answers.regex' => __('trans.warning_question'),
        ]);

        $List_Questions = $request->List_Questions;
        DB::beginTransaction();

        try {
            foreach ($List_Questions as $List_Question) {
                Question::create([
                    'title' => $List_Question['title'],
                    'answers' => $List_Question['answers'],
                    'right_answer' => $List_Question['right_answer'],
                    'score' => $List_Question['score'],
                    'quizze_id' => $quizze_id,
                    'type' => 'quizz'
                ]);
            }
            DB::commit();
            toastr()->success(__('trans.message_added_successfully'));
            return redirect()->route('teacher.quizzes.questions.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show()
    {
        //TODO:implement show
    }

    public function edit($id)
    {
        return view('dashboard.pages.teachers.dashboard.quizzes.questions.edit',[
            'question' => Question::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $question = Question::findOrFail($id);
            $question->update([
                'title' => $request->title,
                'answers' => $request->answers,
                'right_answer' => $request->right_answer,
                'score' => $request->score
            ]);

            DB::commit();
            toastr()->success(__('trans.message_added_successfully'));
            return redirect()->route('teacher.quizzes.questions.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        toastr()->success(__('trans.message_deleted_question'));
        return redirect()->route('teacher.quizzes.questions.index');
    }

    public function searchQuizzes(Request $request)
    {
        if($request->quizze_id == 0)
            {
                $quizzes = Question::with('quizze')
                ->whereHas('quizze', function ($query) {
                    $query->where('teacher_id', auth()->guard('teacher')->user()->id);
                })->get();
            }else{
                $quizzes = Question::where('quizze_id', $request->quizze_id)->get();
            }
        return response()->json($quizzes);
    }
}