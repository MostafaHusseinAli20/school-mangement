<?php

namespace App\Http\Controllers\Dashboard\Parent\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Parents\ParentResultStudentInterface;
use App\Models\Result;
use App\Models\Student;

class ParentResultStudentController extends Controller
{
    private $parentResultStudentInterface;
    public function __construct(ParentResultStudentInterface $parentResultStudentInterface)
    {
        $this->parentResultStudentInterface = $parentResultStudentInterface;
    }
    
    public function result($id)
    {
        return $this->parentResultStudentInterface->result($id);
    }
}
