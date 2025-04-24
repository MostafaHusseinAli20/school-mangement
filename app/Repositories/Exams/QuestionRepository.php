<?php

namespace App\Repositories\Exams;

use App\Interfaces\Exams\QuestionInterface;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionInterface
{
    public function index()
    {
        $questions = Question::get();
        return view('dashboard.pages.exams.questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizze::get();
        return view('dashboard.pages.exams.questions.create', compact('quizzes'));
    }

    public function store($request)
    {
        $List_Questions = $request->List_Questions;
        DB::beginTransaction();

        try {
            foreach($List_Questions as $List_Question) {
                // Save Data in Questions Table
                Question::create([
                    'title' => $List_Question['title'],
                    'answers' => $List_Question['answers'],
                    'right_answer' => $List_Question['right_answer'],
                    'score' => $List_Question['score'],
                    'quizze_id' => $List_Question['quizze_id'],
                ]);
            }

            DB::commit();
            toastr()->success(__('trans.message_added_question'));
            return redirect()->route('questions.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $quizzes = Quizze::get();
        return view('dashboard.pages.exams.questions.edit', compact('question', 'quizzes'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            Question::findOrFail($id)->update([
                'title' => $request->title,
                'answers' => $request->answers,
                'right_answer' => $request->right_answer,
                'score' => $request->score,
                'quizze_id' => $request->quizze_id,
            ]);
            DB::commit();
            toastr()->success(__('trans.message_updated_question'));
            return redirect()->route('questions.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            Question::findOrFail($id)->delete();
            toastr()->success(__('trans.message_updated_question'));
            return redirect()->route('questions.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }

}