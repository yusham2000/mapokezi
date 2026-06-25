<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->court_name }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="h-screen overflow-hidden bg-[linear-gradient(135deg,_#1c1917,_#0f172a_55%,_#1e293b)] text-white">
    <div class="relative h-screen overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(251,191,36,0.3),_transparent_25%),radial-gradient(circle_at_bottom_left,_rgba(14,165,233,0.2),_transparent_30%)]"></div>

        <div class="relative flex h-screen flex-col gap-4 p-4 lg:gap-5 lg:p-6" data-rotator data-interval="{{ $setting->slide_interval_seconds }}">
            <header class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-amber-300">Mapokezi ya mahakama</p>
                    <h1 class="mt-2 text-3xl font-black lg:text-5xl">{{ $setting->court_name }}</h1>
                    <p class="mt-2 max-w-3xl text-sm text-slate-300 lg:text-lg">{{ $setting->welcome_text }}</p>
                </div>
                <div class="rounded-[2rem] border border-white/10 bg-white/10 px-4 py-3 text-right shadow-2xl backdrop-blur">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-300 lg:text-sm">{{ $today->translatedFormat('l') }}</p>
                    <p class="mt-1 text-2xl font-black lg:text-3xl">{{ $today->format('d/m/Y') }}</p>
                </div>
            </header>

            <section data-slide class="panel hidden min-h-0 flex-1 overflow-hidden border-white/10 bg-white/10 p-5 text-white lg:p-6">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-black lg:text-4xl">Ratiba ya kesi leo</h2>
                    </div>
                    <div class="rounded-2xl bg-emerald-500/15 px-4 py-3 text-sm text-emerald-200">
                        Kesi zinazoendelea: <span class="font-bold">{{ $servingCases->count() }}</span>
                    </div>
                </div>

                <div class="min-h-0 overflow-auto rounded-[2rem] border border-white/10">
                    <table class="min-w-full text-left">
                        <thead class="bg-white/10 text-sm uppercase tracking-[0.2em] text-slate-300">
                            <tr>
                                <th class="px-4 py-4">Foleni</th>
                                <th class="px-4 py-4">Jina la shauri</th>
                                <th class="px-4 py-4">Namba ya kesi</th>
                                <th class="px-4 py-4">Chumba</th>
                                <th class="px-4 py-4">Saa</th>
                                <th class="px-4 py-4">Hali</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm lg:text-base">
                            @forelse ($todayCases as $case)
                                <tr class="border-t border-white/10 {{ $case->status === 'serving' ? 'bg-emerald-500/10' : 'bg-slate-900/10' }}">
                                    <td class="px-4 py-3 text-xl font-black text-amber-300 lg:text-2xl">{{ $case->queue_number }}</td>
                                    <td class="px-4 py-4">{{ $case->case_name }}</td>
                                    <td class="px-4 py-4">{{ $case->case_number }}</td>
                                    <td class="px-4 py-4">{{ $case->room }}</td>
                                    <td class="px-4 py-4">{{ \Illuminate\Support\Carbon::parse($case->hearing_time)->format('H:i') }}</td>
                                    <td class="px-4 py-4">
                                        <span class="status-badge {{ $case->status === 'serving' ? 'bg-emerald-300 text-emerald-950' : ($case->status === 'done' ? 'bg-slate-300 text-slate-900' : 'bg-amber-300 text-amber-950') }}">
                                            {{ $case->status === 'serving' ? 'Inaendelea' : ($case->status === 'done' ? 'Imekamilika' : 'Inasubiri') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-4 py-6 text-slate-300" colspan="6">Hakuna kesi zilizowekwa kwa leo.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section data-slide class="panel hidden min-h-0 flex-1 overflow-hidden border-white/10 bg-white/10 p-5 text-white lg:p-6">
                <h2 class="text-3xl font-black lg:text-4xl">Vyumba vinavyosikiliza sasa</h2>
                <div class="mt-5 grid min-h-0 auto-rows-fr gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($servingCases as $case)
                        <article class="flex min-h-0 flex-col rounded-[2rem] border border-white/10 bg-slate-950/30 p-5">
                            <p class="text-3xl font-black text-amber-300 lg:text-4xl">Foleni {{ $case->queue_number }}</p>
                            <p class="mt-3 text-xs uppercase tracking-[0.3em] text-slate-300 lg:text-sm">Chumba namba {{ $case->room }}</p>
                            <p class="mt-4 line-clamp-3 text-xl font-bold leading-snug text-white lg:text-2xl">{{ $case->case_name }}</p>
                            <div class="mt-auto pt-4 text-sm text-slate-300 lg:text-base">
                                <p>Namba ya kesi: {{ $case->case_number }}</p>
                                <p class="mt-2">Saa: {{ \Illuminate\Support\Carbon::parse($case->hearing_time)->format('H:i') }}</p>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-[2rem] border border-dashed border-white/20 p-6 text-slate-300 md:col-span-2 xl:col-span-3">
                            Hakuna chumba kilichowekwa kama kinasikiliza sasa.
                        </div>
                    @endforelse
                </div>
            </section>

            <section data-slide class="panel hidden min-h-0 flex-1 overflow-hidden border-white/10 bg-white/10 p-5 text-white lg:p-6">
                <h2 class="text-3xl font-black lg:text-4xl">Huduma zinazotolewa</h2>
                <div class="mt-5 grid min-h-0 auto-rows-fr gap-4 md:grid-cols-2 xl:grid-cols-4">
                    @foreach ($services as $service)
                        <article class="rounded-[2rem] border border-white/10 bg-slate-950/30 p-5">
                            <p class="text-sm uppercase tracking-[0.3em] text-slate-300">Huduma</p>
                            <h3 class="mt-3 text-xl font-black text-amber-300 lg:text-2xl">{{ $service->name }}</h3>
                            <p class="mt-3 text-sm text-slate-200 lg:text-base">{{ $service->description }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            <section data-slide class="panel hidden min-h-0 flex-1 overflow-hidden border-white/10 bg-white/10 p-5 text-white lg:p-6">
                <h2 class="text-3xl font-black lg:text-4xl">Matangazo</h2>
                <div class="mt-5 grid min-h-0 gap-4 overflow-auto xl:grid-cols-2">
                    @forelse ($announcements as $announcement)
                        <article class="rounded-[2rem] border border-white/10 bg-slate-950/30 p-5">
                            <p class="text-sm uppercase tracking-[0.3em] text-slate-300">{{ $announcement->title }}</p>
                            <p class="mt-4 text-xl font-bold leading-relaxed text-white lg:text-2xl">{{ $announcement->message }}</p>
                        </article>
                    @empty
                        <div class="rounded-[2rem] border border-dashed border-white/20 p-6 text-slate-300">
                            Hakuna matangazo hai kwa sasa.
                        </div>
                    @endforelse
                </div>
            </section>

            <section data-slide class="panel hidden min-h-0 flex-1 overflow-hidden border-white/10 bg-white/10 p-5 text-white lg:p-6">
                <h2 class="text-3xl font-black lg:text-4xl">Mwelekeo wa vyumba</h2>
                <div class="mt-5 grid min-h-0 gap-4 xl:grid-cols-[1fr_0.9fr]">
                    <div class="min-h-0 overflow-auto rounded-[2rem] border border-white/10 bg-slate-950/30 p-5">
                        <h3 class="text-xl font-bold text-amber-300">Mwongozo mfupi</h3>
                        @php
                            $directions = collect(preg_split('/\r\n|\r|\n/', (string) $setting->directions_text))
                                ->map(fn ($line) => trim($line))
                                ->filter();
                        @endphp
                        @if ($directions->isNotEmpty())
                            <ul class="mt-5 space-y-4 text-lg text-slate-200">
                                @foreach ($directions as $direction)
                                    <li>{{ $direction }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mt-5 text-lg text-slate-300">Weka maelekezo ya vyumba kwenye admin ili yaonekane hapa.</p>
                        @endif
                    </div>

                    <div class="rounded-[2rem] border border-white/10 bg-slate-950/30 p-4">
                        @if ($setting->map_image)
                            <img class="h-full max-h-full min-h-64 w-full rounded-[1.5rem] object-cover" src="{{ asset('storage/' . $setting->map_image) }}" alt="Ramani ya vyumba">
                        @else
                            <div class="flex min-h-64 items-center justify-center rounded-[1.5rem] border border-dashed border-white/15 text-center text-slate-300">
                                Pakia picha ya ramani kwenye admin ili ionekane hapa.
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
