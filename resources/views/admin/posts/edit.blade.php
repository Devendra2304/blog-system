<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="min-w-0">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-400">
                    Admin Panel
                </p>

                <h2 class="mt-1 truncate text-2xl font-black tracking-tight text-white">
                    {{ __('Edit Post') }}
                </h2>

                <p class="mt-1 truncate text-sm text-gray-500">
                    {{ $post->title }}
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

        <div class="relative mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

                <!-- Form Header -->
                <div class="border-b border-white/10 bg-white/[0.02] px-6 py-6 sm:px-8">
                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-purple-500 shadow-lg shadow-cyan-500/10">
                            <span class="text-lg font-black text-white">
                                ✎
                            </span>
                        </div>

                        <div>
                            <h3 class="font-bold text-white">
                                Edit Post
                            </h3>

                            <p class="text-sm text-gray-500">
                                Update your article details and publish changes.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="px-6 py-8 sm:px-8">

                    @if ($errors->any())
                        <div class="mb-7 rounded-2xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">

                            <div class="mb-2 flex items-center gap-2 font-semibold">
                                <span>⚠</span>
                                Please fix the following errors:
                            </div>

                            <ul class="list-disc space-y-1 pl-6 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-6">
                            <label
                                for="title"
                                class="mb-2 block text-sm font-semibold text-gray-200"
                            >
                                Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title', $post->title) }}"
                                required
                                class="block w-full rounded-xl border border-white/10 bg-[#080b12] px-4 py-3 text-sm text-white placeholder-gray-600 shadow-sm outline-none transition focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/10"
                            >
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <label
                                for="category_id"
                                class="mb-2 block text-sm font-semibold text-gray-200"
                            >
                                Category
                            </label>

                            <select
                                name="category_id"
                                id="category_id"
                                class="block w-full rounded-xl border border-white/10 bg-[#080b12] px-4 py-3 text-sm text-gray-300 shadow-sm outline-none transition focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/10"
                            >
                                <option value="">-- Select Category --</option>

                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tags -->
                        <div class="mb-6">
                            <label
                                for="tags"
                                class="mb-2 block text-sm font-semibold text-gray-200"
                            >
                                Tags
                            </label>

                            <select
                                name="tags[]"
                                id="tags"
                                multiple
                                class="block h-32 w-full rounded-xl border border-white/10 bg-[#080b12] px-4 py-3 text-sm text-gray-300 shadow-sm outline-none transition focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/10"
                            >
                                @foreach($tags as $tag)
                                    <option
                                        value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}
                                    >
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="mt-2 text-xs text-gray-500">
                                Hold Ctrl (or Cmd on Mac) to select multiple tags.
                            </p>
                        </div>

                        <!-- Summary -->
                        <div class="mb-6">
                            <label
                                for="summary"
                                class="mb-2 block text-sm font-semibold text-gray-200"
                            >
                                Summary / Excerpt
                            </label>

                            <textarea
                                name="summary"
                                id="summary"
                                rows="3"
                                class="block w-full resize-y rounded-xl border border-white/10 bg-[#080b12] px-4 py-3 text-sm leading-6 text-white placeholder-gray-600 shadow-sm outline-none transition focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/10"
                            >{{ old('summary', $post->summary) }}</textarea>
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <div class="mb-2 flex items-center justify-between">

                                <label
                                    for="content"
                                    class="block text-sm font-semibold text-gray-200"
                                >
                                    Content
                                </label>

                                <span class="text-xs text-gray-600">
                                    Markdown / Text
                                </span>

                            </div>

                            <textarea
                                name="content"
                                id="content"
                                rows="14"
                                required
                                class="block w-full resize-y rounded-xl border border-white/10 bg-[#080b12] px-4 py-3 text-sm leading-7 text-white placeholder-gray-600 shadow-sm outline-none transition focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/10"
                            >{{ old('content', $post->content) }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-8">
                            <label
                                for="status"
                                class="mb-2 block text-sm font-semibold text-gray-200"
                            >
                                Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="block w-full rounded-xl border border-white/10 bg-[#080b12] px-4 py-3 text-sm text-gray-300 shadow-sm outline-none transition focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/10"
                            >
                                <option
                                    value="published"
                                    {{ old('status', $post->status) == 'published' ? 'selected' : '' }}
                                >
                                    Published
                                </option>

                                <option
                                    value="draft"
                                    {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}
                                >
                                    Draft
                                </option>
                            </select>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-6 sm:flex-row sm:items-center sm:justify-end">

                            <a
                                href="{{ route('admin.posts.index') }}"
                                class="inline-flex justify-center rounded-xl border border-white/10 bg-white/5 px-5 py-2.5 text-sm font-semibold text-gray-300 transition hover:border-white/20 hover:bg-white/10 hover:text-white"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="inline-flex cursor-pointer justify-center rounded-xl bg-gradient-to-r from-cyan-600 to-purple-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-purple-600/20 transition hover:from-cyan-500 hover:to-purple-500"
                            >
                                Update Post
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>