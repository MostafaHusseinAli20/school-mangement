<?php

use App\Http\Controllers\Dashboard\Students\Dashboard\StudentExamController;
use App\Http\Controllers\Dashboard\Students\Dashboard\StudentMainController;
use App\Http\Controllers\Dashboard\Students\Dashboard\StudentProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => 
        [
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'auth:student',
        ]
    ],
    function () {
        Route::group(['prefix' => 'students'], function () {
            Route::get('dashboard', [StudentMainController::class, 'index'])
                ->name('student.dashboard');

            Route::group(['prefix' => 'exams'], function () {
                Route::get('/', [StudentExamController::class, 'index'])
                    ->name('students.exam.index');

                Route::get('{quizze_id}', [StudentExamController::class, 'show'])
                    ->name('students.exams.show');
                
                Route::get('{quizze_id}/questions', [StudentExamController::class, 'questions'])
                    ->name('students.exams.questions');

                Route::post('{quizze_id}/answers', [StudentExamController::class, 'answers']);
            
                Route::get('{quiz_id}/result', [StudentExamController::class, 'result'])
                    ->name('students.exams.result');
            });

            Route::group(['prefix' => 'profile'], function(){
                Route::get('/', [StudentProfileController::class, 'index'])->name('student.profile.index');
                Route::put('/{id}', [StudentProfileController::class, 'update'])->name('student.profile.update');
            });
        });

    }
    
);
