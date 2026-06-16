<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::query()->orderBy('group')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $values = $request->input('settings', []);
        foreach ($values as $key => $value) {
            $row = Setting::query()->where('key', $key)->first();
            if (! $row) continue;
            $row->update(['value' => $value]);
            \Illuminate\Support\Facades\Cache::forget("setting:{$key}");
        }
        return redirect()->route('admin.settings.index')->with('ok', 'Ayarlar kaydedildi — sitede anında geçerli.');
    }
}
