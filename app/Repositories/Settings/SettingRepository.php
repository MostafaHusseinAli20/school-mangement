<?php

namespace App\Repositories\Settings;

use App\Interfaces\Settings\SettingInterface;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingRepository implements SettingInterface
{
    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function($collection) {
            return [$collection->key => $collection->value];
        });

        return view('dashboard.pages.settings.index', $setting);
    }

    public function update(Request $request)
    {
        // Start a database transaction to ensure all updates are committed or rolled back as a single unit.
        DB::beginTransaction();
        try {
            // Get the request data, excluding the _method and _token fields, as well as the logo field.
            $info = $request->except('_method', '_token', 'logo');

            // Iterate over the request data and update the corresponding setting values in the database.
            foreach($info as $key => $value)
            {
                Setting::where('key', $key)->update(['value' => $value]);
            }

             // If a logo file is provided in the request, upload it and delete the old logo.
            if($request->hasFile('logo'))
            {
                // Get the old logo value from the database.
                $oldLogo = Setting::where('key', 'logo')->value('value');

                 // If the old logo exists and is stored on disk, delete it.
                if ($oldLogo && Storage::disk('public')->exists("settings_attachment/logos/$oldLogo")) {
                    Storage::disk('public')->delete("settings_attachment/logos/$oldLogo");
                }
                
                $logo_name = $request->file('logo')->getClientOriginalName();
                Setting::where('key', 'logo')->update(['value' => $logo_name]);
                $request->file('logo')->storeAs('settings_attachment/logos',$logo_name, 'public');
            }

            DB::commit();
            toastr()->success(trans('trans.update_setting_data'));
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }
}