<?php

namespace App\Http\Controllers\Dashboard\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Teachers\Dashboard\TeacherStudentInterface;
use App\Models\Attendance;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeacherStudentController extends Controller
{
    private $teacherStudentInterface;

    public function __construct(TeacherStudentInterface $teacherStudentInterface)
    {
        $this->teacherStudentInterface = $teacherStudentInterface;
    }

    public function index()
    {
        return $this->teacherStudentInterface->index();
    }

    public function sections()
    {
        return $this->teacherStudentInterface->sections();
    }

    public function show($id)
    {
        return $this->teacherStudentInterface->show($id);
    }

    public function getAttendance()
    {
        return $this->teacherStudentInterface->getAttendance();
    }

    public function editAttendance(Request $request)
    {
        return $this->teacherStudentInterface->editAttendance($request);
    }

    public function show_attachment($student_name, $file_name)
    {
        return $this->teacherStudentInterface->show_attachment($student_name, $file_name);
    }

    public function attendanceReport()
    {
        return $this->teacherStudentInterface->attendanceReport();
    }

    public function attendanceReportSearch(Request $request)
    {
        return $this->teacherStudentInterface->attendanceReportSearch($request);
    }

    public function getClasses($id)
    {
        return $this->teacherStudentInterface->getClasses($id);
    }

    public function getSections($id)
    {
        return $this->teacherStudentInterface->getSections($id);
    }
}
