@extends('layouts.master')

@section('title', 'Article Archive')

@section('content')
<div class="breadcumb-wrapper">
    <div class="container">
        <ul class="breadcumb-menu">
            <li><a href="/">Home</a></li>
            <li>Article Archive</li>
        </ul>
    </div>
</div>

<section class="space-top space-extra-bottom">
    <div class="container">
        <h2 class="text-3xl font-semibold text-center mb-6">Article Archive</h2>

        <!-- Filter Form -->
        <form action="{{ route('article.archive') }}" method="GET" class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Category Filter -->
                <div>
                    <label class="block text-lg font-semibold mb-2">Filter by Category</label>
                    <select name="category_id" class="w-full p-2 border rounded">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date Filter -->
                <div>
                    <label class="block text-lg font-semibold mb-2">Filter by Date</label>
                    <input type="date" name="date" class="w-full p-2 border rounded" value="{{ request('date') }}">
                </div>

                <!-- Submit Button -->
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Apply Filters</button>
                </div>
            </div>
        </form>

        <!-- Article List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($articles as $article)
                <div class="border rounded-lg p-4 shadow-md">
                    <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" class="w-full h-40 object-cover rounded">
                    <h3 class="text-xl font-semibold mt-4">
                        <a href="{{ route('article.show', $article->id) }}" class="hover:underline">{{ $article->title }}</a>
                    </h3>
                    <p class="text-sm text-gray-500">Published on {{ $article->created_at->format('d M, Y') }}</p>
                    <p class="text-sm text-gray-700">{{ Str::limit($article->content, 100) }}</p>
                    <a href="{{ route('article.show', $article->id) }}" class="text-blue-500 hover:underline">Read More</a>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">No articles found for the selected filters.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    </div>
</section>
@endsection
