<?php

namespace App\Interfaces\Students;

interface StudentInterface
{
    public function index();
    public function create();
    public function store($request);
    public function show($id);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
    public function getClasses($id);
    public function getSections($id);
}
