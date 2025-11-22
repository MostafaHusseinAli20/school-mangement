<?php

namespace App\Interfaces\Teachers\Dashboard;

use Illuminate\Http\Request;

interface TeacherLessonsInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function createIndirect();
    public function storeIndirect(Request $request);
    public function destroy($id);
}
