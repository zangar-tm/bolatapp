<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::find(1);
        $companyName = $setting->data['company']??'';
        $logoPath = $setting->data['logo_path']??'';
        return view('settings', compact('companyName', 'logoPath'));
    }

    // TODO: fix upload image without name
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'logo' => 'nullable',
        ]);

        $imagePath='';
        if($request->file('logo')){
            $imagePath = $request->file('logo')->store('setting', 'public');
        }
        if(Setting::count()>0){
            Setting::whereId(1)->update(['data'=> 
            [
                'company' => $request->name,
                'logo_path' => $imagePath
            ]
            ]);
        }else{
            Setting::create(['data'=> 
            [
                'company' => $request->name,
                'logo_path' => $imagePath
            ]
            ]);
        }
        return redirect()->back()->with('success', 'Настройки компании успешно обновлены.');
    }

}
