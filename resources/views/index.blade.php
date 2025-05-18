@extends('layouts.master')

@section('title', 'News Portal - Home')

@section('content')

@include('partials.news_ticker')
<script>
    function updateGallery(imageUrl, title) {
        document.getElementById('large-gallery-image').src = imageUrl;
        document.getElementById('large-gallery-title').innerText = title;
    }
</script>
<section class="space">
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <div class="row gy-4">
                    <!--@php-->
                    <!--    $sideArticles = \App\Models\Article::latest()->where('status', 'published')->take(4)->latest()->get();-->
                    <!--    $test = \App\Models\Article::latest()->where('status', 'published')->take(2)->latest()->get();-->
                    <!--    $banner = \App\Models\Ads::latest()->first();-->
                    <!--    $gallery = \App\Models\Gallery::latest()->first();-->
                    <!--    $galleryList = \App\Models\Gallery::latest()->take(5)->get();-->
                    <!--    // @dd($gallery)-->
                    <!--    use Illuminate\Support\Str;-->
                    <!--@endphp-->
@php
    use Illuminate\Support\Str;
    
    // Fetch sidebar articles
    $sideArticles = \App\Models\Article::latest()->where('status', 'published')->take(3)->get();
    
    // Get IDs of side articles to exclude from the main section
    $excludedIds = $sideArticles->pluck('id')->toArray();

    // Fetch the main latest article, excluding side articles
    $mainArticle = \App\Models\Article::where('status', 'published')
                    ->whereNotIn('id', $excludedIds)
                    ->latest()
                    ->first();

    // Add main article ID to excluded list
    if ($mainArticle) {
        $excludedIds[] = $mainArticle->id;
    }

    // Fetch next latest articles for the main part, excluding already displayed ones
    $latestArticles = \App\Models\Article::where('status', 'published')
                        ->whereNotIn('id', $excludedIds)
                        ->latest()
                        ->take(4)
                        ->get();

    // Ads and Gallery
    $banner = \App\Models\Ads::latest()->first();
    $gallery = \App\Models\Gallery::latest()->first();
    $galleryList = \App\Models\Gallery::latest()->take(5)->get();
