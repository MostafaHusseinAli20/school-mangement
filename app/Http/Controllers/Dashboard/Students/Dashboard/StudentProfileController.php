<?php

namespace App\Http\Controllers\Dashboard\Students\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Students\StudentProfileInterface;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    private $studentProfileInterface;
    public function __construct(StudentProfileInterface $studentProfileInterface)
    {
        $this->studentProfileInterface = $studentProfileInterface;
    }

    public function index()
    {
        return $this->studentProfileInterface->index();
    }

    public function update(Request $request, $id)
    {
        return $this->studentProfileInterface->update($request, $id);
    }
}
