<section class="panel p-6">
    <form method="POST" action="{{ $action }}" class="space-y-5">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div>
            <label class="admin-label" for="title">Kichwa</label>
            <input class="admin-input" id="title" name="title" type="text" value="{{ old('title', $announcement->title ?? '') }}" required>
        </div>

        <div>
            <label class="admin-label" for="message">Ujumbe</label>
            <textarea class="admin-input min-h-32" id="message" name="message" required>{{ old('message', $announcement->message ?? '') }}</textarea>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label class="admin-label" for="start_date">Tarehe ya kuanza</label>
                <input class="admin-input" id="start_date" name="start_date" type="date" value="{{ old('start_date', isset($announcement) ? optional($announcement->start_date)->toDateString() : '') }}">
            </div>

            <div>
                <label class="admin-label" for="end_date">Tarehe ya mwisho</label>
                <input class="admin-input" id="end_date" name="end_date" type="date" value="{{ old('end_date', isset($announcement) ? optional($announcement->end_date)->toDateString() : '') }}">
            </div>
        </div>

        <label class="flex items-center gap-3 text-sm text-slate-700">
            <input class="size-4 rounded border-stone-300" name="is_active" type="checkbox" value="1" @checked(old('is_active', $announcement->is_active ?? true))>
            Tangazo liwe hai
        </label>

        <div class="flex gap-3">
            <button class="admin-button" type="submit">Hifadhi</button>
            <a class="admin-button-secondary" href="{{ route('admin.announcements.index') }}">Rudi</a>
        </div>
    </form>
</section>
