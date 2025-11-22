<?php

namespace App\Http\Controllers\Dashboard\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Teachers\Dashboard\TeacherLessonsInterface;
use Illuminate\Http\Request;

class TeacherLessonsController extends Controller
{
    private $teacherLessonsInterface;

    public function __construct(TeacherLessonsInterface $teacherLessonsInterface)
    {
        $this->teacherLessonsInterface = $teacherLessonsInterface;
    }
    
    // Direct
    public function index()
    {
        return $this->teacherLessonsInterface->index();
    }

    public function create()
    {
        return $this->teacherLessonsInterface->create();
    }

    public function store(Request $request)
    {
        return $this->teacherLessonsInterface->store($request);
    }

    // Indirect
    public function createIndirect()
    {
        return $this->teacherLessonsInterface->createIndirect();
    }

    public function storeIndirect(Request $request)
    {
        return $this->teacherLessonsInterface->storeIndirect($request);
    }

    public function destroy($id)
    {
        return $this->teacherLessonsInterface->destroy($id);
    }
}

