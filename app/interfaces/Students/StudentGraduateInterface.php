<?php

namespace App\Interfaces\Students;

interface StudentGraduateInterface
{
    public function index();
    public function create();
    public function softDelete($request);
    public function returnData($id);
    public function destroy($id);
}
