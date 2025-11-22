<?php

namespace App\Interfaces\Students;

use Illuminate\Http\Request;

interface StudentProfileInterface
{
    public function index();
    public function update(Request $request, $id);
}
