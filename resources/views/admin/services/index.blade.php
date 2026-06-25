@extends('layouts.admin', ['title' => 'Huduma', 'heading' => 'Huduma zinazotolewa'])

@section('content')
    <section class="panel p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-slate-900">Orodha ya huduma</h3>
                <p class="mt-2 text-sm text-slate-600">Huduma hizi zinaonekana kwenye slide yake ya dashboard.</p>
            </div>
            <a class="admin-button" href="{{ route('admin.services.create') }}">Ongeza huduma</a>
        </div>

        <div class="mt-6 space-y-4">
            @foreach ($services as $service)
                <div class="rounded-3xl border border-stone-200 p-5">
                    <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="text-lg font-bold text-slate-900">{{ $service->name }}</p>
                            <p class="mt-1 text-sm text-slate-600">{{ $service->description }}</p>
                            <p class="mt-2 text-xs uppercase tracking-[0.2em] text-slate-400">Mpangilio: {{ $service->display_order }}</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="status-badge {{ $service->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700' }}">
                                {{ $service->is_active ? 'Inaonekana' : 'Imefichwa' }}
                            </span>
                            <a class="admin-button-secondary" href="{{ route('admin.services.edit', $service) }}">Hariri</a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Unataka kufuta huduma hii?')">
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
