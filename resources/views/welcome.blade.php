<x-app-layout>
    <div class="chrome-hero">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 py-16 sm:px-6 sm:py-24 lg:grid-cols-[1.2fr_0.8fr] lg:px-8 lg:py-28">
            <div class="text-white">
                <p class="inline-flex items-center gap-2 border border-white/30 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-gray-200">
                    <span class="h-2 w-2 animate-pulse bg-gray-100"></span> Your daily command center
                </p>
                <h1 class="mt-6 max-w-3xl text-4xl font-bold tracking-tight sm:text-6xl lg:text-7xl">Make today <span class="chrome-text">count.</span></h1>
                <p class="mt-6 max-w-2xl text-base leading-7 text-gray-300 sm:text-lg">Plan with clarity. Keep work moving. Celebrate every task you get done.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('tasks.index') }}" class="btn-light inline-flex items-center justify-center gap-2 px-5 py-3 text-sm font-bold">
                        Explore tasks <span aria-hidden="true" class="transition-transform group-hover:translate-x-1">→</span>
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center border border-gray-500 px-5 py-3 text-sm font-semibold text-white transition hover:border-white hover:bg-white/10">Create your account</a>
                    @endguest
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="chrome-orbit mx-auto flex h-72 w-72 items-center justify-center border border-white/30 p-5">
                    <div class="flex h-full w-full items-center justify-center border border-white/50 bg-black/30 text-8xl font-black tracking-tighter text-white shadow-2xl">A<span class="chrome-text">T</span></div>
                </div>
            </div>
        </div>
    </div>
    <section class="mx-auto grid max-w-7xl gap-4 px-4 py-10 sm:grid-cols-3 sm:px-6 lg:px-8">
        <article class="feature-tile"><span class="feature-index">01</span><h2>Stay focused</h2><p>Keep today’s priorities in one clear, uncluttered list.</p></article>
        <article class="feature-tile"><span class="feature-index">02</span><h2>Track progress</h2><p>Move tasks from pending to done as your day unfolds.</p></article>
        <article class="feature-tile"><span class="feature-index">03</span><h2>Finish strong</h2><p>Get a notification when you mark a task complete.</p></article>
    </section>
</x-app-layout>
