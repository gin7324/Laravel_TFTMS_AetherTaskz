<x-app-layout>
    <x-slot name="header"><h1 class="text-xl font-semibold text-gray-800">About</h1></x-slot>
    <div class="max-w-4xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
        <div class="border border-gray-300 bg-white p-6 shadow-sm sm:p-8">
            <p class="text-base leading-7 text-gray-700"><strong class="font-semibold text-gray-950">AetherTaskz</strong> is a web-based task management application built with <strong class="font-semibold text-gray-950">Laravel</strong> and secured through <strong class="font-semibold text-gray-950">Laravel Breeze Authentication</strong>.</p>
            <p class="mt-5 text-base leading-7 text-gray-700">Created and developed by <strong class="font-semibold text-gray-950">Gene</strong>, this platform helps users manage their daily tasks efficiently through a simple, secure, and intuitive interface. The project reflects a commitment to building practical solutions that improve productivity and organization.</p>

            <dl class="mt-8 grid gap-4 border-t border-gray-200 pt-6 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Developer</dt>
                    <dd class="mt-1 font-medium text-gray-900">Gene Kenry D. Peralta</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Framework</dt>
                    <dd class="mt-1 font-medium text-gray-900">Laravel</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Authentication</dt>
                    <dd class="mt-1 font-medium text-gray-900">Laravel Breeze</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Purpose</dt>
                    <dd class="mt-1 font-medium text-gray-900">Daily Task Management and Productivity Tracking</dd>
                </div>
            </dl>
        </div>
    </div>
</x-app-layout>
