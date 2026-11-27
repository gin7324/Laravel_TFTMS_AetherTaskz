<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Task details</p>
                <h1 class="mt-1 text-xl font-semibold text-gray-900 sm:text-2xl">{{ $task->title }}</h1>
            </div>
            @auth
                <a href="{{ route('tasks.edit', $task) }}" class="btn-chrome px-4 py-2 text-sm">Edit task</a>
            @endauth
        </div>
    </x-slot>
    <div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        @if (session('status'))
            <div role="status" class="mb-4 border border-gray-300 bg-white p-4 text-gray-800">{{ session('status') }}</div>
        @endif
        <article class="border border-gray-300 bg-white p-5 shadow-sm sm:p-8">
            <p class="inline-flex border border-gray-500 bg-gray-100 px-3 py-1 text-sm font-semibold uppercase tracking-wide text-gray-800">{{ str_replace('_', ' ', ucfirst($task->status)) }}</p>
            @if ($task->due_date)
                <p class="mt-4 text-sm text-gray-500">Due {{ $task->due_date->format('M j, Y') }}</p>
            @endif
            <div class="mt-6 whitespace-pre-line text-gray-700">{{ $task->description ?: 'No description provided.' }}</div>
            @auth
                <form x-data="{ confirming: false }" method="POST" action="{{ route('tasks.destroy', $task) }}" class="mt-8 border-t border-gray-200 pt-6">
                    @csrf
                    @method('DELETE')
                    <button x-show="!confirming" type="button" @click="confirming = true" class="text-sm font-semibold text-gray-700 underline decoration-gray-400 underline-offset-4 hover:text-gray-950">Archive task</button>
                    <div x-cloak x-show="confirming" x-transition class="flex flex-wrap items-center gap-3" role="group" aria-label="Confirm task archive">
                        <span class="mr-2 text-sm text-gray-700">Archive this task? It will be hidden from the task list.</span>
                        <button type="submit" class="btn-chrome px-4 py-2 text-sm">Confirm archive</button>
                        <button type="button" @click="confirming = false" class="btn-quiet px-3 py-2 text-sm">Cancel</button>
                    </div>
                </form>
            @endauth
        </article>
        <a href="{{ route('tasks.index') }}" class="btn-quiet mt-6 inline-flex text-sm underline underline-offset-4">Back to tasks</a>
    </div>
</x-app-layout>
