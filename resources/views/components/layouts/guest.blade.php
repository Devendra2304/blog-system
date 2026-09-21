<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DevBlog') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#080b12] font-sans text-gray-100 antialiased">

    <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-5 py-12">

        <!-- Background Glows -->
        <div class="pointer-events-none absolute inset-0">

            <div class="absolute left-1/4 top-0 h-96 w-96 rounded-full bg-purple-600/10 blur-3xl"></div>

            <div class="absolute bottom-0 right-1/4 h-96 w-96 rounded-full bg-cyan-500/10 blur-3xl"></div>

        </div>


        <!-- Login/Register Container -->
        <div class="relative w-full max-w-md">

            <!-- DevBlog Logo -->
            <div class="mb-8 text-center">

                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-3">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-cyan-400 shadow-lg shadow-purple-500/20">
                        <span class="text-lg font-black text-white">
                            &lt;/&gt;
                        </span>
                    </div>

                    <div class="text-2xl font-extrabold tracking-tight text-white">
                        Dev<span class="text-purple-400">Blog</span>
                    </div>

                </a>

            </div>


            <!-- Authentication Card -->
            <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/[0.035] p-6 shadow-2xl shadow-black/30 sm:p-8">

                {{ $slot }}

            </div>


            <!-- Back to Blog -->
            <div class="mt-6 text-center">

                <a
                    href="{{ route('blog.index') }}"
                    class="text-sm text-gray-500 transition hover:text-purple-400"
                >
                    &larr; Back to DevBlog
                </a>

            </div>

        </div>

    </div>

</body>

</html>