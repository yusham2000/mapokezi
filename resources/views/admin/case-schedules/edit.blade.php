@extends('layouts.admin', ['title' => 'Hariri Kesi', 'heading' => 'Hariri kesi'])

@section('content')
    <section class="panel p-6">
        <div class="mb-6 rounded-2xl border border-stone-200 bg-stone-50 p-4 text-sm text-slate-600">
            Foleni ya kesi hii ni <span class="font-bold text-slate-900">{{ $caseSchedule->queue_number }}</span>. Inabaki kama kumbukumbu ya mpangilio wa siku hiyo.
        </div>

        <form method="POST" action="{{ route('admin.case-schedules.update', $caseSchedule) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('admin.case-schedules._form')
            <div class="flex flex-wrap gap-3">
                <button class="admin-button" type="submit">Hifadhi mabadiliko</button>
                <a class="admin-button-secondary" href="{{ route('admin.case-schedules.index', ['date' => $caseSchedule->service_date->toDateString()]) }}">Rudi</a>
            </div>
        </form>
    </section>
@endsection
