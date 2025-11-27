<?php

namespace App\Interfaces\Parents;

use Illuminate\Http\Request;

interface ParentMainInterface
{
    public function index();
    public function grades();
    public function children();
    public function filterChildern(Request $request);
    public function fees();
    public function feesRecipt($id);
    public function profile();
    public function updateProfile(Request $request, $id);
}
