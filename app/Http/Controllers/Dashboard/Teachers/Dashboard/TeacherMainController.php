<?php

namespace App\Http\Controllers\Dashboard\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Teachers\Dashboard\TeacherMainInterface;

class TeacherMainController extends Controller
{
    private $teacherMainInterface;
    public function __construct(TeacherMainInterface $teacherMainInterface)
    {
        $this->teacherMainInterface = $teacherMainInterface;
    }

    public function index()
    {
        return $this->teacherMainInterface->index();
    }
}
