<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-purple-400">
                    Admin Panel
                </p>

                <h2 class="mt-1 text-2xl font-black tracking-tight text-white">
                    {{ __('Manage Blog Posts') }}
                </h2>
            </div>


            <div class="flex flex-wrap items-center gap-2">

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm font-medium text-gray-300 transition hover:border-purple-500/30 hover:bg-purple-500/10 hover:text-white"
                >
                    Categories
                </a>

                <a
                    href="{{ route('admin.tags.index') }}"
                    class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm font-medium text-gray-300 transition hover:border-cyan-500/30 hover:bg-cyan-500/10 hover:text-white"
                >
                    Tags
                </a>

                <a
                    href="{{ route('admin.posts.create') }}"
                    class="rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 px-4 py-2 text-sm font-bold text-white shadow-lg shadow-purple-600/20 transition hover:from-purple-500 hover:to-indigo-500"
                >
                    + New Post
                </a>

            </div>

        </div>

    </x-slot>


    <div class="min-h-screen bg-[#080b12] py-10">

        <div class="mx-auto max-w-7xl px-5 lg:px-8">


            <!-- Success Message -->
            @if(session('success'))

                <div class="mb-6 flex items-center gap-3 rounded-2xl border border-green-500/20 bg-green-500/10 px-5 py-4 text-sm text-green-300">

                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-500/10">
                        ✓
                    </div>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            <!-- Stats -->
            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

                <div class="rounded-2xl border border-white/10 bg-white/[0.035] p-5">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Total Posts
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ $posts->total() }}
                    </p>
                </div>


                <div class="rounded-2xl border border-purple-500/20 bg-purple-500/[0.05] p-5">
                    <p class="text-xs font-semibold uppercase tracking-wider text-purple-400">
                        Current Page
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ $posts->currentPage() }}
                    </p>
                </div>


                <div class="rounded-2xl border border-cyan-500/20 bg-cyan-500/[0.05] p-5">
                    <p class="text-xs font-semibold uppercase tracking-wider text-cyan-400">
                        Per Page
                    </p>

                    <p class="mt-2 text-3xl font-black text-white">
                        {{ $posts->perPage() }}
                    </p>
                </div>

            </div>


            <!-- Posts Table -->
            <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/[0.035] shadow-2xl shadow-black/20">

                <!-- Table Header -->
                <div class="flex flex-col gap-2 border-b border-white/10 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-lg font-bold text-white">
                            All Blog Posts
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Create, edit, and manage your articles.
                        </p>
                    </div>

                    <a
                        href="{{ route('blog.index') }}"
                        class="text-sm font-semibold text-purple-400 transition hover:text-cyan-400"
                    >
                        View Blog →
                    </a>

                </div>


                <!-- Responsive Table -->
                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="border-b border-white/10 bg-white/[0.025]">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Title
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Category
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Date
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-white/5">

                            @forelse($posts as $post)

                                <tr class="group transition hover:bg-white/[0.025]">


                                    <!-- Title -->
                                    <td class="px-6 py-5">

                                        <div class="max-w-md">

                                            <a
                                                href="{{ route('admin.posts.edit', $post) }}"
                                                class="font-semibold text-gray-200 transition hover:text-purple-400"
                                            >
                                                {{ $post->title }}
                                            </a>

                                        </div>

                                    </td>


                                    <!-- Category -->
                                    <td class="px-6 py-5">

                                        @if($post->category)

                                            <span class="rounded-lg border border-purple-500/20 bg-purple-500/10 px-2.5 py-1 text-xs font-medium text-purple-300">
                                                {{ $post->category->name }}
                                            </span>

                                        @else

                                            <span class="text-sm text-gray-600">
                                                Uncategorized
                                            </span>

                                        @endif

                                    </td>


                                    <!-- Status -->
                                    <td class="px-6 py-5">

                                        <span
                                            class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold
                                            {{ $post->status === 'published'
                                                ? 'border border-green-500/20 bg-green-500/10 text-green-300'
                                                : 'border border-yellow-500/20 bg-yellow-500/10 text-yellow-300'
                                            }}"
                                        >

                                            <span
                                                class="h-1.5 w-1.5 rounded-full
                                                {{ $post->status === 'published'
                                                    ? 'bg-green-400'
                                                    : 'bg-yellow-400'
                                                }}"
                                            ></span>

                                            {{ ucfirst($post->status) }}

                                        </span>

                                    </td>


                                    <!-- Date -->
                                    <td class="px-6 py-5 text-sm text-gray-500">

                                        {{ $post->created_at->format('M d, Y') }}

                                    </td>


                                    <!-- Actions -->
                                    <td class="px-6 py-5 text-right">

                                        <div class="flex items-center justify-end gap-3">

                                            <a
                                                href="{{ route('admin.posts.edit', $post) }}"
                                                class="text-sm font-semibold text-purple-400 transition hover:text-purple-300"
                                            >
                                                Edit
                                            </a>


                                            <form
                                                action="{{ route('admin.posts.destroy', $post) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Delete this post?')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-sm font-semibold text-red-400 transition hover:text-red-300"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="px-6 py-16 text-center"
                                    >

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-500/10 text-2xl">
                                            📝
                                        </div>

                                        <h3 class="mt-5 text-lg font-bold text-white">
                                            No posts yet
                                        </h3>

                                        <p class="mt-2 text-sm text-gray-500">
                                            Create your first article to get started.
                                        </p>

                                        <a
                                            href="{{ route('admin.posts.create') }}"
                                            class="mt-5 inline-flex rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-purple-600/20 transition hover:from-purple-500 hover:to-indigo-500"
                                        >
                                            + Create First Post
                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <!-- Pagination -->
                @if($posts->hasPages())

                    <div class="border-t border-white/10 px-6 py-5">

                        {{ $posts->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>