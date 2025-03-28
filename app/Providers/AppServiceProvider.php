<?php

namespace App\Providers;

use App\Interfaces\Attendances\AttendanceInterface;
use App\Interfaces\Classes\ClassesInterface;
use App\Interfaces\Exams\ExamInterface;
use App\Interfaces\Fees\FeeInterface;
use App\Interfaces\Fees\FeeInvoiceInterface;
use App\Interfaces\Fees\ProcessingFeeInterface;
use App\Interfaces\Grades\GradeInterface;
use App\Interfaces\Sections\SectionInterface;
use App\Interfaces\Students\ReceiptStudentInterface;
use App\Interfaces\Students\StudentGraduateInterface;
use App\Interfaces\Students\StudentInterface;
use App\Interfaces\Students\StudentPromotionsInterface;
use App\Interfaces\Subjects\SubjectInterface;
use App\Interfaces\Teachers\TeacherInterface;
use App\Repositories\Attendances\AttendanceRepository;
use App\Repositories\Classes\ClasseRepository;
use App\Repositories\Exams\ExamRepository;
use App\Repositories\Fees\FeeInvoiceRepository;
use App\Repositories\Fees\FeeRepository;
use App\Repositories\Fees\ProcessingFeeRepository;
use App\Repositories\Grades\GradeRepository;
use App\Repositories\Sections\SectionRepository;
use App\Repositories\StudentPromotions\StudentPromotionRepository;
use App\Repositories\Students\ReceiptStudent\ReceiptStudentRepository;
use App\Repositories\Students\StudentGraduate\StudentGraduateRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use App\Repositories\Teachers\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
