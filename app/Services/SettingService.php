<?php

namespace App\Services;
use App\Models\Setting;

class SettingService
{
    public function create($data)
    {
        $newSetting = Setting::create([
            'key'       => $data['key'],
            'value'     => $data['value'],
        ]);

        return $newSetting;
    }

    public function update($data, $id)
    {
        Setting::where('id', $id)->update($data);
        $newSetting = Setting::find($id);

        return $newSetting;
    }

    public function show($id)
    {
        $newSetting = Setting::findOrFail($id);

        return $newSetting;
    }

    public function delete($id)
    {
        return Setting::find($id)->delete();
    }

}
