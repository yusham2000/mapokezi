<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingia - Mapokezi ya Mahakama</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-[linear-gradient(145deg,_#422006,_#b45309_45%,_#f5f5f4_45%,_#fafaf9)]">
    <div class="mx-auto flex min-h-screen max-w-6xl items-center px-4 py-10">
        <div class="grid w-full gap-8 lg:grid-cols-[1.2fr_0.8fr]">
            <section class="rounded-[2rem] bg-slate-950/90 p-8 text-white shadow-2xl">
                <p class="text-sm uppercase tracking-[0.35em] text-amber-300">Mahakama</p>
                <h1 class="mt-4 text-4xl font-black leading-tight">Mfumo wa mapokezi na ufuatiliaji wa ratiba za kesi.</h1>
                <p class="mt-4 max-w-2xl text-base text-slate-300">
                    Ingia kama mtumishi ili kusasisha ratiba ya leo, foleni za kesi, matangazo na mwelekeo wa vyumba.
                </p>
                <div class="mt-8 rounded-3xl border border-white/10 bg-white/5 p-5 text-sm text-slate-300">
                    login details:
                    <div class="mt-2 font-semibold text-white">admin@mapokezi.test / password</div>
                </div>
            </section>

            <section class="panel p-8">
                <h2 class="text-2xl font-bold text-slate-900">Ingia</h2>
                <p class="mt-2 text-sm text-slate-600">Tumia akaunti ya staff kufungua eneo la usimamizi.</p>

                <form method="POST" action="{{ route('login.attempt') }}" class="mt-8 space-y-5">
                    @csrf
                    <div>
                        <label class="admin-label" for="email">Barua pepe</label>
                        <input class="admin-input" id="email" name="email" type="email" value="{{ old('email') }}" required>
                        @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="admin-label" for="password">Nenosiri</label>
                        <input class="admin-input" id="password" name="password" type="password" required>
                    </div>

                    <label class="flex items-center gap-3 text-sm text-slate-600">
                        <input class="size-4 rounded border-stone-300" name="remember" type="checkbox" value="1">
                        Nikumbuke
                    </label>

                    <button class="admin-button w-full" type="submit">Ingia kwenye mfumo</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
