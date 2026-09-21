<x-layouts.blog>

    <x-slot:title>
        DevBlog - Home
    </x-slot:title>

    <!-- Hero -->
    <section class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-purple-600/20 via-[#111827] to-cyan-500/10 px-6 py-14 shadow-2xl shadow-purple-900/10 sm:px-10 lg:px-14">

        <!-- Glow -->
        <div class="pointer-events-none absolute -right-20 -top-20 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-cyan-500/10 blur-3xl"></div>

        <div class="relative max-w-3xl">

            <p class="mb-4 text-sm font-bold uppercase tracking-[0.2em] text-purple-400">
                Welcome to DevBlog
            </p>

            <h1 class="text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl">
                Learn.
                <span class="text-purple-400">Build.</span>
                <span class="text-cyan-400">Share.</span>
            </h1>

            <p class="mt-6 max-w-2xl text-base leading-7 text-gray-400 sm:text-lg">
                Explore tutorials, programming insights, development tips,
                and ideas from the developer community.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <span class="rounded-full border border-purple-500/20 bg-purple-500/10 px-4 py-2 text-sm text-purple-300">
                    Laravel
                </span>

                <span class="rounded-full border border-cyan-500/20 bg-cyan-500/10 px-4 py-2 text-sm text-cyan-300">
                    Web Development
                </span>

                <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-gray-400">
                    Programming
                </span>
            </div>

        </div>
    </section>


    <!-- Main Content -->
    <div class="mt-10 grid grid-cols-1 gap-8 lg:grid-cols-4">

        <!-- Left Content -->
        <div class="lg:col-span-3">

            <!-- Search -->
            <div class="rounded-2xl border border-white/10 bg-white/[0.035] p-4 shadow-xl shadow-black/10">

                <form method="GET" action="{{ route('blog.index') }}"
                      class="flex flex-col gap-3 sm:flex-row">

                    <div class="relative flex-1">

                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-lg text-gray-500">
                            🔍
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search articles..."
                            class="w-full rounded-xl border border-white/10 bg-white/5 py-3.5 pl-11 pr-4 text-sm text-white placeholder-gray-500 outline-none transition focus:border-purple-500/50 focus:bg-white/[0.07] focus:ring-2 focus:ring-purple-500/10"
                        >

                    </div>

                    <button
                        type="submit"
                        class="rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-purple-600/20 transition hover:from-purple-500 hover:to-indigo-500 hover:shadow-purple-500/30"
                    >
                        Search
                    </button>

                </form>

            </div>


            <!-- Active Filters -->
            @if(request('search') || request('category') || request('tag'))

                <div class="mt-5 flex flex-wrap items-center gap-2">

                    <span class="text-sm text-gray-500">
                        Active filters:
                    </span>

                    @if(request('search'))
                        <span class="rounded-full border border-purple-500/20 bg-purple-500/10 px-3 py-1 text-xs font-medium text-purple-300">
                            Search: {{ request('search') }}
                        </span>
                    @endif

                    @if(request('category'))
                        <span class="rounded-full border border-cyan-500/20 bg-cyan-500/10 px-3 py-1 text-xs font-medium text-cyan-300">
                            Category: {{ request('category') }}
                        </span>
                    @endif

                    @if(request('tag'))
                        <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-gray-300">
                            Tag: {{ request('tag') }}
                        </span>
                    @endif

                    <a
                        href="{{ route('blog.index') }}"
                        class="text-xs font-semibold text-gray-500 transition hover:text-white"
                    >
                        Clear filters
                    </a>

                </div>

            @endif


            <!-- Articles Header -->
            <div class="mt-10 flex items-end justify-between">

                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-purple-400">
                        Latest Articles
                    </p>

                    <h2 class="mt-2 text-2xl font-black tracking-tight text-white sm:text-3xl">
                        From the Blog
                    </h2>
                </div>

                <div class="hidden text-sm text-gray-500 sm:block">
                    {{ $posts->total() }}
                    {{ Str::plural('article', $posts->total()) }}
                </div>

            </div>


            <!-- Articles -->
            <div class="mt-6 space-y-5">

                @forelse($posts as $post)

                    <article
                        class="group rounded-2xl border border-white/10 bg-white/[0.035] p-6 shadow-xl shadow-black/10 transition duration-300 hover:-translate-y-1 hover:border-purple-500/30 hover:bg-white/[0.055] hover:shadow-purple-900/10"
                    >

                        <!-- Meta -->
                        <div class="flex flex-wrap items-center gap-2 text-xs">

                            @if($post->category)

                                <a
                                    href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                                    class="rounded-full border border-purple-500/20 bg-purple-500/10 px-3 py-1.5 font-semibold text-purple-300 transition hover:bg-purple-500/20"
                                >
                                    {{ $post->category->name }}
                                </a>

                            @endif

                            <span class="text-gray-600">•</span>

                            <span class="text-gray-500">
                                {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Not published' }}
                            </span>

                            <span class="text-gray-600">•</span>

                            <span class="text-gray-500">
                                By {{ $post->author?->name ?? 'Admin' }}
                            </span>

                        </div>


                        <!-- Title -->
                        <h3 class="mt-4 text-2xl font-bold leading-tight text-white transition group-hover:text-purple-400">

                            <a href="{{ route('blog.show', $post) }}">
                                {{ $post->title }}
                            </a>

                        </h3>


                        <!-- Summary -->
                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-400">
                            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 180) }}
                        </p>


                        <!-- Tags + Read -->
                        <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex flex-wrap gap-2">

                                @foreach($post->tags as $tag)

                                    <a
                                        href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                                        class="rounded-lg border border-white/10 bg-white/5 px-2.5 py-1 text-xs text-gray-400 transition hover:border-purple-500/30 hover:bg-purple-500/10 hover:text-purple-300"
                                    >
                                        #{{ $tag->name }}
                                    </a>

                                @endforeach

                            </div>


                            <a
                                href="{{ route('blog.show', $post) }}"
                                class="inline-flex items-center gap-2 text-sm font-bold text-purple-400 transition hover:text-cyan-400"
                            >
                                Read article
                                <span class="transition-transform group-hover:translate-x-1">
                                    →
                                </span>
                            </a>

                        </div>

                    </article>

                @empty

                    <div class="rounded-2xl border border-dashed border-white/10 bg-white/[0.025] px-6 py-16 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-500/10 text-2xl">
                            🔎
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-white">
                            No articles found
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Try changing your search or filters.
                        </p>

                        <a
                            href="{{ route('blog.index') }}"
                            class="mt-5 inline-block text-sm font-semibold text-purple-400 hover:text-cyan-400"
                        >
                            View all articles →
                        </a>

                    </div>

                @endforelse

            </div>


            <!-- Pagination -->
            @if($posts->hasPages())

                <div class="mt-8">
                    {{ $posts->links() }}
                </div>

            @endif

        </div>


        <!-- Sidebar -->
        <aside class="space-y-6">

            <!-- Categories -->
            <div class="rounded-2xl border border-white/10 bg-white/[0.035] p-6 shadow-xl shadow-black/10">

                <div class="flex items-center justify-between">

                    <h3 class="text-lg font-bold text-white">
                        Categories
                    </h3>

                    <span class="rounded-lg bg-purple-500/10 px-2.5 py-1 text-xs font-bold text-purple-300">
                        {{ $categories->count() }}
                    </span>

                </div>


                <div class="mt-5 space-y-2">

                    @forelse($categories as $category)

                        <a
                            href="{{ route('blog.index', ['category' => $category->slug]) }}"
                            class="group flex items-center justify-between rounded-xl px-3 py-3 transition hover:bg-white/5"
                        >

                            <span class="text-sm font-medium text-gray-400 transition group-hover:text-white">
                                {{ $category->name }}
                            </span>

                            <span class="rounded-lg bg-white/5 px-2 py-1 text-xs text-gray-500 transition group-hover:bg-purple-500/10 group-hover:text-purple-300">
                                {{ $category->posts_count }}
                            </span>

                        </a>

                    @empty

                        <p class="px-3 py-3 text-sm text-gray-500">
                            No categories yet.
                        </p>

                    @endforelse

                </div>

            </div>


            <!-- Popular Tags -->
            <div class="rounded-2xl border border-white/10 bg-white/[0.035] p-6 shadow-xl shadow-black/10">

                <h3 class="text-lg font-bold text-white">
                    Popular Tags
                </h3>

                <div class="mt-5 flex flex-wrap gap-2">

                    @forelse($tags as $tag)

                        <a
                            href="{{ route('blog.index', ['tag' => $tag->slug]) }}"
                            class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-medium text-gray-400 transition hover:border-cyan-500/30 hover:bg-cyan-500/10 hover:text-cyan-300"
                        >
                            #{{ $tag->name }}
                        </a>

                    @empty

                        <p class="text-sm text-gray-500">
                            No tags yet.
                        </p>

                    @endforelse

                </div>

            </div>


            <!-- About -->
            <div class="relative overflow-hidden rounded-2xl border border-purple-500/20 bg-gradient-to-br from-purple-600/15 to-cyan-500/5 p-6">

                <div class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full bg-purple-500/10 blur-2xl"></div>

                <div class="relative">

                    <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-cyan-400 text-sm font-black text-white">
                        &lt;/&gt;
                    </div>

                    <h3 class="text-lg font-bold text-white">
                        About DevBlog
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-gray-400">
                        A place to learn, experiment, build projects,
                        and share useful development knowledge.
                    </p>

                </div>

            </div>

        </aside>

    </div>

</x-layouts.blog>