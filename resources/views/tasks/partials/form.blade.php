<div class="space-y-5">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input id="title" name="title" value="{{ old('title', $task?->title) }}" required maxlength="255" class="mt-1 block w-full rounded-none border-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600">
        @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <div x-data="{ count: {{ strlen(old('description', $task?->description ?? '')) }} }">
            <textarea id="description" name="description" rows="5" maxlength="10000" @input="count = $event.target.value.length" class="mt-1 block w-full rounded-none border-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600">{{ old('description', $task?->description) }}</textarea>
            <p class="mt-1 text-right text-xs text-gray-500"><span x-text="count"></span> / 10,000 characters</p>
        </div>
        @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="due_date" class="block text-sm font-medium text-gray-700">Due date <span class="font-normal text-gray-500">(optional)</span></label>
        <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task?->due_date?->format('Y-m-d')) }}" class="mt-1 block rounded-none border-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600">
        @error('due_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select id="status" name="status" required class="mt-1 block w-full rounded-none border-gray-300 shadow-sm focus:border-gray-600 focus:ring-gray-600">
            @foreach (['pending' => 'Pending', 'in_progress' => 'In progress', 'done' => 'Done'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $task?->status ?? 'pending') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
</div>
