<?php

namespace App\Interfaces\Attendances;

interface AttendanceInterface
{
    public function index();
    public function store($request);
    public function show($id);
}
