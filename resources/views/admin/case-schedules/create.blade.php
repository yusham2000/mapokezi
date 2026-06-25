@extends('layouts.admin', ['title' => 'Ongeza Kesi', 'heading' => 'Ongeza kesi'])

@section('content')
    <section class="panel p-6">
        <p class="mb-6 text-sm text-slate-600">
            Namba ya foleni haitajazwa hapa. Mfumo utaitoa moja kwa moja kulingana na nafasi ya kesi kwa tarehe uliyochagua.
        </p>

        <form method="POST" action="{{ route('admin.case-schedules.store') }}" class="space-y-6">
            @csrf
            @include('admin.case-schedules._form')
            <div class="flex flex-wrap gap-3">
                <button class="admin-button" type="submit">Hifadhi kesi</button>
                <a class="admin-button-secondary" href="{{ route('admin.case-schedules.index', ['date' => $selectedDate]) }}">Rudi</a>
            </div>
        </form>
    </section>
@endsection
