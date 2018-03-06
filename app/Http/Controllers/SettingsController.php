<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit($id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $setting = Setting::find(1);

        return response()->json([
            'setting' => $setting
        ]);
    }

    public function update($id){
        app()->setLocale('en');
        $setting = Setting::find(1);
        $setting->phone1 = request('phone1');
        $setting->phone2 = request('phone2');
        $setting->email1 = request('email1');
        $setting->email2 = request('email2');
        $setting->facebook = request('facebook');
        $setting->twitter = request('twitter');
        $setting->instagram = request('instagram');
        $setting->pinterest = request('pinterest');
        $setting->analytics = request('analytics');
        $setting->map = request('map');
        $setting->newsletter = request('newsletter');
        $setting->update();

        return response()->json([
            'message' => 'done'
        ]);
    }

    public function updateLang($id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $setting = Setting::find(1);
        $setting->address = request('address');
        $setting->title = request('title');
        $setting->keywords = request('keywords');
        $setting->desc = request('desc');
        $setting->footer = request('footer');
        $setting->update();

        return response()->json([
            'message' => 'done'
        ]);
    }
}
