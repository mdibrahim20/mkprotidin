@extends('layouts.master')

@section('title', $article->title)
@section('og_title', $article->title)
@section('og_description', Str::limit(strip_tags($article->content), 150))
@section('og_image', asset('storage/' . $article->image))

@section('twitter_title', $article->title)
@section('twitter_description', Str::limit(strip_tags($article->content), 150))
@section('twitter_image', asset('storage/' . $article->image))

@section('content')
<div class="breadcumb-wrapper">
    <div class="container">
        <ul class="breadcumb-menu">
            <li><a href="/">হোম</a></li>
            <li>ব্লগের বিবরণ</li>
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
            <div class="col-xxl-9 col-lg-8">
                <div class="th-blog blog-single">
                    <a href="{{ url('category/'.$article->category->id) }}" class="category">{{ $article->category->name }}</a>
                    <h2 class="blog-title">{{ $article->title }}</h2>
                    <div class="blog-meta">
<a href="#">
    <i class="fal fa-calendar-days"></i>
    {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
</a>

                        <span>পড়া হয়েছে: {{ \App\Helpers\BanglaDateHelper::convertToBanglaDigit($article->views) }}</span>
                        {{-- <button id="printButton" class="no-print bg-blue-500 text-white px-4 py-2 rounded mt-4">
                            Print Article
                        </button> --}}
                    </div>
                    <div class="blog-img">
                        <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                    </div>
                    <div class="blog-content-wrap">
                        <div class="share-links-wrap">
                                <div class="share-links">
    <span class="share-links-title">পোস্টটি শেয়ার করুন:</span>
    <div class="multi-social">
        <!-- Facebook Share -->
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank">
            <i class="fab fa-facebook-f"></i>
        </a>
        
        <!-- Twitter Share -->
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
        
        <!-- LinkedIn Share -->
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank">
            <i class="fab fa-linkedin-in"></i>
        </a>
    
    </div>
</div>

                            </div>
                        <div class="blog-content">
                            <div class="content">
                                <p>{!! nl2br(e($article->content)) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-xxl-3 col-lg-4 sidebar-wrap">
                <aside class="sidebar-area">
                    <div class="widget widget_categories">
                        <h3 class="widget_title mt-1 pt-5">বিভাগ</h3>
                        <ul>
                            @foreach ($categories as $cat)
                                <li><a href="{{ url('category/'.$cat->id) }}">{{ $cat->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <h3 class="widget_title">Recent Posts</h3>
                        <div class="recent-post-wrap">
                            @foreach ($recentPosts as $recent)
                                <div class="recent-post">
                                    <a href="{{ route('article.show', $recent->id) }}">
                                        <img src="{{ asset('storage/'.$recent->image) }}" alt="{{ $recent->title }}" style="width: 150px; height: 80px; object-fit: cover;">

                                    </a>
                                    <h4 class="post-title ml-5"><a href="{{ route('article.show', $recent->id) }}">{{ $recent->title }}</a></h4>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const printButton = document.getElementById("printButton");

        if (printButton) {
            console.log("Print Button Found! ✅");
            printButton.addEventListener("click", openPrintView);
        } else {
            console.error("Print Button Not Found! ❌");
        }

        // Override Ctrl + P
        document.addEventListener("keydown", function(event) {
            if (event.ctrlKey && event.key === "p") {
                event.preventDefault();
                openPrintView();
            }
        });
    });

    function openPrintView() {
    console.log("Opening Print View... 🖨️");

    // Open a new window
    const printWindow = window.open('', '_blank');
    
    // Check if the window opened successfully
    if (!printWindow || printWindow.closed || typeof printWindow.closed === 'undefined') {
        console.error("Pop-up Blocked! ❌");
        alert("Pop-up blocked! Please allow pop-ups for this site.");
        return;
    }

    printWindow.document.write(`
        <html>
        <head>
            <title>Print Article</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    background: #fff;
                    color: #000;
                }
                .print-header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .print-header h1 {
                    font-size: 24px;
                    margin-bottom: 10px;
                }
                .print-header p {
                    font-size: 14px;
                    color: #666;
                }
                .article-image {
                    max-width: 100%;
                    height: auto;
                    margin: 10px 0;
                }
                .article-content {
                    font-size: 18px;
                    line-height: 1.6;
                    text-align: justify;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                    font-size: 14px;
                    color: #777;
                }
            </style>
        </head>
        <body>
            <div class="print-header">
                <h1>{{ $article->title }}</h1>
                <p>Published on {{ $article->created_at->format('d M, Y') }} | Category: {{ $article->category->name }}</p>
            </div>
            <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" class="article-image">
            <div class="article-content">
                <p>{!! nl2br(e($article->content)) !!}</p>
            </div>
            <div class="footer">
                <p>Generated by News Portal - {{ now()->format('d M, Y') }}</p>
            </div>
            <script>
                console.log("Triggering Print... 🖨️");
                window.onload = function() {
                    window.print();
                    window.onafterprint = function() {
                        window.close();
                    }
                }
            </script>
        </body>
        </html>
    `);

    printWindow.document.close();
}

</script>
@endsection

@endsection
