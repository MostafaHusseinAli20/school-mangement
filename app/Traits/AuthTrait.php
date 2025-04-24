<?php

namespace App\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function checkGuarded($request)
    {
        if($request->type == 'student') 
            $guardName = 'student';
        elseif($request->type == 'teacher')
            $guardName = 'teacher';
        elseif($request->type == 'parent')
            $guardName = 'parent';
        else
            $guardName = 'web';

        return $guardName;
    }

    public function redirect($request)
    {
        switch ($request->type) {
            case 'student':
                return redirect()->intended(RouteServiceProvider::STUDENT);
            case 'teacher':
                return redirect()->intended(RouteServiceProvider::TEACHER);
            case 'parent':
                return redirect()->intended(RouteServiceProvider::PARENT);
            default:
                return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
