@extends('layouts.admin', ['title' => 'Mipangilio', 'heading' => 'Mipangilio ya dashboard'])

@section('content')
    <section class="panel p-6">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="admin-label" for="court_name">Jina la mahakama</label>
                <input class="admin-input" id="court_name" name="court_name" type="text" value="{{ old('court_name', $setting->court_name) }}" required>
            </div>

            <div>
                <label class="admin-label" for="welcome_text">Ujumbe wa karibu</label>
                <input class="admin-input" id="welcome_text" name="welcome_text" type="text" value="{{ old('welcome_text', $setting->welcome_text) }}">
            </div>

            <div>
                <label class="admin-label" for="directions_text">Maelekezo ya vyumba</label>
                <textarea class="admin-input min-h-36" id="directions_text" name="directions_text">{{ old('directions_text', $setting->directions_text) }}</textarea>
                <p class="mt-2 text-sm text-slate-500">Andika kila maelekezo kwa mstari wake. Yataonekana kwenye slide ya mwelekeo.</p>
            </div>

            <div>
                <label class="admin-label" for="slide_interval_seconds">Muda wa kugeuza slide (sekunde)</label>
                <input class="admin-input" id="slide_interval_seconds" name="slide_interval_seconds" type="number" min="5" max="60" value="{{ old('slide_interval_seconds', $setting->slide_interval_seconds) }}" required>
            </div>

            <div>
                <label class="admin-label" for="map_image">Picha ya ramani</label>
                <input class="admin-input" id="map_image" name="map_image" type="file" accept="image/*">
                @if ($setting->map_image)
                    <img class="mt-4 h-56 rounded-3xl object-cover" src="{{ asset('storage/' . $setting->map_image) }}" alt="Ramani ya vyumba">
                @endif
            </div>

            <button class="admin-button" type="submit">Hifadhi mipangilio</button>
        </form>
    </section>
@endsection
