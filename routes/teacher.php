<?php

use App\Http\Controllers\Dashboard\Teachers\Dashboard\TeacherStudentController;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware'
        => [
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'auth:teacher',
        ]
    ],
    function () {

        Route::get('/teacher/dashboard', function () {
            $teacher_id = auth()->guard('teacher')->user()->id;
            $ids = Teacher::findOrFail($teacher_id)->sections()->pluck('section_id');
            $sections_count = $ids->count(); // Count the number of sections
            $students_count = Student::whereIn('section_id', $ids)->count(); // Initialize student count

            return view('dashboard.pages.teachers.dashboard.dashboard', compact('sections_count', 'students_count'));
        });

        Route::group(['prefix' => 'teachers'], function () {
            Route::get('/students', [TeacherStudentController::class, 'index'])->name('teacher.students');
            Route::get('/sections', [TeacherStudentController::class, 'sections'])->name('teacher.sections');
        });
    }
);
