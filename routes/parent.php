<?php

use App\Http\Controllers\Dashboard\Parent\Dashboard\ParentMainController;
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
        });

        Route::get('/profile', [ParentMainController::class, 'profile'])
            ->name('parent.profile');

        Route::get('/fees', [ParentMainController::class, 'fees'])
            ->name('parent.fees');

    });
});