<?php

use App\Http\Controllers\Dashboard\Classes\ClassesController;
use App\Http\Controllers\Dashboard\Fees\FeeContoller;
use App\Http\Controllers\Dashboard\Grade\GradeController;
use App\Http\Controllers\Dashboard\StudentPromotions\StudentPromotionsController;
use App\Http\Controllers\Dashboard\Sections\SectionsController;
use App\Http\Controllers\Dashboard\Students\StudentController;
use App\Http\Controllers\Dashboard\Students\StudentGraduate\StudentGraduateController;
use App\Http\Controllers\Dashboard\Teachers\TeachersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/login', function () {
    return view('auth.login');
});

Route::redirect('/', '/login');

Auth::routes();

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware'
    => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
        'auth'
    ]
], function () {
    // Main Dashboard Route
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index']);

    // Grades Route
    Route::resource('grades', GradeController::class);
    // Classes Route
    Route::resource('classes', ClassesController::class);

    Route::post('/delete_all', [ClassesController::class, 'delete_all'])->name('delete_all');

    Route::post('/filterclasse', [ClassesController::class, 'filter_classe'])->name('filter_classe');

    // Sections Routes
    Route::resource('sections', SectionsController::class);
    Route::get('classes/{id}', [SectionsController::class, 'getclasses']);

    // Teachers Routes
    Route::resource('teachers', TeachersController::class);

    // Students Routes
    Route::resource('students', StudentController::class);
    Route::get('/get_classes/{id}', [StudentController::class, 'getClasses']);
    Route::get('/get_sections/{id}', [StudentController::class, 'getSections']);
    Route::post('upload_attachment', [StudentController::class, 'upload_attachment'])->name('upload_attachment');
    Route::get('/show_attachment/{student_name}/{file_name}', [StudentController::class, 'show_attachment']);
    Route::get('/download_attachment/{student_name}/{file_name}', [StudentController::class, 'download_attachment']);
    Route::post('/delete_attachment', [StudentController::class, 'delete_attachment'])->name('delete_attachment');
    
    // Promotions Students
    Route::resource('student-promotions', StudentPromotionsController::class);

    // Graduate Students
    Route::resource('student-graduate', StudentGraduateController::class);

    // Fees Routes
    Route::resource('fees', FeeContoller::class);
});

// Livewire Routes
Route::view("/ar/add_parent", 'livewire.main')->middleware('auth');
Route::view("/en/add_parent", 'livewire.main')->middleware('auth');
