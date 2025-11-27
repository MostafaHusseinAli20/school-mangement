<?php

use App\Http\Controllers\Dashboard\Parent\Dashboard\ParentAttendanceController;
use App\Http\Controllers\Dashboard\Parent\Dashboard\ParentMainController;
use App\Http\Controllers\Dashboard\Parent\Dashboard\ParentResultStudentController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware'
    => [
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            'auth:parent',
        ]
], function () {
    Route::group(['prefix' => 'parents'], function () {
        Route::get('/dashboard', [ParentMainController::class, 'index'])
            ->name('parent.dashboard');

        Route::get('/grades', [ParentMainController::class, 'grades'])
            ->name('parent.grades');

        Route::group(['prefix' => 'children'], function () {
            Route::get('/', [ParentMainController::class, 'children'])
                ->name('parent.children');

            Route::get('/filter', [ParentMainController::class, 'filterChildern'])
                ->name('parent.children.filter');

            Route::get('/result/{id}', [ParentResultStudentController::class, 'result'])
                ->name('parent.children.result');

            Route::get('/attendance/{id}', [ParentAttendanceController::class, 'attendance'])
                ->name('parent.children.attendance');

            Route::get('/fees/recipt/{id}', [ParentMainController::class, 'feesRecipt'])
                ->name('parent.fees.recipt');
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [ParentMainController::class, 'profile'])
                ->name('parent.profile');

            Route::put('/{id}', [ParentMainController::class, 'updateProfile'])
                ->name('parent.profile.update');
        });

        Route::get('/fees', [ParentMainController::class, 'fees'])
            ->name('parent.fees');

    });
});