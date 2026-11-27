<x-app-layout>
    <x-slot name="header"><h1 class="text-xl font-semibold text-gray-800">Edit task</h1></x-slot>
    <div class="max-w-3xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('tasks.update', $task) }}" class="border border-gray-300 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            @method('PUT')
            @include('tasks.partials.form', ['task' => $task])
            <div class="mt-6 flex items-center gap-4">
                <button class="btn-chrome px-5 py-2.5 text-sm">Save changes</button>
                <a href="{{ route('tasks.show', $task) }}" class="btn-quiet text-sm">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
