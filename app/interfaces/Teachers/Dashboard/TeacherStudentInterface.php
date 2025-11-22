<?php

namespace App\Interfaces\Teachers\Dashboard;

use Illuminate\Http\Request;

interface TeacherStudentInterface
{
    public function index();
    public function sections();
    public function getAttendance();
    public function editAttendance(Request $request);
    public function show_attachment($student_name, $file_name);
    public function show($id);
    public function attendanceReport();
    public function attendanceReportSearch(Request $request);
    public function getClasses($id);
    public function getSections($id);
}
