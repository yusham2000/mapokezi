@extends('layouts.admin', ['title' => 'Muhtasari wa Admin', 'heading' => 'Muhtasari wa leo'])

@section('content')
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="panel p-6">
            <p class="text-sm text-slate-500">Kesi za leo</p>
            <p class="mt-3 text-4xl font-black text-slate-900">{{ $caseCount }}</p>
        </div>
        <div class="panel p-6">
            <p class="text-sm text-slate-500">Kesi zinazoendelea</p>
            <p class="mt-3 text-4xl font-black text-emerald-700">{{ $servingCount }}</p>
        </div>
        <div class="panel p-6">
            <p class="text-sm text-slate-500">Matangazo hai</p>
            <p class="mt-3 text-4xl font-black text-slate-900">{{ $announcementCount }}</p>
        </div>
        <div class="panel p-6">
            <p class="text-sm text-slate-500">Huduma hai</p>
            <p class="mt-3 text-4xl font-black text-slate-900">{{ $serviceCount }}</p>
        </div>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
        <section class="panel p-6">
            <h3 class="text-xl font-bold text-slate-900">Hatua za haraka</h3>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <a class="admin-button" href="{{ route('admin.case-schedules.create', ['date' => $today->toDateString()]) }}">Ongeza kesi ya leo</a>
                <a class="admin-button-secondary" href="{{ route('admin.case-schedules.index', ['date' => $today->toDateString()]) }}">Angalia ratiba ya leo</a>
                <a class="admin-button-secondary" href="{{ route('admin.announcements.create') }}">Andika tangazo</a>
                <a class="admin-button-secondary" href="{{ route('admin.settings.edit') }}">Badili mipangilio</a>
            </div>
        </section>
    </div>
@endsection
