<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public const HOME = '/dashboard';
    public const STUDENT = '/students/dashboard';
    public const TEACHER = '/teachers/dashboard';
    public const PARENT = '/parents/dashboard';
    
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/student.php'));
        Route::middleware('web')
            ->group(base_path('routes/teacher.php'));
        Route::middleware('web')
            ->group(base_path('routes/parent.php'));
    }
}
