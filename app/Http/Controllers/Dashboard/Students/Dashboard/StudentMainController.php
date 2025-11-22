<?php

namespace App\Http\Controllers\Dashboard\Students\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Students\StudentMainInterface;
use Illuminate\Http\Request;

class StudentMainController extends Controller
{
    private $studentMainInterface;
    public function __construct(StudentMainInterface $studentMainInterface)
    {
        $this->studentMainInterface = $studentMainInterface;
    }

    public function index()
    {
        return $this->studentMainInterface->index();
    }
}
