@extends('layouts.master')

@section('title', $gallery->title1)

@section('content')
<div class="breadcumb-wrapper">
    <div class="container">
        <ul class="breadcumb-menu">
            <li><a href="/">হোম</a></li>
            <li>গ্যালারি বিবরণ</li>
        </ul>
    </div>
</div>
@php
    $categories = \App\Models\Category::latest()->get();
    $recentPosts = \App\Models\Article::latest()->where('status', 'published')->take(4)->get();
@endphp
@if(session('error'))
    <div class="bg-red-500 text-white p-2 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="bg-green-500 text-white p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <!-- Main Content Section -->
            <div class="col-xxl-9 col-lg-8">
                <div class="th-blog blog-single">
                    <h2 class="blog-title">{{ $gallery->title1 }}</h2>

                    <div class="blog-meta mb-4">
                        <a href="#">
                            <i class="fal fa-calendar-days"></i>
                            {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($gallery->created_at->format('d M, Y')) }}
                        </a>
                    </div>

                    <div class="row gy-4">
                        <!-- Main Gallery Image -->
                        @if($gallery->image1)
                            <div class="col-md-9  mb-3">
                                <div class="position-relative shadow rounded overflow-hidden">
                                    <img src="{{ asset('storage/'.$gallery->image1) }}" 
                                         alt="{{ $gallery->title1 }}" 
                                         class="img-fluid w-100" 
                                         style="aspect-ratio: 1/1; object-fit: cover;">
                                </div>
                                <h5 class="mt-2 text-center">{{ $gallery->title1 }}</h5>
                            </div>
                        @endif

                        <!-- Additional Gallery Images -->
                        @if($gallery->image2)
                            <div class="col-md-9  mb-3">
                                <div class="position-relative shadow rounded overflow-hidden">
                                    <img src="{{ asset('storage/'.$gallery->image2) }}" 
                                         alt="{{ $gallery->title2 }}" 
                                         class="img-fluid w-100" 
                                         style="aspect-ratio: 1/1; object-fit: cover;">
                                </div>
                                <h5 class="mt-2 text-center">{{ $gallery->title2 }}</h5>
                            </div>
                        @endif

                        @if($gallery->image3)
                            <div class="col-md-9 mb-3">
                                <div class="position-relative shadow rounded overflow-hidden">
                                    <img src="{{ asset('storage/'.$gallery->image3) }}" 
                                         alt="{{ $gallery->title3 }}" 
                                         class="img-fluid w-100" 
                                         style="aspect-ratio: 1/1; object-fit: cover;">
                                </div>
                                <h5 class="mt-2 text-center">{{ $gallery->title3 }}</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Section -->
            <div class="col-xxl-3 col-lg-4 sidebar-wrap">
                <aside class="sidebar-area">
                    <!-- Categories -->
                    <div class="widget widget_categories">
                        <h3 class="widget_title mt-1 pt-5">বিভাগ</h3>
                        <ul>
                            @foreach ($categories as $cat)
                                <li>
                                    <a href="{{ url('category/'.$cat->id) }}">{{ $cat->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Recent Posts -->
                    <div class="widget">
                        <h3 class="widget_title">সাম্প্রতিক পোস্ট</h3>
                        <div class="recent-post-wrap">
                            @foreach ($recentPosts as $recent)
                                <div class="recent-post d-flex align-items-center mb-3">
                                    <a href="{{ route('article.show', $recent->id) }}">
                                        <img src="{{ asset('storage/'.$recent->image) }}" 
                                             alt="{{ $recent->title }}" 
                                             class="rounded" 
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    </a>
                                    <div class="ml-3">
                                        <h4 class="post-title">
                                            <a href="{{ route('article.show', $recent->id) }}">
                                                {{ $recent->title }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection
