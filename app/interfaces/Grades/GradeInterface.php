<?php

namespace App\Interfaces\Grades;

interface GradeInterface
{
    public function index();
    public function store($request);
    public function update($request, $id);
    public function destroy($request);
}
