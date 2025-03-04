@extends('layouts.master')

@section('title', 'Search Results')

@section('content')
<div class="container mt-5">
    <h2 class="text-2xl font-bold">Search Results for: "{{ $query }}"</h2>

    @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach ($articles as $article)
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <a href="{{ route('article.show', $article->id) }}">
                        <img src="{{ asset('uploads/'.$article->image) }}" class="w-full h-40 object-cover rounded" alt="{{ $article->title }}">
                    </a>
                    <h3 class="text-lg font-semibold mt-2">
                        <a href="{{ route('article.show', $article->id) }}" class="hover:text-blue-500">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Published: {{ $article->created_at->format('d M Y') }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    @else
        <p class="text-gray-500 mt-4">No articles found matching your search.</p>
    @endif
</div>
@endsection
