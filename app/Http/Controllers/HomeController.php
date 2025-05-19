<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Event;
use App\Models\MyParent;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('indexAfterLogin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.selection');
    }

    public function indexAfterLogin()
    {
        $events = Event::select('id', 'title', 'start')->get();
        
        $data['students'] = Student::count();
        $data['parents'] = MyParent::count();
        $data['teachers'] = Teacher::count();
        $data['classes'] = Classe::count();
        return view('dashboard.index', $data, compact('events'));
    }
}
