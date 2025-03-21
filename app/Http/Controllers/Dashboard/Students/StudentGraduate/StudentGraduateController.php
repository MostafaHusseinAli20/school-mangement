<?php

namespace App\Http\Controllers\Dashboard\Students\StudentGraduate;

use App\Http\Controllers\Controller;
use App\Interfaces\Students\StudentGraduateInterface;
use Illuminate\Http\Request;

class StudentGraduateController extends Controller
{
    private $studentGraduateInterface;

    public function __construct(StudentGraduateInterface $studentGraduateInterface)
    {
        $this->studentGraduateInterface = $studentGraduateInterface;
    }

    public function index()
    {
        return $this->studentGraduateInterface->index();
    }

    public function create()
    {
        return $this->studentGraduateInterface->create();
    }

    public function store(Request $request)
    {
        return $this->studentGraduateInterface->softDelete($request);
    }

    public function update($id)
    {
        return $this->studentGraduateInterface->returnData($id);
    }

    public function destroy($id)
    {
        return $this->studentGraduateInterface->destroy($id);
    }
}
