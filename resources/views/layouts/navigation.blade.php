<nav x-data="{ open: false }" @keydown.escape.window="open = false" class="sticky top-0 z-40 border-b border-gray-300 bg-white/95 shadow-sm backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="brand-wordmark text-lg font-extrabold tracking-tight text-gray-950">
                    <span class="mr-2 inline-flex h-7 w-7 items-center justify-center bg-gray-900 text-xs font-black text-white">A</span>{{ config('app.name') }}
                </a>
                <div class="hidden items-center gap-6 sm:flex">
                    <a href="{{ route('tasks.index') }}" @class(['nav-item', 'nav-item-active' => request()->routeIs('tasks.*')])>Tasks</a>
                    <a href="{{ route('profile.public') }}" @class(['nav-item', 'nav-item-active' => request()->routeIs('profile.public')])>Profile</a>
                    <a href="{{ route('about') }}" @class(['nav-item', 'nav-item-active' => request()->routeIs('about')])>About</a>
                </div>
            </div>
            <div class="hidden items-center gap-4 sm:flex">
                @auth
                    <a href="{{ route('account.profile.edit') }}" class="text-sm font-medium text-gray-700 transition hover:text-gray-950">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn-quiet text-sm">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-quiet text-sm">Log in</a>
                    <a href="{{ route('register') }}" class="btn-chrome px-3 py-2 text-sm">Register</a>
                @endauth
            </div>
            <button @click="open = !open" :aria-expanded="open.toString()" aria-controls="mobile-navigation" aria-label="Toggle navigation" class="inline-flex h-10 w-10 items-center justify-center border border-gray-300 text-gray-800 transition hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-700 sm:hidden">
                <svg x-show="!open" aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="square" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" x-cloak aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="square" stroke-width="2" d="m6 6 12 12M18 6 6 18"/></svg>
            </button>
        </div>
    </div>
    <div id="mobile-navigation" x-show="open" x-cloak x-transition class="border-t border-gray-200 bg-gray-50 px-4 py-3 sm:hidden">
        <div class="mx-auto max-w-7xl space-y-1">
            <a @click="open = false" class="mobile-nav-item" href="{{ route('tasks.index') }}">Tasks</a>
            <a @click="open = false" class="mobile-nav-item" href="{{ route('profile.public') }}">Profile</a>
            <a @click="open = false" class="mobile-nav-item" href="{{ route('about') }}">About</a>
        @auth
            <a @click="open = false" class="mobile-nav-item" href="{{ route('account.profile.edit') }}">Account settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mobile-nav-item w-full text-left">Log out</button>
            </form>
        @else
            <a @click="open = false" class="mobile-nav-item" href="{{ route('login') }}">Log in</a>
            <a @click="open = false" class="mobile-nav-item" href="{{ route('register') }}">Register</a>
        @endauth
        </div>
    </div>
</nav>
