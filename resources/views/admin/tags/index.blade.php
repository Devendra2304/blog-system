<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-400">
                    Admin Panel
                </p>

                <h2 class="mt-1 text-2xl font-black tracking-tight text-white">
                    {{ __('Manage Tags') }}
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Organize your articles with searchable tags.
                </p>
            </div>

            <a
                href="{{ route('admin.posts.index') }}"
                class="inline-flex w-fit items-center rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-gray-300 transition hover:border-purple-500/30 hover:bg-purple-500/10 hover:text-white"
            >
                &larr; Back to Posts
            </a>

        </div>
    </x-slot>

    <div class="relative py-10 sm:py-12">

        <!-- Background glow -->
        <div class="pointer-events-none absolute left-1/4 top-0 h-72 w-72 rounded-full bg-purple-600/10 blur-3xl"></div>
        <div class="pointer-events-none absolute right-1/4 top-1/3 h-72 w-72 rounded-full bg-cyan-500/5 blur-3xl"></div>

        <div class="relative mx-auto max-w-4xl space-y-6 px-4 sm:px-6 lg:px-8">

            <!-- Add Tag -->
            <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

                <div class="border-b border-white/10 bg-white/[0.02] px-6 py-5 sm:px-8">
                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-purple-500 shadow-lg shadow-cyan-500/10">
                            <span class="text-lg font-black text-white">
                                #
                            </span>
                        </div>

                        <div>
                            <h3 class="font-bold text-white">
                                Add Tag
                            </h3>

                            <p class="text-sm text-gray-500">
                                Create a new tag for your articles.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="p-6 sm:p-8">

                    <form
                        action="{{ route('admin.tags.store') }}"
                        method="POST"
                        class="flex flex-col gap-3 sm:flex-row"
                    >
                        @csrf

                        <input
                            type="text"
                            name="name"
                            placeholder="New tag name..."
                            required
                            class="min-w-0 flex-1 rounded-xl border border-white/10 bg-[#080b12] px-4 py-3 text-sm text-white placeholder-gray-600 shadow-sm outline-none transition focus:border-cyan-500/50 focus:ring-2 focus:ring-cyan-500/10"
                        >

                        <button
                            type="submit"
                            class="rounded-xl bg-gradient-to-r from-cyan-600 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-600/20 transition hover:from-cyan-500 hover:to-purple-500"
                        >
                            Add Tag
                        </button>

                    </form>

                </div>
            </div>

            <!-- Tags List -->
            <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

                <div class="border-b border-white/10 bg-white/[0.02] px-6 py-5 sm:px-8">
                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="font-bold text-white">
                                Tags
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Manage the tags used by your posts.
                            </p>
                        </div>

                        <div class="hidden h-9 w-9 items-center justify-center rounded-lg bg-cyan-500/10 text-sm font-bold text-cyan-400 sm:flex">
                            #
                        </div>

                    </div>
                </div>

                <div class="px-6 sm:px-8">

                    <ul class="divide-y divide-white/10">

                        @forelse($tags as $tag)

                            <li class="flex items-center justify-between gap-4 py-5">

                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-gray-200">
                                        #{{ $tag->name }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $tag->posts_count }}
                                        {{ $tag->posts_count == 1 ? 'post' : 'posts' }}
                                    </p>
                                </div>

                                <form
                                    action="{{ route('admin.tags.destroy', $tag) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-lg border border-red-500/20 bg-red-500/10 px-3 py-2 text-xs font-semibold text-red-400 transition hover:border-red-500/30 hover:bg-red-500/20 hover:text-red-300"
                                    >
                                        Delete
                                    </button>
                                </form>

                            </li>

                        @empty

                            <li class="py-12 text-center">

                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-white/5 text-gray-600">
                                    #
                                </div>

                                <p class="mt-4 font-semibold text-gray-400">
                                    No tags created yet.
                                </p>

                                <p class="mt-1 text-sm text-gray-600">
                                    Add your first tag above.
                                </p>

                            </li>

                        @endforelse

                    </ul>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>