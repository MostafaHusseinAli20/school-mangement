<?php

namespace App\Http\Controllers\Dashboard\Parent\Dashboard;
use App\Http\Controllers\Controller;
use App\Interfaces\Parents\ParentAttendanceInterface;
use App\Models\Attendance;
use App\Models\Student;

class ParentAttendanceController extends Controller
{
    private $parentAttendanceInterface;
    public function __construct(ParentAttendanceInterface $parentAttendanceInterface)
    {
        $this->parentAttendanceInterface = $parentAttendanceInterface;
    }
    
    public function attendance($id)
    {
        return $this->parentAttendanceInterface->attendance($id);
    }
}
