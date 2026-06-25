<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\CaseSchedule;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        $today = Carbon::today();

        return view('admin.dashboard', [
            'today' => $today,
            'caseCount' => CaseSchedule::query()->whereDate('service_date', $today)->count(),
            'servingCount' => CaseSchedule::query()->whereDate('service_date', $today)->where('status', CaseSchedule::STATUS_SERVING)->count(),
            'announcementCount' => Announcement::query()->activeForDate($today)->count(),
            'serviceCount' => Service::query()->where('is_active', true)->count(),
            'setting' => Setting::query()->first(),
        ]);
    }
}
