<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class CaseScheduleController extends Controller
{
    public function index(Request $request): View
    {
        $selectedDate = $request->string('date')->toString() ?: Carbon::today()->toDateString();

        return view('admin.case-schedules.index', [
            'selectedDate' => $selectedDate,
            'cases' => CaseSchedule::query()
                ->whereDate('service_date', $selectedDate)
                ->orderBy('queue_number')
                ->get(),
            'statuses' => $this->statuses(),
        ]);
    }

    public function create(Request $request): View
    {
        $selectedDate = $request->string('date')->toString() ?: Carbon::today()->toDateString();

        return view('admin.case-schedules.create', [
            'selectedDate' => $selectedDate,
            'statuses' => $this->statuses(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateCase($request);
        $data['queue_number'] = CaseSchedule::nextQueueNumberForDate($data['service_date']);

        $case = CaseSchedule::query()->create($data);

        if ($case->status === CaseSchedule::STATUS_SERVING) {
            $case->markAsServing();
        }

        return redirect()
            ->route('admin.case-schedules.index', ['date' => $data['service_date']])
            ->with('status', 'Kesi imeongezwa na namba ya foleni imetolewa moja kwa moja.');
    }

    public function edit(CaseSchedule $caseSchedule): View
    {
        return view('admin.case-schedules.edit', [
            'caseSchedule' => $caseSchedule,
            'statuses' => $this->statuses(),
        ]);
    }

    public function update(Request $request, CaseSchedule $caseSchedule): RedirectResponse
    {
        $data = $this->validateCase($request, $caseSchedule);
        $caseSchedule->update($data);

        if ($caseSchedule->status === CaseSchedule::STATUS_SERVING) {
            $caseSchedule->markAsServing();
        }

        return redirect()
            ->route('admin.case-schedules.index', ['date' => $caseSchedule->service_date->toDateString()])
            ->with('status', 'Taarifa za kesi zimeboreshwa.');
    }

    public function destroy(CaseSchedule $caseSchedule): RedirectResponse
    {
        $serviceDate = $caseSchedule->service_date->toDateString();
        $caseSchedule->delete();

        return redirect()
            ->route('admin.case-schedules.index', ['date' => $serviceDate])
            ->with('status', 'Kesi imefutwa.');
    }

    public function setStatus(Request $request, CaseSchedule $caseSchedule): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:' . implode(',', array_keys($this->statuses()))],
        ]);

        $caseSchedule->update(['status' => $data['status']]);

        if ($data['status'] === CaseSchedule::STATUS_SERVING) {
            $caseSchedule->markAsServing();
        }

        return back()->with('status', 'Hali ya kesi imebadilishwa.');
    }

    protected function validateCase(Request $request, ?CaseSchedule $caseSchedule = null): array
    {
        return $request->validate([
            'case_name' => ['required', 'string', 'max:255'],
            'case_number' => ['required', 'string', 'max:255'],
            'room' => ['required', 'string', 'max:255'],
            'hearing_time' => ['required'],
            'service_date' => ['required', 'date'],
            'status' => ['required', 'in:' . implode(',', array_keys($this->statuses()))],
            'notes' => ['nullable', 'string'],
        ]);
    }

    protected function statuses(): array
    {
        return [
            CaseSchedule::STATUS_WAITING => 'Inasubiri',
            CaseSchedule::STATUS_SERVING => 'Inaendelea',
            CaseSchedule::STATUS_DONE => 'Imekamilika',
        ];
    }
}
