<div class="grid gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="admin-label" for="case_name">Jina la shauri</label>
        <input class="admin-input" id="case_name" name="case_name" type="text" value="{{ old('case_name', $caseSchedule->case_name ?? '') }}" required>
        @error('case_name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="admin-label" for="case_number">Nambari ya kesi</label>
        <input class="admin-input" id="case_number" name="case_number" type="text" value="{{ old('case_number', $caseSchedule->case_number ?? '') }}" required>
        @error('case_number')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="admin-label" for="room">Chumba</label>
        <input class="admin-input" id="room" name="room" type="text" value="{{ old('room', $caseSchedule->room ?? '') }}" required>
        @error('room')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="admin-label" for="hearing_time">Saa</label>
        <input class="admin-input" id="hearing_time" name="hearing_time" type="time" value="{{ old('hearing_time', isset($caseSchedule) ? \Illuminate\Support\Carbon::parse($caseSchedule->hearing_time)->format('H:i') : '') }}" required>
        @error('hearing_time')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="admin-label" for="service_date">Tarehe ya huduma</label>
        <input class="admin-input" id="service_date" name="service_date" type="date" value="{{ old('service_date', isset($caseSchedule) ? $caseSchedule->service_date->toDateString() : ($selectedDate ?? now()->toDateString())) }}" required>
        @error('service_date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="admin-label" for="status">Hali</label>
        <select class="admin-input" id="status" name="status" required>
            @foreach ($statuses as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $caseSchedule->status ?? 'waiting') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="md:col-span-2">
        <label class="admin-label" for="notes">Maelezo ya ziada</label>
        <textarea class="admin-input min-h-28" id="notes" name="notes">{{ old('notes', $caseSchedule->notes ?? '') }}</textarea>
    </div>
</div>
