<section class="panel p-6">
    <form method="POST" action="{{ $action }}" class="space-y-5">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div>
            <label class="admin-label" for="name">Jina la huduma</label>
            <input class="admin-input" id="name" name="name" type="text" value="{{ old('name', $service->name ?? '') }}" required>
        </div>

        <div>
            <label class="admin-label" for="description">Maelezo</label>
            <input class="admin-input" id="description" name="description" type="text" value="{{ old('description', $service->description ?? '') }}">
        </div>

        <div>
            <label class="admin-label" for="display_order">Nafasi ya kuonekana</label>
            <input class="admin-input" id="display_order" name="display_order" type="number" min="1" value="{{ old('display_order', $service->display_order ?? 1) }}" required>
        </div>

        <label class="flex items-center gap-3 text-sm text-slate-700">
            <input class="size-4 rounded border-stone-300" name="is_active" type="checkbox" value="1" @checked(old('is_active', $service->is_active ?? true))>
            Onesha huduma hii kwenye dashboard
        </label>

        <div class="flex gap-3">
            <button class="admin-button" type="submit">Hifadhi</button>
            <a class="admin-button-secondary" href="{{ route('admin.services.index') }}">Rudi</a>
        </div>
    </form>
</section>
