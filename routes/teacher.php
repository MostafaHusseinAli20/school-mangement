<?php

use App\Http\Controllers\Dashboard\Attendances\AttendanceController;
use App\Http\Controllers\Dashboard\Events\EventController;
use App\Http\Controllers\Dashboard\Teachers\Dashboard\TeacherLessonsController;
use App\Http\Controllers\Dashboard\Teachers\Dashboard\TeacherMainController;
use App\Http\Controllers\Dashboard\Teachers\Dashboard\TeacherProfileController;
use App\Http\Controllers\Dashboard\Teachers\Dashboard\TeacherQuizzController;
use App\Http\Controllers\Dashboard\Teachers\Dashboard\TeacherQuizzQuestionController;
use App\Http\Controllers\Dashboard\Teachers\Dashboard\TeacherStudentController;
use App\Models\Attendance;
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

        Route::group(['prefix' => 'teachers'], function () {
            Route::get('/dashboard', [TeacherMainController::class, 'index'])
                ->name('teacher.dashboard');

            Route::get('/sections', [TeacherStudentController::class, 'sections'])
                ->name('teacher.sections');

            Route::get('/students', [TeacherStudentController::class, 'index'])
                ->name('teacher.students');

            Route::get('/student/{id}', [TeacherStudentController::class, 'show'])
                ->name('teacher.students.show');

            Route::get('/show_attachment/{student_name}/{file_name}', [TeacherStudentController::class, 'show_attachment'])
                
                ->name('teacher.students.show_attachment');
            Route::get('/attendance', [TeacherStudentController::class, 'getAttendance'])
                ->name('teacher.attendances');
            Route::post('/attendance', [TeacherStudentController::class, 'editAttendance'])
                ->name('teacher.attendances.store');
            Route::get('/attendance-report', [TeacherStudentController::class, 'attendanceReport'])
                ->name('teacher.attendance.report');
            Route::post('/attendance-report', [TeacherStudentController::class, 'attendanceReportSearch'])
                ->name('teacher.attendance.report.search');

            Route::get('classes/{grade_id}', [TeacherStudentController::class, 'getClasses']);
            Route::get('/get_sections/{id}', [TeacherStudentController::class, 'getSections']);

            Route::group(['prefix' => 'quizzes'], function () {
                
                Route::get('/', [TeacherQuizzController::class, 'index'])
                    ->name('teacher.quizzes.index');
    
                Route::get('/create', [TeacherQuizzController::class, 'create'])
                    ->name('teacher.quizzes.create');
    
                Route::post('/', [TeacherQuizzController::class, 'store'])
                    ->name('teacher.quizzes.store');
    
                Route::get('/edit/{id}', [TeacherQuizzController::class, 'edit'])
                    ->name('teacher.quizzes.edit');
                
                Route::put('/update/{id}', [TeacherQuizzController::class, 'update'])
                    ->name('teacher.quizzes.update');
    
                Route::delete('/quizzes', [TeacherQuizzController::class, 'destroy'])
                    ->name('teacher.quizzes.destroy');

                Route::get('/search', [TeacherQuizzQuestionController::class, 'searchQuizzes'])
                    ->name('teacher.quizzes.search');

                Route::get('/students-exams/{id}', [TeacherQuizzController::class, 'countStudentsExams'])
                    ->name('teacher.quizzes.count.exam');
                
                Route::get('get-status-results', [TeacherQuizzController::class, 'getStatusResults'])
                    ->name('teacher.quizzes.status.results');

                Route::delete('cancelled-exam-for-student/{quiz_id}/{student_id}', 
                    [TeacherQuizzController::class, 'cancelledExamForStudent'])
                    ->name('teacher.quizzes.cancelled.exam.for.student');
            });

            Route::group(['prefix' => 'questions'], function () {
                Route::get('/', [TeacherQuizzQuestionController::class, 'index'])
                    ->name('teacher.quizzes.questions.index');

                Route::get('/create/{id}', [TeacherQuizzQuestionController::class, 'create'])
                    ->name('teacher.quizzes.questions.create');

                Route::post('/store/{id}', [TeacherQuizzQuestionController::class, 'store'])
                    ->name('teacher.quizzes.questions.store');

                Route::get('/edit/{id}', [TeacherQuizzQuestionController::class, 'edit'])
                    ->name('teacher.quizzes.questions.edit');

                Route::put('/update/{id}', [TeacherQuizzQuestionController::class, 'update'])
                    ->name('teacher.quizzes.questions.update');

                Route::delete('/delete/{id}', [TeacherQuizzQuestionController::class, 'destroy'])
                    ->name('teacher.quizzes.questions.destroy');
            });

            Route::group(['prefix' => 'lessons'], function () {
                Route::get('/', [TeacherLessonsController::class, 'index'])
                    ->name('teacher.lessons.index');

                Route::get('/create', [TeacherLessonsController::class, 'create'])
                    ->name('teacher.online_classes.create');

                Route::post('/', [TeacherLessonsController::class, 'store'])->name('teacher.online_classes.store');

                Route::get('/create-indirect', [TeacherLessonsController::class, 'createIndirect'])
                    ->name('teacher.online.indirect_create');

                Route::post('/indirect', [TeacherLessonsController::class, 'storeIndirect'])
                    ->name('teacher.online.indirect_store');
                Route::delete('/destroy/{id}', [TeacherLessonsController::class, 'destroy'])
                    ->name('teacher.online_classes.destroy');
            });

            Route::group(['prefix' => 'profile'],function(){
                Route::get('/', [TeacherProfileController::class, 'index'])
                    ->name('teacher.profile');

                Route::put('/update/{id}', [TeacherProfileController::class, 'update'])
                    ->name('teacher.profile.update');
            });

            Route::post('/update-event', [EventController::class, 'update'])->name('teacher.update.event');
            Route::post('/add-event', [EventController::class, 'store'])->name('teacher.add.event');
        });
    }
);

