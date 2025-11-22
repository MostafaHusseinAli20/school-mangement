<?php

namespace App\Repositories\Students\Dashboard;

use App\Interfaces\Students\StudentMainInterface;

class StudentMainRepository implements StudentMainInterface
{
    public function index()
    {
        return view('dashboard.pages.students.dashboard.index');
    }
}