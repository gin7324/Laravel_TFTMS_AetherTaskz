<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">AetherTaskz workspace</p>
                <h1 class="mt-1 text-xl font-semibold text-gray-900 sm:text-2xl">Tasks</h1>
            </div>
            @auth
                <a href="{{ route('tasks.create') }}" class="btn-chrome px-4 py-2 text-sm">+ New task</a>
            @else
                <a href="{{ route('login') }}" class="btn-chrome px-4 py-2 text-sm">Log in to create a task</a>
            @endauth
        </div>
    </x-slot>
    <div x-data="{
            query: '',
            status: 'all',
            visible: {{ $tasks->count() }},
            getVisible() {
                if (!this.$refs.taskList) return 0;
                return Array.from(this.$refs.taskList.querySelectorAll('[data-task-card]'))
                    .filter(task => (this.status === 'all' || task.dataset.status === this.status)
                        && task.dataset.search.includes(this.query.trim().toLowerCase())).length;
            }
         }"
         x-init="$nextTick(() => visible = getVisible())"
         x-effect="visible = getVisible()"
         class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
        @if (session('status'))
            <div x-data="{ shown: true }" x-show="shown" x-transition role="status" class="mb-5 flex items-center justify-between border border-gray-300 bg-white p-4 text-sm text-gray-800 shadow-sm">
                <span>{{ session('status') }}</span>
                <button @click="shown = false" aria-label="Dismiss notification" class="ml-4 text-lg leading-none text-gray-500 hover:text-gray-950">&times;</button>
            </div>
        @endif
        <div class="mb-5 flex flex-col gap-3 border border-gray-300 bg-white p-4 shadow-sm sm:flex-row sm:items-end">
            <div class="min-w-0 flex-1">
                <label for="task-search" class="mb-1 block text-xs font-semibold uppercase tracking-wider text-gray-600">Search this page</label>
                <input id="task-search" x-model.debounce.150ms="query" type="search" placeholder="Search task titles and descriptions" class="task-filter w-full">
            </div>
            <div>
                <label for="task-status-filter" class="mb-1 block text-xs font-semibold uppercase tracking-wider text-gray-600">Status</label>
                <select id="task-status-filter" x-model="status" class="task-filter w-full sm:w-48">
                    <option value="all">All statuses</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In progress</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <p class="text-sm text-gray-500 sm:pb-2" aria-live="polite"><span x-text="visible"></span> shown</p>
        </div>
        <div x-ref="taskList" class="divide-y divide-gray-200 border border-gray-300 bg-white shadow-sm">
            @forelse ($tasks as $task)
                <a data-task-card data-status="{{ $task->status }}" data-search="{{ strtolower($task->title.' '.$task->description) }}"
                   x-show="(status === 'all' || status === '{{ $task->status }}') && (!query || $el.dataset.search.includes(query.trim().toLowerCase()))"
                   href="{{ route('tasks.show', $task) }}" class="task-card">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h2 class="font-semibold text-gray-900">{{ $task->title }}</h2>
                        <span @class([
                            'border px-3 py-1 text-xs font-semibold uppercase tracking-wide',
                            'border-gray-300 bg-gray-100 text-gray-700' => $task->status === 'pending',
                            'border-gray-500 bg-gray-200 text-gray-800' => $task->status === 'in_progress',
                            'border-gray-800 bg-gray-800 text-white' => $task->status === 'done',
                        ])>{{ str_replace('_', ' ', ucfirst($task->status)) }}</span>
                    </div>
                    @if ($task->description)
                        <p class="mt-2 line-clamp-2 text-sm text-gray-600">{{ $task->description }}</p>
                    @endif
                    @if ($task->due_date)
                        <p class="mt-2 text-xs text-gray-500">Due {{ $task->due_date->format('M j, Y') }}</p>
                    @endif
                </a>
            @empty
                <p class="p-8 text-center text-gray-600">No active tasks yet.</p>
            @endforelse
        </div>
        <p x-cloak x-show="visible === 0 && {{ $tasks->count() > 0 ? 'true' : 'false' }}" class="mt-5 border border-dashed border-gray-400 p-8 text-center text-gray-600">No tasks match these filters. Try another search or status.</p>
        <div class="mt-6">{{ $tasks->links() }}</div>
    </div>
</x-app-layout>
