<?php

namespace App\Interfaces\Events;

use Illuminate\Http\Request;

interface EventInterface
{
    public function index();
    public function store(Request $request);
    public function update(Request $request);
}
