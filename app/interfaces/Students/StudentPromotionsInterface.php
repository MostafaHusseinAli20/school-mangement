<?php

namespace App\Interfaces\Students;

interface StudentPromotionsInterface
{
    public function index();
    public function create();
    public function store($request);
    public function destroy($request);
}
