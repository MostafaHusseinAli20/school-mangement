<?php

namespace App\Http\Middleware;

use App\Models\Answer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Result;

class RedirectPageForbidenIfDosntExam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // لو الطالب عامل Login
        $student = auth('student')->user();

        if (!$student) {
            abort(403, 'Unauthorized');
        }

        // جلب رقم الامتحان من ال route
        $quizId = $request->route('quiz_id');

        // هل الطالب أنهى الامتحان؟ (موجود في جدول النتائج)
        $finishedExam = Result::where('student_id', $student->id)
            ->where('quiz_id', $quizId)
            ->exists();

        if (!$finishedExam) {
            abort(403, __('trans.message_not_allowed'));
        }

        return $next($request);
    }
}
