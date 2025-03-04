@extends('layouts.master')

@section('title', $article->title)

@section('content')
<div class="breadcumb-wrapper">
    <div class="container">
        <ul class="breadcumb-menu">
            <li><a href="/">Home</a></li>
            <li>Blog Details</li>
        </ul>
    </div>
</div>
@php
    $categories = \App\Models\Category::latest()->get();
    $recentPosts = \App\Models\Article::latest()->take(4)->get();
@endphp
<section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xxl-9 col-lg-8">
                <div class="th-blog blog-single">
                    <a data-theme-color="#4E4BD0" href="{{ url('category/'.$article->category->id) }}" class="category">{{ $article->category->name }}</a>
                    <h2 class="blog-title">{{ $article->title }}</h2>
                    <div class="blog-meta">
                        {{-- <a class="author" href="#"><i class="far fa-user"></i>By - {{ $article->name }}</a> --}}
                        <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                        {{-- <a href="#comments"><i class="far fa-comments"></i>Comments ({{ $article->comments_count }})</a> --}}
                        <span><i class="far fa-book-open"></i>5 Mins Read</span>
                    </div>
                    <div class="blog-img">
                        <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                    </div>
                    <div class="blog-content-wrap">
                        <div class="share-links-wrap">
                            <div class="share-links">
                                <span class="share-links-title">Share Post:</span>
                                <div class="multi-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
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

                {{-- <div class="th-comments-wrap" id="comments">
                    <h2 class="blog-inner-title h3">Comments ({{ $article->comments_count }})</h2>
                    <ul class="comment-list">
                        @foreach ($article->comments as $comment)
                            <li class="th-comment-item">
                                <div class="th-post-comment">
                                    <div class="comment-content">
                                        <span class="commented-on"><i class="fas fa-calendar-alt"></i>{{ $comment->created_at->format('d M, Y') }}</span>
                                        <h3 class="name">{{ $comment->user ? $comment->user->name : $comment->guest_name }}</h3>
                                        <p class="text">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div> --}}

                {{-- <div class="th-comment-form">
                    <h3 class="blog-inner-title mb-2">Leave a Comment</h3>
                    <form action="{{ route('article.comment.store', $article->id) }}" method="POST">
                        @csrf
                        @guest
                            <input type="text" name="guest_name" placeholder="Your Name*" required>
                            <input type="email" name="guest_email" placeholder="Your Email*" required>
                        @endguest
                        <textarea name="comment" placeholder="Write a Comment*" required></textarea>
                        <button class="th-btn">Post Comment</button>
                    </form>
                </div> --}}
            </div>
            <div class="col-xxl-3 col-lg-4 sidebar-wrap">
                <aside class="sidebar-area">
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
                                    <a href="{{ route('article.show', $recent->id) }}">
                                        <img src="{{ asset('storage/'.$recent->image) }}" alt="{{ $recent->title }}">
                                    </a>
                                    <h4 class="post-title">
                                        <a href="{{ route('article.show', $recent->id) }}">{{ $recent->title }}</a>
                                    </h4>
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
