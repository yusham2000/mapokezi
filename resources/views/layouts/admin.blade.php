<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Usimamizi wa Mapokezi' }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(251,191,36,0.25),_transparent_35%),linear-gradient(135deg,_#f8fafc,_#f5f5f4)]">
    <div class="mx-auto flex min-h-screen max-w-7xl gap-6 px-4 py-6 lg:px-6">
        <aside class="panel hidden w-72 shrink-0 p-6 lg:block">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-700">Mapokezi</p>
            <h1 class="mt-3 text-2xl font-bold text-slate-900">Mahakama Admin</h1>
            <p class="mt-2 text-sm text-slate-600">Simamia ratiba, matangazo, huduma na mpangilio wa dashboard.</p>

            <nav class="mt-8 space-y-2 text-sm font-medium">
                <a class="block rounded-2xl px-4 py-3 hover:bg-stone-100" href="{{ route('admin.dashboard') }}">Muhtasari</a>
                <a class="block rounded-2xl px-4 py-3 hover:bg-stone-100" href="{{ route('admin.case-schedules.index') }}">Ratiba za kesi</a>
                <a class="block rounded-2xl px-4 py-3 hover:bg-stone-100" href="{{ route('admin.services.index') }}">Huduma</a>
                <a class="block rounded-2xl px-4 py-3 hover:bg-stone-100" href="{{ route('admin.announcements.index') }}">Matangazo</a>
                <a class="block rounded-2xl px-4 py-3 hover:bg-stone-100" href="{{ route('admin.settings.edit') }}">Mipangilio</a>
                <a class="block rounded-2xl px-4 py-3 hover:bg-stone-100" href="{{ route('dashboard') }}" target="_blank">Fungua skrini ya mapokezi</a>
            </nav>
        </aside>

        <main class="min-w-0 flex-1">
            <header class="panel mb-6 flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-slate-500">{{ now()->translatedFormat('l, j F Y H:i') }}</p>
                    <h2 class="text-2xl font-bold text-slate-900">{{ $heading ?? 'Usimamizi' }}</h2>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="admin-button-secondary" type="submit">Toka</button>
                </form>
            </header>

            @if (session('status'))
                <div class="panel mb-6 border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
