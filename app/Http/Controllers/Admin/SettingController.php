<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'setting' => Setting::query()->firstOrCreate(['id' => 1], [
                'court_name' => 'Mahakama Reception',
                'welcome_text' => 'Karibu mapokezi. Tafadhali fuatilia ratiba ya kesi na matangazo.',
                'directions_text' => "Chumba 1: upande wa kushoto baada ya mapokezi.\nChumba 2: korido ya kati, mlango wa pili.\nChumba 3: ghorofa ya chini karibu na cash office.",
                'slide_interval_seconds' => 10,
            ]),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $setting = Setting::query()->firstOrCreate(['id' => 1]);

        $data = $request->validate([
            'court_name' => ['required', 'string', 'max:255'],
            'welcome_text' => ['nullable', 'string', 'max:255'],
            'directions_text' => ['nullable', 'string'],
            'slide_interval_seconds' => ['required', 'integer', 'min:5', 'max:60'],
            'map_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('map_image')) {
            if ($setting->map_image) {
                Storage::disk('public')->delete($setting->map_image);
            }

            $data['map_image'] = $request->file('map_image')->store('maps', 'public');
        }

        $setting->update($data);

        return redirect()->route('admin.settings.edit')->with('status', 'Mipangilio imehifadhiwa.');
    }
}
