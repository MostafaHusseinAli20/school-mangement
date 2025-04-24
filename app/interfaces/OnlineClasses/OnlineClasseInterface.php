<?php

namespace App\Interfaces\OnlineClasses;

interface OnlineClasseInterface
{
    public function index();
    public function create();
    public function indirectCreate();
    public function store($request);
    public function indirectStore($request);
    public function destroy($request);
}
