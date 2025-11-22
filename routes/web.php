<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Attendances\AttendanceController;
use App\Http\Controllers\Dashboard\Classes\ClassesController;
use App\Http\Controllers\Dashboard\Events\EventController;
use App\Http\Controllers\Dashboard\Exams\ExamController;
use App\Http\Controllers\Dashboard\Exams\QuestionController;
use App\Http\Controllers\Dashboard\Exams\QuizzeController;
use App\Http\Controllers\Dashboard\Fees\FeeContoller;
use App\Http\Controllers\Dashboard\Fees\FeeInvoiceController;
use App\Http\Controllers\Dashboard\Fees\ProcessingFeeController;
use App\Http\Controllers\Dashboard\Grade\GradeController;
use App\Http\Controllers\Dashboard\Library\LibraryController;
use App\Http\Controllers\Dashboard\OnlineClasses\OnlineClasseController;
use App\Http\Controllers\Dashboard\StudentPromotions\StudentPromotionsController;
use App\Http\Controllers\Dashboard\Sections\SectionsController;
use App\Http\Controllers\Dashboard\Settings\SettingController;
use App\Http\Controllers\Dashboard\Students\ReceiptStudents\ReceiptStudentController;
use App\Http\Controllers\Dashboard\Students\StudentController;
use App\Http\Controllers\Dashboard\Students\StudentGraduate\StudentGraduateController;
use App\Http\Controllers\Dashboard\Subjects\SubjectController;
use App\Http\Controllers\Dashboard\Teachers\TeachersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
->name('selection');

// Route::redirect('/', '/login');


// Route::middleware(['auth:web,student,teacher,parent', 'guest'])
    // ->group(function () {
    Route::get('login/{type}', [LoginController::class, 'loginForm'])
    ->name('login.show');
    
    Route::post('login', [LoginController::class, 'login'])->name('login');
    
    Route::post('/logout/{type}', [LoginController::class, 'logout'])
        ->name('logout');
// });


Auth::routes();

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware'
    => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
        'auth',
    ]
], function () {

    // Main Dashboard Route
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'indexAfterLogin'])
    ->name('dashboard');

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

    // Fee Invoices Routes
    Route::resource('fee-invoices', FeeInvoiceController::class);

    // Receipt Students
    Route::resource('student-receipt', ReceiptStudentController::class);

    // Processing Fees
    Route::resource('processing-fees', ProcessingFeeController::class);

    // Attendance Routes
    Route::resource('attendances', AttendanceController::class);

    // Subjects Routes
    Route::resource('subjects', SubjectController::class);

    // Choose Exam Route
    Route::view('choose-exam', 'dashboard.pages.exams.choose_exam')->name('choose_exam');

    // Exams Routes
    Route::resource('exams', ExamController::class);
    Route::resource('quizzes', QuizzeController::class);
    Route::resource('questions', QuestionController::class);

    // Online Classes Routes
    Route::resource('online_classes', OnlineClasseController::class);
    Route::get('online_classe/indirect', [OnlineClasseController::class, 'indirectCreate'])->name('online.indirect_create');
    Route::post('online_classe/indirect/store', [OnlineClasseController::class, 'indirectStore'])->name('online.indirect_store');

    // Library Routes
    Route::resource('library', LibraryController::class);
    Route::get('download_file/{filename}', [LibraryController::class, 'download'])->name('downloadAttachment');
    Route::get('show_file/{filename}', [LibraryController::class, 'open_file'])->name('openFile');

    // Settings Routes
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings/{id}/update', [SettingController::class, 'update'])->name('settings.update');
    
    // Event Route
    Route::get('/calendar', [EventController::class, 'index'])->name('calendar.index');
    Route::post('/add-event', [EventController::class, 'store'])->name('add.event');
    Route::post('/update-event', [EventController::class, 'update'])->name('update.event');
});

// Livewire Routes
Route::view("/ar/add_parent", 'livewire.main')->middleware('auth')->name('add_parent');
Route::view("/en/add_parent", 'livewire.main')->middleware('auth');
