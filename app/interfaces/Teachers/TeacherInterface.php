<?php

namespace App\Interfaces\Teachers;

interface TeacherInterface
{
    //
    public function index();
    public function create();
    public function show($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}
