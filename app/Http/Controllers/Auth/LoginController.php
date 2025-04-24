<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\AuthTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;
    use AuthTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
        $this->middleware('guest')->except('logout');
    }

    public function loginForm($type)
    {
        return view('auth.login', compact('type'));
    }

    public function login(Request $request)
    {
        if(Auth::guard($this->checkGuarded($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        }
        return back()->withErrors(['error' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة']);
    }

    public function logout(Request $request, $type = null)
    {
        // If type is not provided, try to determine it from the authenticated guard
        if ($type === null) {
            if (Auth::guard('student')->check()) {
                $type = 'student';
            } elseif (Auth::guard('teacher')->check()) {
                $type = 'teacher';
            } elseif (Auth::guard('parent')->check()) {
                $type = 'parent';
            } else {
                $type = 'web';
            }
        }

        Auth::guard($type)->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
