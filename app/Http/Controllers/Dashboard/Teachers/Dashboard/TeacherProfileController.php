<?php

namespace App\Http\Controllers\Dashboard\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Teachers\Dashboard\TeacherProfileInterface;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherProfileController extends Controller
{
    private $teacherProfileInterface;

    public function __construct(TeacherProfileInterface $teacherProfileInterface)
    {
        $this->teacherProfileInterface = $teacherProfileInterface;
    }

    public function index()
    {
        return $this->teacherProfileInterface->index();
    }

    public function update(Request $request, $id)
    {
        return $this->teacherProfileInterface->update($request, $id);
    }

}
