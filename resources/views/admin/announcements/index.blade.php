@extends('layouts.admin', ['title' => 'Matangazo', 'heading' => 'Matangazo'])

@section('content')
    <section class="panel p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-slate-900">Matangazo ya wageni</h3>
                <p class="mt-2 text-sm text-slate-600">Kila tangazo linaweza kuwa na tarehe ya kuanza na kumaliza.</p>
            </div>
            <a class="admin-button" href="{{ route('admin.announcements.create') }}">Ongeza tangazo</a>
        </div>

        <div class="mt-6 space-y-4">
            @foreach ($announcements as $announcement)
                <div class="rounded-3xl border border-stone-200 p-5">
                    <div class="flex flex-col gap-4 lg:flex-row lg:justify-between">
                        <div>
                            <p class="text-lg font-bold text-slate-900">{{ $announcement->title }}</p>
                            <p class="mt-2 text-sm text-slate-600">{{ $announcement->message }}</p>
                            <p class="mt-2 text-xs text-slate-400">
                                {{ $announcement->start_date?->format('d/m/Y') ?? 'Mara moja' }}
                                -
                                {{ $announcement->end_date?->format('d/m/Y') ?? 'Bila mwisho' }}
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="status-badge {{ $announcement->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700' }}">
                                {{ $announcement->is_active ? 'Hai' : 'Imefichwa' }}
                            </span>
                            <a class="admin-button-secondary" href="{{ route('admin.announcements.edit', $announcement) }}">Hariri</a>
                            <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" onsubmit="return confirm('Unataka kufuta tangazo hili?')">
                                @csrf
                                @method('DELETE')
                                <button class="admin-button-secondary" type="submit">Futa</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
