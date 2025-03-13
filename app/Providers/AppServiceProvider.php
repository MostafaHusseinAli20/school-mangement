<?php

namespace App\Providers;

use App\Interfaces\Classes\ClassesInterface;
use App\Interfaces\Grades\GradeInterface;
use App\Interfaces\Sections\SectionInterface;
use App\Interfaces\Students\StudentInterface;
use App\Interfaces\Students\StudentPromotionsInterface;
use App\Interfaces\Teachers\TeacherInterface;
use App\Repositories\Classes\ClasseRepository;
use App\Repositories\Grades\GradeRepository;
use App\Repositories\Sections\SectionRepository;
use App\Repositories\StudentPromotions\StudentPromotionRepository;
use App\Repositories\Students\StudentRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
