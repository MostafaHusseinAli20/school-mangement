<?php

namespace App\Interfaces\Settings;
use Illuminate\Http\Request;

interface SettingInterface
{
    public function index();
    public function update(Request $request);
}
