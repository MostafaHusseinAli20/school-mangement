<?php

namespace App\Http\Middleware;

use App\Models\Answer;
use App\Models\Question;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventRetakeExam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $student = auth()->guard('student')->user();

        $quizzeId = $request->route('quizze_id');

        // نجيب كل الأسئلة بتاعة الامتحان ده
        $questionIds = Question::where('quizze_id', $quizzeId)->pluck('id');

        // نشوف لو الطالب جاوب أي إجابة تخص الامتحان ده
        $answers = Answer::where('student_id', $student->id)
            ->whereIn('question_id', $questionIds)
            ->exists();

        if($answers) {
            abort(Response::HTTP_FORBIDDEN, __('trans.message_already_answered'));
        }

        return $next($request);
    }
}
