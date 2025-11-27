<?php

namespace App\Providers;

use App\Interfaces\Attendances\AttendanceInterface;
use App\Interfaces\Classes\ClassesInterface;
use App\Interfaces\Events\EventInterface;
use App\Interfaces\Exams\ExamInterface;
use App\Interfaces\Exams\QuestionInterface;
use App\Interfaces\Exams\QuizzeInterface;
use App\Interfaces\Fees\FeeInterface;
use App\Interfaces\Fees\FeeInvoiceInterface;
use App\Interfaces\Fees\ProcessingFeeInterface;
use App\Interfaces\Grades\GradeInterface;
use App\Interfaces\Library\LibraryInterface;
use App\Interfaces\OnlineClasses\OnlineClasseInterface;
use App\Interfaces\Parents\ParentAttendanceInterface;
use App\Interfaces\Parents\ParentMainInterface;
use App\Interfaces\Parents\ParentResultStudentInterface;
use App\Interfaces\Sections\SectionInterface;
use App\Interfaces\Settings\SettingInterface;
use App\Interfaces\Students\ReceiptStudentInterface;
use App\Interfaces\Students\StudentExamInterface;
use App\Interfaces\Students\StudentGraduateInterface;
use App\Interfaces\Students\StudentInterface;
use App\Interfaces\Students\StudentMainInterface;
use App\Interfaces\Students\StudentProfileInterface;
use App\Interfaces\Students\StudentPromotionsInterface;
use App\Interfaces\Subjects\SubjectInterface;
use App\Interfaces\Teachers\Dashboard\TeacherLessonsInterface;
use App\Interfaces\Teachers\Dashboard\TeacherMainInterface;
use App\Interfaces\Teachers\Dashboard\TeacherProfileInterface;
use App\Interfaces\Teachers\Dashboard\TeacherQuizzeInterface;
use App\Interfaces\Teachers\Dashboard\TeacherQuizzQuestionInterface;
use App\Interfaces\Teachers\Dashboard\TeacherStudentInterface;
use App\Interfaces\Teachers\TeacherInterface;
use App\Repositories\Attendances\AttendanceRepository;
use App\Repositories\Classes\ClasseRepository;
use App\Repositories\Events\EventRepository;
use App\Repositories\Exams\ExamRepository;
use App\Repositories\Exams\QuestionRepository;
use App\Repositories\Exams\QuizzeRepository;
use App\Repositories\Fees\FeeInvoiceRepository;
use App\Repositories\Fees\FeeRepository;
use App\Repositories\Fees\ProcessingFeeRepository;
use App\Repositories\Grades\GradeRepository;
use App\Repositories\Library\LibraryRepository;
use App\Repositories\OnlineClasses\OnlineClasseRepository;
use App\Repositories\Parents\ParentAttendanceRepository;
use App\Repositories\Parents\ParentMainRepository;
use App\Repositories\Parents\ParentResultStudentRepository;
use App\Repositories\Sections\SectionRepository;
use App\Repositories\Settings\SettingRepository;
use App\Repositories\StudentPromotions\StudentPromotionRepository;
use App\Repositories\Students\Dashboard\StudentExamRepository;
use App\Repositories\Students\Dashboard\StudentMainRepository;
use App\Repositories\Students\Dashboard\StudentProfileRepository;
use App\Repositories\Students\ReceiptStudent\ReceiptStudentRepository;
use App\Repositories\Students\StudentGraduate\StudentGraduateRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use App\Repositories\Teachers\Dashboard\TeacherLessonRepository;
use App\Repositories\Teachers\Dashboard\TeacherMainRepository;
use App\Repositories\Teachers\Dashboard\TeacherProfileRepository;
use App\Repositories\Teachers\Dashboard\TeacherQuizzeRepository;
use App\Repositories\Teachers\Dashboard\TeacherQuizzQuestionRepository;
use App\Repositories\Teachers\Dashboard\TeacherStudentRepository;
use App\Repositories\Teachers\TeacherRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Admin
        $this->app->bind(SectionInterface::class, SectionRepository::class);
        $this->app->bind(ClassesInterface::class, ClasseRepository::class);
        $this->app->bind(GradeInterface::class, GradeRepository::class);
        $this->app->bind(TeacherInterface::class, TeacherRepository::class);
        $this->app->bind(StudentInterface::class, StudentRepository::class);
        $this->app->bind(StudentPromotionsInterface::class, StudentPromotionRepository::class);
        $this->app->bind(StudentGraduateInterface::class, StudentGraduateRepository::class);
        $this->app->bind(FeeInterface::class, FeeRepository::class);
        $this->app->bind(FeeInvoiceInterface::class, FeeInvoiceRepository::class);
        $this->app->bind(ReceiptStudentInterface::class, ReceiptStudentRepository::class);
        $this->app->bind(ProcessingFeeInterface::class, ProcessingFeeRepository::class);
        $this->app->bind(AttendanceInterface::class, AttendanceRepository::class);
        $this->app->bind(SubjectInterface::class, SubjectRepository::class);
        $this->app->bind(ExamInterface::class, ExamRepository::class);
        $this->app->bind(QuizzeInterface::class, QuizzeRepository::class);
        $this->app->bind(QuestionInterface::class, QuestionRepository::class);
        $this->app->bind(OnlineClasseInterface::class, OnlineClasseRepository::class);
        $this->app->bind(LibraryInterface::class, LibraryRepository::class);
        $this->app->bind(EventInterface::class, EventRepository::class);
        $this->app->bind(SettingInterface::class, SettingRepository::class);

        // Teachers
        $this->app->bind(TeacherStudentInterface::class, TeacherStudentRepository::class);
        $this->app->bind(TeacherProfileInterface::class, TeacherProfileRepository::class);
        $this->app->bind(TeacherMainInterface::class, TeacherMainRepository::class);
        $this->app->bind(TeacherLessonsInterface::class, TeacherLessonRepository::class);
        $this->app->bind(TeacherQuizzeInterface::class, TeacherQuizzeRepository::class);
        $this->app->bind(TeacherQuizzQuestionInterface::class, TeacherQuizzQuestionRepository::class);

        // Students
        $this->app->bind(StudentExamInterface::class, StudentExamRepository::class);
        $this->app->bind(StudentMainInterface::class, StudentMainRepository::class);
        $this->app->bind(StudentProfileInterface::class, StudentProfileRepository::class);

        // Parents
        $this->app->bind(ParentMainInterface::class, ParentMainRepository::class);
        $this->app->bind(ParentAttendanceInterface::class, ParentAttendanceRepository::class);
        $this->app->bind(ParentResultStudentInterface::class, ParentResultStudentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
