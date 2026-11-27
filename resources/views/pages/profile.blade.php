<x-app-layout>
    <x-slot name="header"><h1 class="text-xl font-semibold text-gray-800">Profile</h1></x-slot>
    <div class="max-w-4xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-lg bg-white p-8 shadow-sm">
            <h2 class="text-2xl font-bold text-gray-900">Welcome to AetherTaskz</h2>
            <p class="mt-3 text-gray-600">A shared task management space for planning, tracking, and completing everyday work.</p>
            @auth
                <a class="mt-6 inline-block text-indigo-700 underline" href="{{ route('account.profile.edit') }}">Manage your account</a>
            @else
                <a class="mt-6 inline-block text-indigo-700 underline" href="{{ route('login') }}">Log in to manage your account</a>
            @endauth
        </div>
    </div>
</x-app-layout>
