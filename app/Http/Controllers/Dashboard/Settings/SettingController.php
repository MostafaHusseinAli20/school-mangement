<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Interfaces\Settings\SettingInterface;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingInterface;

    public function __construct(SettingInterface $settingInterface)
    {
        $this->settingInterface = $settingInterface;
    }

    public function index()
    {
        return $this->settingInterface->index();
    }

    public function update(Request $request)
    {
        return $this->settingInterface->update($request);
    }
}
