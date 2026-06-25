<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\CaseSchedule;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $today = Carbon::today();
        $setting = Setting::query()->firstOrCreate(['id' => 1], [
            'court_name' => 'Mahakama Reception',
            'welcome_text' => 'Karibu mapokezi. Tafadhali fuatilia ratiba ya kesi na matangazo.',
            'directions_text' => "Chumba 1: upande wa kushoto baada ya mapokezi.\nChumba 2: korido ya kati, mlango wa pili.\nChumba 3: ghorofa ya chini karibu na cash office.",
            'slide_interval_seconds' => 10,
        ]);

        $todayCases = CaseSchedule::query()
            ->whereDate('service_date', $today)
            ->orderBy('queue_number')
            ->get();

        return view('dashboard', [
            'today' => $today,
            'setting' => $setting,
            'todayCases' => $todayCases,
            'services' => Service::query()->where('is_active', true)->orderBy('display_order')->get(),
            'announcements' => Announcement::query()->activeForDate($today)->latest()->get(),
            'servingCases' => $todayCases->where('status', CaseSchedule::STATUS_SERVING)->values(),
        ]);
    }
}