@endphp
                    <div class="row gy-4">
    @foreach ($sideArticles as $article)
        <div class="col-xl-12 col-sm-6 border-blog dark-theme img-overlay2">
            <div class="blog-style3">
                <div class="blog">
                    <h5 style="font-size:16px; color:#000">
                        <a class="hover-line" href="{{ url('article/'.$article->id) }}">
                            {{ $article->title }}
                        </a>
                    </h5>
                    <span>{{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}</span>
                    <p class="mt-2">{{ Str::limit($article->content, 100, '...') }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
                </div>
            </div>
<div class="col-xl-6 mt-4 mt-xl-0">
    @if ($mainArticle)
        <div class="dark-theme img-overlay2">
            <div class="blog-style3">
                <div class="blog">
                    <img src="{{ asset('storage/'.$mainArticle->image) }}" alt="{{ $mainArticle->title }}">
                    <h3 class="mt-3 text-dark">
                        <a class="hover-line" href="{{ url('article/'.$mainArticle->id) }}">
                            {{ $mainArticle->title }}
                        </a>
                    </h3>
                </div>
            </div>
        </div>
        <hr>
    @endif

    <div class="row">
        @foreach ($latestArticles->chunk(2) as $chunk)
            <div class="col-xl-6 col-sm-6 border-blog dark-theme img-overlay2">
                @foreach ($chunk as $article)
                    <div class="blog-style3 mt-2 mb-2">
                        <div class="blog">
                            <h5 style="font-size:16px; color:#000">
                                <a class="hover-line" href="{{ url('article/'.$article->id) }}">
                                    {{ $article->title }}
                                </a>
                            </h5>
                            <span>{{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}</span>
                            <p class="mt-2">{{ Str::limit($article->content, 100, '...') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
            <div class="col-xl-3 mt-35 mt-xl-0">
                <div class="nav tab-menu indicator-active" role="tablist">
                    <button class="tab-btn active" id="nav-one-tab" data-bs-toggle="tab" data-bs-target="#nav-one" type="button" role="tab" aria-controls="nav-one" aria-selected="true">শীর্ষ খবর</button>
                    <button class="tab-btn" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two" type="button" role="tab" aria-controls="nav-two" aria-selected="false">সাম্প্রতিক খবর</button>
                </div>
                @php
                                    $categoryColors = [
                    'জাতীয়' => '#00D084',  // Green
                    'আন্তর্জাতিক' => '#4E4BD0',  // Blue
                    'রাজনীতি' => '#FF9500',  // Orange
                    'অর্থনীতি' => '#FF5E5E',  // Red
                    'খেলাধুলা' => '#4A90E2',  // Blue
                    'বিনোদন' => '#FF4081',  // Pink
                    'শিক্ষা' => '#34C759',  // Green
                    'প্রযুক্তি' => '#FFD700',  // Gold
                    'স্বাস্থ্য' => '#A569BD',  // Purple
                    'জীবনযাপন' => '#2E86C1',  // Sky Blue
                    'ধর্ম' => '#E67E22',  // Dark Orange
                    'পর্যটন' => '#16A085',  // Teal
                    'আইন ও বিচার' => '#E74C3C',  // Bright Red
                    'কৃষি' => '#27AE60',  // Dark Green
                    'বিজ্ঞান' => '#3498DB',  // Light Blue
                    'মতামত' => '#8E44AD',  // Deep Purple
                    'বিশেষ প্রতিবেদন' => '#C0392B',  // Dark Red
                    'দুর্ঘটনা' => '#D35400',  // Rust Orange
                    'নগর জীবন' => '#7F8C8D',  // Gray
                    'গ্রামবাংলা' => '#1ABC9C',  // Sea Green
                ];


                    
                @endphp
                <div class="tab-content">
                    <!-- First Tab (Latest 4 Articles) -->
                    <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                        <div class="row gy-4">
                            @php
                                $topNews = \App\Models\Article::latest()->where('status', 'published')->take(4)->get();
                            @endphp
                            @foreach ($topNews as $article)
                                @php
                                    // Assign color based on category, default to gray if not found
                                    $categoryColor = $categoryColors[$article->category->name] ?? '#999999';
                                @endphp
                                <div class="col-xl-12 col-md-6 border-blog">
                                    <div class="blog-style2">
                                        <div class="blog-img">
                                            <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                                        </div>
                                        <div class="blog-content">
                                            <a data-theme-color="{{ $categoryColor }}" href="{{ url('category/'.$article->category->id) }}" class="category" >
                                                <!--{{ $article->category->name }}-->
                                            </a>
                                            <h3 class="box-title-18"><a style="font-size: 14px !important;" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                            <div class="blog-meta">
                                                <a href="#">
                                                    <i class="fal fa-calendar-days"></i>
                                                    {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                
                    <!-- Second Tab (Next 4 Latest Articles, excluding the first 4) -->
                    <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                        <div class="row gy-4">
                            @php
                                $recentNews = \App\Models\Article::latest()->where('status', 'published')->skip(4)->take(4)->get();
                            @endphp
                            @foreach ($recentNews as $article)
                                @php
                                    $categoryColor = $categoryColors[$article->category->name] ?? '#999999';
                                @endphp
                                <div class="col-xl-12 col-md-6 border-blog">
                                    <div class="blog-style2">
                                        <div class="blog-img">
                                            <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                                        </div>
                                        <div class="blog-content">
                                            <a style="font-size: 14px !important;" data-theme-color="{{ $categoryColor }}" href="{{ url('category/'.$article->category->id) }}" class="category" >
                                                <!--{{ $article->category->name }}-->
                                            </a>
                                            <h3 class="box-title-18"><a class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                            <div class="blog-meta">
                                               <a href="#">
    <i class="fal fa-calendar-days"></i>
    {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
               <div class="mt-4">
<div class="mt-4">
    <div class="card shadow border-0" style="background-image: url('https://scontent.fdac24-3.fna.fbcdn.net/v/t39.30808-6/434270982_810439877777233_8799405576187122660_n.jpg?stp=dst-jpg_s960x960_tt6&_nc_cat=106&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=nxSaFX27AF4Q7kNvgFbV1zE&_nc_oc=AdjQgiyfUQBUjZcAgYF1TYYDUSWhqeSEAWKAsuQqbP7_IxrQADPS7UNzKW23i_MclZ0&_nc_zt=23&_nc_ht=scontent.fdac24-3.fna&_nc_gid=22u8aisA2iAXs8aGyvR46Q&oh=00_AYExe6Uh3J9HklfG7kwGdRNSJdYADdpl6qH32rIRxHsVmQ&oe=67DA3706'); background-size: cover; background-position: center; height: 250px; position: relative; color: #fff;">
        <div class="card-body d-flex flex-column justify-content-end" 
             style="background: rgba(0, 0, 0, 0.4); height: 100%; position: relative;">

            <!-- Shadow Effect -->
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 50px; background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0)); border-top-left-radius: 6px; border-top-right-radius: 6px;"></div>

            <!-- Logo and Title -->
            <div class="d-flex align-items-center mb-5">
                <img src="https://scontent.fdac24-5.fna.fbcdn.net/v/t39.30808-1/474613614_1016257907195428_961256506974870478_n.jpg?stp=c29.29.406.406a_dst-jpg_s200x200_tt6&_nc_cat=103&ccb=1-7&_nc_sid=2d3e12&_nc_ohc=gofRuUbaMzAQ7kNvgEB7M6e&_nc_oc=AdgIZCDatWNvsRknxy0NXwxNNEjECTlAnCJ358OmrJNYl6JbMeVDfKHGE-OnLkIOqk8&_nc_zt=24&_nc_ht=scontent.fdac24-5.fna&_nc_gid=22u8aisA2iAXs8aGyvR46Q&oh=00_AYGQtbTiX3ZWgl9DVWlPQyORNJsFu9yyJZMfDAXQMR8_Vg&oe=67DA2FC8" 
                     alt="Facebook Logo" 
                     class="rounded-circle shadow" 
                     style="width: 50px; height: 50px; border: 3px solid #fff;">

                <h5 class="ms-3 mb-0 text-white d-block">MKprotidin</h5>
            </div>
<span style="position:absolute;bottom: 90px;left: 83px;">
                    <a href="https://www.facebook.com/mkprotidin/followers/" target="_blank" class="text-white">
                    10K Followers
                </a>
                </span>
            <!-- Likes -->
           <a href="https://www.facebook.com/mkprotidin/" target="_blank" class="btn w-50 bg-white">
                <i class="fab fa-facebook-f text-primary"></i> Like Page
            </a>

            <!-- Like Page Button -->
            

        </div>
    </div>
</div>


                </div>
                
                
                
                
                </div>
                </div>
</section>
<div class="">
    <div class="container">
        <!-- Section Header -->
        <div class="row align-items-center">
            <div class="col">
                <h2 class="sec-title has-line">ট্রেন্ডিং নিউজ</h2>
            </div>
            <div class="col-auto">
                <div class="sec-btn">
                    <div class="icon-box">
                        <button data-slick-prev="#blog-slide1" class="slick-arrow default">
                            <i class="far fa-arrow-left"></i>
                        </button>
                        <button data-slick-next="#blog-slide1" class="slick-arrow default">
                            <i class="far fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trending News Carousel -->
        <div class="row th-carousel" id="blog-slide1" 
             data-slide-show="4" data-lg-slide-show="3" 
             data-md-slide-show="2" data-sm-slide-show="2">

            @php
                $trendingNews = \App\Models\Article::latest()
                    ->where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
            @endphp

            @foreach ($trendingNews as $article)
                <div class="col-sm-6 col-xl-4">
                    <div class="blog-style1">
                        
                        <!-- Blog Image -->
                        <div class="blog-img">
                            <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/default.jpg') }}" 
                                 alt="{{ $article->title }}">
                                 
                            <a data-theme-color="#{{ $article->category->color ?? '000' }}" 
                               href="{{ url('category/' . ($article->category->id ?? '#')) }}" 
                               class="category">
                                {{ $article->category->name ?? 'Unknown Category' }}
                            </a>
                        </div>

                        <!-- Blog Title -->
                        <h3 class="box-title-22">
                            <a style="font-size: 18px" class="hover-line" 
                               href="{{ url('article/' . $article->id) }}">
                               {{ $article->title }}
                            </a>
                        </h3>

                        <!-- Blog Meta Data -->
                        <div class="blog-meta">
                            <a href="#">
                                <i class="fal fa-calendar-days"></i>
                                {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

<section class="space">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="sec-title has-line">অর্থনীতি</h2>
            </div>
        </div>

        <div class="row">
            @php
                $economyNews = \App\Models\Category::where('name', 'অর্থনীতি')->first();
                $articles = $economyNews ? $economyNews->articles()->where('status', 'published')->latest()->take(5)->get() : collect();
            @endphp

            @if ($articles->isNotEmpty())
                <!-- Featured Article (First Article) -->
                <div class="col-xl-6 mb-35 mb-xl-0">
                    <div class="blog-style1 style-big">
                        <div class="blog-img">
                            <img src="{{ optional($articles->first())->image 
                                ? asset('storage/' . $articles->first()->image) 
                                : asset('images/default.jpg') }}" 
                                alt="{{ optional($articles->first())->title ?? 'Default Title' }}">

                            <a data-theme-color="#{{ $articles->first()->category->color ?? '000' }}" 
                               href="{{ url('category/' . ($articles->first()->category->id ?? '#')) }}" 
                               class="category">
                               {{ $articles->first()->category->name ?? 'No Category' }}
                            </a>
                        </div>

                        <h3 class="box-title-30">
                            <a style="font-size:24px" class="hover-line" 
                               href="{{ $articles->first()->id ? url('article/' . $articles->first()->id) : '#' }}">
                                {{ $articles->first()->title ?? 'No Title Available' }}
                            </a>
                        </h3>

                        <div class="blog-meta">
                            <a href="#">
                                <i class="fal fa-calendar-days"></i>
                                {{ $articles->first()->created_at 
                                    ? \App\Helpers\BanglaDateHelper::convertToBanglaDate($articles->first()->created_at->format('d M, Y')) 
                                    : '' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Remaining Articles (Grid Layout) -->
                <div class="col-xl-6">
                    <div class="row gy-4">
                        @foreach ($articles->skip(1) as $article)
                            <div class="col-xl-6 col-sm-6 border-blog two-column">
                                <div class="blog-style1">
                                    <div class="blog-img">
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">

                                        <a data-theme-color="#{{ $article->category->color ?? '007BFF' }}" 
                                           href="{{ url('category/' . $article->category->id) }}" 
                                           class="category">
                                           {{ $article->category->name ?? 'অর্থনীতি' }}
                                        </a>
                                    </div>

                                    <h3 class="box-title-22">
                                        <a class="hover-line" href="{{ url('article/' . $article->id) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h3>

                                    <div class="blog-meta">
                                        <a href="#">
                                            <i class="fal fa-calendar-days"></i>
                                            {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center">No articles found in অর্থনীতি category.</p>
            @endif
        </div>
        
    </div>
</section>


@if($banner)
    <div class="container mb-5">
        <a href="{{ $banner->link ?? '#' }}">
            <img src="{{ asset('storage/'.$banner->image) }}" alt="ads" class="w-100">
        </a>
    </div>
@endif


<div class="space dark-theme bg-title-dark">
    <div class="container">
        <h2 class="sec-title has-line">সর্বশেষ ভিডিও প্লেলিস্ট</h2>
        <div class="row">
            <!-- Left Column: Video List (Max 5 Videos) -->
            <div class="col-xl-4 col-lg-2">
                <div class="blog-tab" data-asnavfor=".blog-tab-slide">
                    @php
                        $videos = \App\Models\VideoGallery::latest()->limit(5)->get();
                    @endphp
            
                    @foreach ($videos as $index => $video)
                        @php
                            // Extract Video ID from YouTube URL
                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.+?v=))([^"&?\/\s]{11})/', $video->video1, $matches);
                            $videoId = $matches[1] ?? null;
                            $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/$videoId/hqdefault.jpg" : asset('storage/default-thumbnail.jpg');
                        @endphp
            
                        <div class="tab-btn {{ $index == 0 ? 'active' : '' }}">
                            <div class="blog-style2">
                                <div class="blog-img img-100">
                                    <a href="javascript:void(0);" class="video-thumbnail" 
                                       data-video-url="{{ str_replace('watch?v=', 'embed/', $video->video1) }}" 
                                       data-title="{{ $video->title }}">
                                        <img src="{{ $thumbnailUrl }}" alt="Thumbnail for {{ $video->title }}">
                                        <div class="icon"><i class="fal fa-waveform-lines"></i></div>
                                        <div class="play-btn"><i class="fas fa-play"></i></div>
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <h3 class="box-title-20">
                                        <a href="javascript:void(0);" class="video-title" 
                                           data-video-url="{{ str_replace('watch?v=', 'embed/', $video->video1) }}" 
                                           data-title="{{ $video->title }}">
                                            {{ $video->title }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            

            <!-- Right Column: Main Video -->
            <div class="col-xl-8 col-lg-10">
                <div class="blog-tab-slide th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1">
                    <div id="mainVideoContainer">
                        @if ($videos->count() > 0)
                            @php
                                $firstVideo = $videos->first();
                            @endphp
                            <div class="blog-style8">
                                <div class="">
                                    <iframe id="mainVideoPlayer" 
                                            width="100%" 
                                            height="400" 
                                            src="{{ str_replace('watch?v=', 'embed/', $firstVideo->video1) }}" 
                                            frameborder="0" 
                                            allowfullscreen
                                            title="Main Video: {{ $firstVideo->title }}"></iframe>
                                </div>
                                <h3 id="mainVideoTitle" class="box-title-30">{{ $firstVideo->title }}</h3>
                            </div>
                        @else
                            <p class="text-white">No videos available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Update Main Video -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("JS Loaded - Checking Event Listeners");

        // Attach event listener to all video thumbnails and titles
        document.querySelectorAll(".video-thumbnail, .video-title").forEach(item => {
            item.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default action
                
                const videoUrl = this.getAttribute("data-video-url");
                const title = this.getAttribute("data-title");

                // Debugging: Log Values
                console.log("Clicked Video URL:", videoUrl);
                console.log("Clicked Video Title:", title);

                // Call function to update video
                updateMainVideo(videoUrl, title);
            });
        });
    });

    function updateMainVideo(videoUrl, title) {
        console.log("Updating Main Video..."); // Debugging
        const mainVideoPlayer = document.getElementById("mainVideoPlayer");
        const mainVideoTitle = document.getElementById("mainVideoTitle");

        if (mainVideoPlayer && mainVideoTitle) {
            mainVideoPlayer.src = videoUrl;
            mainVideoTitle.innerText = title;
            console.log("Main video updated successfully!"); // Debugging
        } else {
            console.log("Error: Video player or title not found!"); // Debugging
        }
    }
</script>


<section class="space">
    <div class="container">
        <div class="row">
            <!-- International News Section -->
            <div class="col-xl-8">
                <h2 class="sec-title has-line">বিশ্ব খবর</h2>
                <div class="row gy-4">
                    @php
                        // Fetch the International category
                        $internationalCategory = \App\Models\Category::where('name', 'বিশ্ব খবর')->first();
                        // Get the latest 2 articles for display
                        $internationalArticles = $internationalCategory ? $internationalCategory->articles()->latest()->take(2)->get() : [];
                    @endphp

                    @foreach ($internationalArticles as $article)
                        <div class="col-sm-6 border-blog two-column">
                            <div class="blog-style1">
                                <div class="blog-img">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                    <a data-theme-color="#FF9500" href="{{ url('category/'.$internationalCategory->id) }}" class="category">{{$internationalCategory->name}}</a>
                                </div>
                                <h3 class="box-title-24"><a style="font-size:24px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                <div class="blog-meta">
                                    <a href="#">
    <i class="fal fa-calendar-days"></i>
    {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
</a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar with Tabs -->
            <div class="col-xl-4 mt-35 mt-xl-0">
                <div class="nav tab-menu indicator-active" role="tablist">
                    <button class="tab-btn active" id="nav2-one-tab" data-bs-toggle="tab" data-bs-target="#nav2-one" type="button" role="tab" aria-controls="nav2-one" aria-selected="true">বাণিজ্য</button>
                    <button class="tab-btn" id="nav2-two-tab" data-bs-toggle="tab" data-bs-target="#nav2-two" type="button" role="tab" aria-controls="nav2-two" aria-selected="false">বিনোদন</button>
                    <button class="tab-btn" id="nav2-three-tab" data-bs-toggle="tab" data-bs-target="#nav2-three" type="button" role="tab" aria-controls="nav2-three" aria-selected="false">শিক্ষা</button>
                </div>
                
                <div class="tab-content">
    @php
        // Fetch categories dynamically
        $businessCategory = \App\Models\Category::where('name', 'বাণিজ্য')->first();
        $entertainmentCategory = \App\Models\Category::where('name', 'বিনোদন')->first();
        $educationCategory = \App\Models\Category::where('name', 'শিক্ষা')->first();

        // Fetch articles based on category_id
        $trendingNews = $businessCategory 
            ? \App\Models\Article::where('category_id', $businessCategory->id)
                ->where('status', 'published')
                ->latest()
                ->take(3)
                ->get() 
            : collect();

        $recentNews = $entertainmentCategory 
            ? \App\Models\Article::where('category_id', $entertainmentCategory->id)
                ->where('status', 'published')
                ->latest()
                ->take(3)
                ->get() 
            : collect();

        $popularNews = $educationCategory 
            ? \App\Models\Article::where('category_id', $educationCategory->id)
                ->where('status', 'published')
                ->latest()
                ->take(3)
                ->get() 
            : collect();
    @endphp

    <!-- Trending News (Business) -->
    <div class="tab-pane fade show active" id="nav2-one" role="tabpanel" aria-labelledby="nav2-one-tab">
        <div class="row gy-4">
            @foreach ($trendingNews as $article)
                <div class="col-xl-12 col-md-6 border-blog">
                    <div class="blog-style2">
                        <div class="blog-img">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                        </div>
                        <div class="blog-content">
                            <a data-theme-color="#FF9500" href="{{ url('category/'.$article->category->id) }}" class="category">
                                {{ $article->category->name }}
                            </a>
                            <h3 class="box-title-20">
                                <a style="font-size:24px" class="hover-line" href="{{ url('article/'.$article->id) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <div class="blog-meta">
                                <a href="#">
                                    <i class="fal fa-calendar-days"></i>
                                    {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent News (Entertainment) -->
    <div class="tab-pane fade" id="nav2-two" role="tabpanel" aria-labelledby="nav2-two-tab">
        <div class="row gy-4">
            @foreach ($recentNews as $article)
                <div class="col-xl-12 col-md-6 border-blog">
                    <div class="blog-style2">
                        <div class="blog-img">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                        </div>
                        <div class="blog-content">
                            <a data-theme-color="#00D084" href="{{ url('category/'.$article->category->id) }}" class="category">
                                {{ $article->category->name }}
                            </a>
                            <h3 class="box-title-20">
                                <a style="font-size:24px" class="hover-line" href="{{ url('article/'.$article->id) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <div class="blog-meta">
                                <a href="#">
                                    <i class="fal fa-calendar-days"></i>
                                    {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Popular News (Education) -->
    <div class="tab-pane fade" id="nav2-three" role="tabpanel" aria-labelledby="nav2-three-tab">
        <div class="row gy-4">
            @foreach ($popularNews as $article)
                <div class="col-xl-12 col-md-6 border-blog">
                    <div class="blog-style2">
                        <div class="blog-img">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                        </div>
                        <div class="blog-content">
                            <a data-theme-color="#E8137D" href="{{ url('category/'.$article->category->id) }}" class="category">
                                {{ $article->category->name }}
                            </a>
                            <h3 class="box-title-20">
                                <a style="font-size:24px" class="hover-line" href="{{ url('article/'.$article->id) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <div class="blog-meta">
                                <a href="#">
                                    <i class="fal fa-calendar-days"></i>
                                    {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

            </div>
        </div>
    </div>
</section>





<section class="space">
    <div class="container">
        <div class="row">
            <!-- Popular News Section -->
            <div class="col-xl-9">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="sec-title has-line">জনপ্রিয় সংবাদ</h2>
                    </div>
                    <div class="col-auto">
                        <div class="sec-btn">
                            <div class="filter-menu filter-menu-active">
                                <button data-filter="*" class="tab-btn active" type="button">সব</button>
                                <button data-filter=".cat1" class="tab-btn" type="button">অর্থনীতি</button>
                                <button data-filter=".cat2" class="tab-btn" type="button">খেলাধুলা</button>
                                <button data-filter=".cat3" class="tab-btn" type="button">রাজনীতি</button>
                                <button data-filter=".cat4" class="tab-btn" type="button">প্রযুক্তি</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="filter-active">
@php
    // Fetch category IDs dynamically
    $economyCategory = \App\Models\Category::where('name', 'অর্থনীতি')->first();
    $sportsCategory = \App\Models\Category::where('name', 'খেলাধুলা')->first();
    $politicsCategory = \App\Models\Category::where('name', 'রাজনীতি')->first();
    $technologyCategory = \App\Models\Category::where('name', 'প্রযুক্তি')->first();

    // Fetch articles by category ID
    $economyArticles = $economyCategory 
        ? \App\Models\Article::where('category_id', $economyCategory->id)
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get() 
        : collect();

    $sportsArticles = $sportsCategory 
        ? \App\Models\Article::where('category_id', $sportsCategory->id)
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get() 
        : collect();

    $politicsArticles = $politicsCategory 
        ? \App\Models\Article::where('category_id', $politicsCategory->id)
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get() 
        : collect();

    $technologyArticles = $technologyCategory 
        ? \App\Models\Article::where('category_id', $technologyCategory->id)
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get() 
        : collect();
@endphp


                    <!-- Economy Category -->
@foreach ($economyArticles as $article)
    <div class="border-blog2 filter-item cat1">
        <div class="blog-style4">
            <div class="blog-img">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
            </div>
            <div class="blog-content">
                <a data-theme-color="#007BFF" href="{{ url('category/' . $economyCategory->id) }}" class="category">
                    অর্থনীতি
                </a>
                <h3 class="box-title-24">
                    <a style="font-size:20px" class="hover-line" href="{{ url('article/' . $article->id) }}">
                        {{ $article->title }}
                    </a>
                </h3>
                <p class="blog-text">{{ Str::limit($article->content, 100) }}</p>
                <div class="blog-meta">
                    <a href="#">
                        <i class="fal fa-calendar-days"></i>
                        {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Sports Category -->
@foreach ($sportsArticles as $article)
    <div class="border-blog2 filter-item cat2">
        <div class="blog-style4">
            <div class="blog-img">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
            </div>
            <div class="blog-content">
                <a data-theme-color="#FF9500" href="{{ url('category/' . $sportsCategory->id) }}" class="category">
                    খেলাধুলা
                </a>
                <h3 class="box-title-24">
                    <a style="font-size:20px" class="hover-line" href="{{ url('article/' . $article->id) }}">
                        {{ $article->title }}
                    </a>
                </h3>
                <p class="blog-text">{{ Str::limit($article->content, 100) }}</p>
                <div class="blog-meta">
                    <a href="#">
                        <i class="fal fa-calendar-days"></i>
                        {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Politics Category -->
@foreach ($politicsArticles as $article)
    <div class="border-blog2 filter-item cat3">
        <div class="blog-style4">
            <div class="blog-img">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
            </div>
            <div class="blog-content">
                <a data-theme-color="#E7473C" href="{{ url('category/' . $politicsCategory->id) }}" class="category">
                    রাজনীতি
                </a>
                <h3 class="box-title-24">
                    <a style="font-size:20px" class="hover-line" href="{{ url('article/' . $article->id) }}">
                        {{ $article->title }}
                    </a>
                </h3>
                <p class="blog-text">{{ Str::limit($article->content, 100) }}</p>
                <div class="blog-meta">
                    <a href="#">
                        <i class="fal fa-calendar-days"></i>
                        {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Technology Category -->
@foreach ($technologyArticles as $article)
    <div class="border-blog2 filter-item cat4">
        <div class="blog-style4">
            <div class="blog-img">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
            </div>
            <div class="blog-content">
                <a data-theme-color="#59C2D6" href="{{ url('category/' . $technologyCategory->id) }}" class="category">
                    প্রযুক্তি
                </a>
                <h3 class="box-title-24">
                    <a style="font-size:20px" class="hover-line" href="{{ url('article/' . $article->id) }}">
                        {{ $article->title }}
                    </a>
                </h3>
                <p class="blog-text">{{ Str::limit($article->content, 100) }}</p>
                <div class="blog-meta">
                    <a href="#">
                        <i class="fal fa-calendar-days"></i>
                        {{ \App\Helpers\BanglaDateHelper::convertToBanglaDate($article->created_at->format('d M, Y')) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach


                </div>
            </div>

            <!-- Sidebar Section -->
            {{-- <div class="col-xl-3 mt-35 mt-xl-0 mb-10 sidebar-wrap">
                <div class="sidebar-area">
                    <div class="widget mb-30">
                        <div class="widget-ads">
                            <a href="https://themeforest.net/user/themeholy/portfolio">
                                <img class="w-100" src="assets/img/ads/siderbar_ads_1.jpg" alt="ads">
                            </a>
                        </div>
                    </div>
                    <div class="widget newsletter-widget2 mb-30" data-bg-src="assets/img/bg/particle_bg_1.png">
                        <h3 class="box-title-24">Subscribe Our Newsletter</h3>
                        <form class="newsletter-form">
                            <input class="form-control" type="email" placeholder="Enter Email" required="">
                            <button type="submit" class="th-btn btn-fw">Subscribe Now</button>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<div class="space dark-theme bg-title-dark">
    <div class="container">
        <h2 class="sec-title has-line">গ্যালারি</h2>
        <div class="row">
            <!-- Left Section: List of 5 Latest Galleries -->
            <div class="col-xl-4 col-lg-2">
                <div class="blog-tab" id="galleryTab">
                    @foreach ($galleryList as $index => $galleryItem)
                        <div class="tab-btn @if($loop->first) active @endif"
                             data-index="{{ $index }}"
                             onclick="updateGallery('{{ asset('storage/'.$galleryItem->image1) }}', '{{ $galleryItem->title1 }}', {{ $index }})">
                            <div class="blog-style2">
                                <div class="blog-img img-100">
                                    <img src="{{ $galleryItem->image1 ? asset('storage/'.$galleryItem->image1) : '' }}
" alt="Gallery Image">
                                    <div class="icon"> </div>
                                </div>
                                <div class="blog-content">
                                    <h3 class="box-title-20">{{ $galleryItem->title1 }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            

            <!-- Right Section: Large Preview -->
            <div class="col-xl-8 col-lg-10">
                <div class="blog-tab-slide th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1">
                    <div class="">
                        <div class="blog-style8">
                            <div class="blog-img">
                                <img id="large-gallery-image" src="{{ optional($gallery)->image1 ? asset('storage/' . $gallery->image1) : '' }}
" alt="Gallery Image">
@if ($gallery && $gallery->id)
    <a href="{{ route('gallery.page', $gallery->id) }}" class="play-btn">
        <i class="fas fa-expand"></i>
    </a>
@endif


                            </div>
                            <h3 class="box-title-30" id="large-gallery-title">{{ $gallery->title1 ?? '' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="space-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="sec-title has-line mt-5">বৈশিষ্ট্যযুক্ত পোস্ট</h2>
            </div>
            <div class="col-auto">
                <div class="sec-btn">
                    <div class="icon-box">
                        <button data-slick-prev="#blog-slide3" class="slick-arrow default"><i class="far fa-arrow-left"></i></button>
                        <button data-slick-next="#blog-slide3" class="slick-arrow default"><i class="far fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>

        @php
            // Fetch the latest 6 featured posts (marked as featured in the database)
            $featuredPosts = \App\Models\Article::latest()->where('status', 'published')->take(6)->get();
        @endphp

        <div class="row th-carousel" id="blog-slide3" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="1">
            @foreach ($featuredPosts as $post)
                <div class="col-sm-6 col-xl-4">
                    <div class="blog-style1">
                        <div class="blog-img">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            <a data-theme-color="#{{ $post->category->color }}" href="{{ url('category/'.$post->category->id) }}" class="category">{{ $post->category->name }}</a>
                        </div>
                        <h3 class="box-title-24"><a style="font-size: 20px;" class="hover-line" href="{{ url('article/'.$post->id) }}">{{ $post->title }}</a></h3>
                        <div class="blog-meta">
                            <a href="#"><i class="fal fa-calendar-days"></i>{{ $post->created_at->format('d M, Y') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Initialize Isotope
        var $grid = $('.filter-active').isotope({
            itemSelector: '.filter-item',
            layoutMode: 'fitRows'
        });

        // Filter items on button click
        $('.filter-menu button').on('click', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });

            // Add active class to the current button
            $('.filter-menu button').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>









@endsection