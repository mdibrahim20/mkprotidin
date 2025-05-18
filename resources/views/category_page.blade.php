@extends('layouts.master')

@section('title', $category->name . ' - সংবাদ')

@section('content')

<div class="breadcumb-wrapper">
    <div class="container">
        <ul class="breadcumb-menu">
            <li><a href="/">Home</a></li>
            <li>{{ $category->name }}</li>
        </ul>
    </div>
</div>
@php
    $categories = \App\Models\Category::latest()->get();
    $recentPosts = \App\Models\Article::latest()->where('status', 'published')->take(4)->get();
@endphp
<section class="th-blog-wrapper space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xxl-9 col-lg-8">
                @if ($articles->count() > 0)
                    @foreach ($articles as $article)
                        <div class="th-blog blog-single has-post-thumbnail">
                            <div class="blog-img">
                                <a href="{{ route('article.show', $article->id) }}">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                </a>
                                <a data-theme-color="#4E4BD0" href="{{ url('category/'.$category->id) }}" class="category">{{ $category->name }}</a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    {{-- <a class="author" href="#"><i class="far fa-user"></i>By - {{ $article->name }}</a> --}}
                                    <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                                    {{-- <a href="{{ route('article.show', $article->id) }}"><i class="far fa-comments"></i>Comments ({{ $article->comments_count }})</a> --}}
                                </div>
                                <h2 class="blog-title box-title-30">
                                    <a href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a>
                                </h2>
                                <p class="blog-text">{{ Str::limit($article->content, 200) }}</p>
                                <a href="{{ route('article.show', $article->id) }}" class="th-btn style2">Read More<i class="fas fa-arrow-up-right ms-2"></i></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 mt-2">এই ক্যাটাগরিতে কোনো সংবাদ নেই</p>
                @endif

                <div class="th-pagination mt-4">
                    {{ $articles->links() }}
                </div>
            </div>
            <div class="col-xxl-3 col-lg-4 sidebar-wrap">
                <aside class="sidebar-area">
                    <div class="widget widget_search">
                        <form class="search-form" action="" method="GET">
                            <input type="text" name="query" placeholder="Enter Keyword">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                    <div class="widget widget_categories">
                        <h3 class="widget_title">Categories</h3>
                        <ul>
                            @foreach ($categories as $cat)
                                <li>
                                    <a href="{{ url('category/'.$cat->id) }}">{{ $cat->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <h3 class="widget_title">Recent Posts</h3>
                        <div class="recent-post-wrap">
                            @foreach ($recentPosts as $recent)
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="{{ route('article.show', $recent->id) }}">
                                            <img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title">
                                            <a class="hover-line" href="{{ route('article.show', $recent->id) }}">{{ $recent->title }}</a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            <a href="#"><i class="fal fa-calendar-days"></i>{{ $recent->created_at->format('d M, Y') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget-ads">
                            <a href="#">
                                <img class="w-100" src="{{ asset('ads/sidebar_ads.jpg') }}" alt="ads">
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection
