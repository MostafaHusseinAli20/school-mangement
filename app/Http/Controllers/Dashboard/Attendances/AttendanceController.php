<?php

namespace App\Http\Controllers\Dashboard\Attendances;

use App\Http\Controllers\Controller;
use App\Interfaces\Attendances\AttendanceInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $attendanceInterface;

    public function __construct(AttendanceInterface $attendanceInterface)
    {
        $this->attendanceInterface = $attendanceInterface;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->attendanceInterface->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->attendanceInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->attendanceInterface->show($id);
    }
}
