<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name', 'DevBlog') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#080b12] text-gray-100 antialiased flex flex-col">

    <!-- Background Glow -->
    <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute left-1/4 top-0 h-96 w-96 rounded-full bg-purple-600/10 blur-3xl"></div>
        <div class="absolute right-1/4 top-1/3 h-96 w-96 rounded-full bg-cyan-500/10 blur-3xl"></div>
    </div>

    <!-- Navbar -->
    <header class="sticky top-0 z-50 border-b border-white/10 bg-[#080b12]/80 backdrop-blur-xl">

        <div class="mx-auto flex h-18 max-w-7xl items-center justify-between px-5 lg:px-8">

            <!-- Logo -->
            <a
                href="{{ route('blog.index') }}"
                class="group flex items-center gap-3"
            >
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-cyan-400 shadow-lg shadow-purple-500/20 transition group-hover:scale-105">
                    <span class="text-lg font-black text-white">&lt;/&gt;</span>
                </div>

                <div>
                    <div class="text-xl font-extrabold tracking-tight text-white">
                        Dev<span class="text-purple-400">Blog</span>
                    </div>

                    <div class="hidden text-[10px] font-medium uppercase tracking-[0.2em] text-gray-500 sm:block">
                        Code • Build • Share
                    </div>
                </div>
            </a>

            <!-- Navigation -->
            <nav class="flex items-center gap-3">

                @auth

                    <a
                        href="{{ route('admin.posts.index') }}"
                        class="hidden rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-gray-300 transition hover:border-purple-500/40 hover:bg-purple-500/10 hover:text-white sm:block"
                    >
                        Dashboard
                    </a>

                    <a
                        href="{{ route('blog.index') }}"
                        class="rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-purple-600/20 transition hover:from-purple-500 hover:to-indigo-500"
                    >
                        View Blog
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-gray-300 transition hover:border-purple-500/40 hover:bg-purple-500/10 hover:text-white"
                    >
                        Admin Login
                    </a>

                @endauth

            </nav>

        </div>

    </header>


    <!-- Main Content -->
    <main class="relative flex-1">

        <div class="mx-auto w-full max-w-7xl px-5 py-10 lg:px-8 lg:py-14">

            {{ $slot }}

        </div>

    </main>


    <!-- Footer -->
    <footer class="border-t border-white/10 bg-[#06080d]">

        <div class="mx-auto max-w-7xl px-5 py-10 lg:px-8">

            <div class="flex flex-col items-center justify-between gap-5 sm:flex-row">

                <!-- Brand -->
                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-purple-500 to-cyan-400">
                        <span class="text-sm font-black text-white">&lt;/&gt;</span>
                    </div>

                    <div>
                        <p class="font-bold text-white">
                            Dev<span class="text-purple-400">Blog</span>
                        </p>

                        <p class="text-xs text-gray-500">
                            A developer's corner of the internet.
                        </p>
                    </div>

                </div>


                <!-- Tech Stack -->
                <div class="text-center text-xs text-gray-500 sm:text-right">

                    <p>
                        Built with
                        <span class="font-semibold text-purple-400">Laravel</span>
                        &
                        <span class="font-semibold text-cyan-400">PostgreSQL</span>
                    </p>

                    <p class="mt-1">
                        &copy; {{ date('Y') }} DevBlog. All rights reserved.
                    </p>

                </div>

            </div>

        </div>

    </footer>

</body>
</html>

