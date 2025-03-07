<?php

namespace App\Interfaces\Sections;

interface SectionInterface
{
    public function index();
    public function store($request);
    public function update($request, $id);
    public function destroy($request);
    public function getclasses($id);
}
