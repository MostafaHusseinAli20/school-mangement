<?php

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

        Route::get('/teacher/dashboard', function () {
            return view('dashboard.pages.teachers.dashboard');
        });
    }
);
