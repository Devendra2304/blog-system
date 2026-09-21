<x-layouts.blog>

    <x-slot name="title">
        {{ $post->title }} - DevBlog
    </x-slot>


    <!-- Article -->
    <article class="mx-auto max-w-4xl">

        <!-- Back Button -->
        <a
            href="{{ route('blog.index') }}"
            class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-gray-500 transition hover:text-purple-400"
        >
            <span class="transition-transform group-hover:-translate-x-1">
                &larr;
            </span>

            Back to all posts
        </a>


        <!-- Article Card -->
        <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

            <!-- Article Header -->
            <div class="relative overflow-hidden px-6 py-10 sm:px-10 sm:py-14">

                <!-- Background Glow -->
                <div class="pointer-events-none absolute -right-32 -top-32 h-80 w-80 rounded-full bg-purple-600/10 blur-3xl"></div>

                <div class="pointer-events-none absolute -bottom-32 left-1/3 h-72 w-72 rounded-full bg-cyan-500/5 blur-3xl"></div>


                <div class="relative">

                    <!-- Category + Date -->
                    <div class="mb-6 flex flex-wrap items-center gap-3 text-xs">

                        @if($post->category)

                            <a
                                href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                                class="rounded-full border border-purple-500/20 bg-purple-500/10 px-3 py-1.5 font-semibold text-purple-300 transition hover:bg-purple-500/20"
                            >
                                {{ $post->category->name }}
                            </a>

                        @endif

                        <span class="text-gray-600">
                            •
                        </span>

                        <time class="text-gray-500">
                            {{ $post->created_at->format('F d, Y') }}
                        </time>

                    </div>


                    <!-- Title -->
                    <h1 class="max-w-3xl text-4xl font-black leading-tight tracking-tight text-white sm:text-5xl">
                        {{ $post->title }}
                    </h1>


                    <!-- Author -->
                    <div class="mt-7 flex items-center gap-3 border-t border-white/10 pt-6">

                        <!-- Avatar -->
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-cyan-400 text-sm font-black text-white">
                            {{ strtoupper(substr($post->author->name ?? 'A', 0, 1)) }}
                        </div>

                        <div>
                            <p class="text-xs text-gray-500">
                                Written by
                            </p>

                            <p class="text-sm font-semibold text-gray-200">
                                {{ $post->author->name ?? 'Admin' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            <!-- Article Body -->
            <div class="border-t border-white/10 px-6 py-10 sm:px-10 sm:py-12">

                <div class="prose prose-invert max-w-none text-lg leading-8 text-gray-300">

                    <div class="whitespace-pre-line">
                        {{ $post->content }}
                    </div>

                </div>

            </div>


            <!-- Tags Footer -->
            <div class="border-t border-white/10 bg-white/[0.02] px-6 py-6 sm:px-10">

                <div class="flex flex-wrap items-center gap-2">

                    <span class="mr-2 text-xs font-semibold uppercase tracking-wider text-gray-600">
                        Tags
                    </span>

                    @foreach($post->tags as $tag)

                        <a
                            href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                            class="rounded-lg border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-medium text-gray-400 transition hover:border-cyan-500/30 hover:bg-cyan-500/10 hover:text-cyan-300"
                        >
                            #{{ $tag->name }}
                        </a>

                    @endforeach

                </div>

            </div>

        </div>


        <!-- Bottom Navigation -->
        <div class="mt-8 flex justify-center">

            <a
                href="{{ route('blog.index') }}"
                class="rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-gray-300 transition hover:border-purple-500/30 hover:bg-purple-500/10 hover:text-white"
            >
                &larr; Back to all articles
            </a>

        </div>

    </article>

</x-layouts.blog>