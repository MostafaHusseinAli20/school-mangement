<?php

namespace App\Interfaces\Teachers\Dashboard;

use Illuminate\Http\Request;

interface TeacherProfileInterface
{
    public function index();
    public function update(Request $request, $id);
}
