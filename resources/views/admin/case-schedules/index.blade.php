@extends('layouts.admin', ['title' => 'Ratiba za Kesi', 'heading' => 'Ratiba za kesi'])

@section('content')
    <section class="panel p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <form class="flex flex-col gap-3 sm:flex-row" method="GET" action="{{ route('admin.case-schedules.index') }}">
                <div>
                    <label class="admin-label" for="date">Chagua tarehe</label>
                    <input class="admin-input" id="date" name="date" type="date" value="{{ $selectedDate }}">
                </div>
                <button class="admin-button-secondary" type="submit">Onesha</button>
            </form>

            <a class="admin-button" href="{{ route('admin.case-schedules.create', ['date' => $selectedDate]) }}">Ongeza kesi</a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-stone-200 text-slate-500">
                    <tr>
                        <th class="px-3 py-3">Foleni</th>
                        <th class="px-3 py-3">Jina la shauri</th>
                        <th class="px-3 py-3">Namba ya kesi</th>
                        <th class="px-3 py-3">Chumba</th>
                        <th class="px-3 py-3">Saa</th>
                        <th class="px-3 py-3">Hali</th>
                        <th class="px-3 py-3">Vitendo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cases as $case)
                        <tr class="border-b border-stone-100">
                            <td class="px-3 py-4 font-bold text-slate-900">{{ $case->queue_number }}</td>
                            <td class="px-3 py-4">{{ $case->case_name }}</td>
                            <td class="px-3 py-4">{{ $case->case_number }}</td>
                            <td class="px-3 py-4">{{ $case->room }}</td>
                            <td class="px-3 py-4">{{ \Illuminate\Support\Carbon::parse($case->hearing_time)->format('H:i') }}</td>
                            <td class="px-3 py-4">
                                <span class="status-badge {{ $case->status === 'serving' ? 'bg-emerald-100 text-emerald-800' : ($case->status === 'done' ? 'bg-slate-200 text-slate-700' : 'bg-amber-100 text-amber-800') }}">
                                    {{ $statuses[$case->status] ?? $case->status }}
                                </span>
                            </td>
                            <td class="px-3 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a class="admin-button-secondary !px-3 !py-2" href="{{ route('admin.case-schedules.edit', $case) }}">Hariri</a>
                                    <form method="POST" action="{{ route('admin.case-schedules.status', $case) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input name="status" type="hidden" value="serving">
                                        <button class="admin-button-secondary !px-3 !py-2" type="submit">Inaendelea</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.case-schedules.status', $case) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input name="status" type="hidden" value="done">
                                        <button class="admin-button-secondary !px-3 !py-2" type="submit">Imekamilika</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.case-schedules.destroy', $case) }}" onsubmit="return confirm('Unataka kufuta kesi hii?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="admin-button-secondary !px-3 !py-2" type="submit">Futa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-3 py-6 text-slate-500" colspan="7">Hakuna kesi zilizoorodheshwa kwa tarehe hii bado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
