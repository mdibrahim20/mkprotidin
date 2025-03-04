@extends('layouts.master')

@section('title', 'News Portal - Home')

@section('content')

@include('partials.news_ticker')

<section class="space">
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <div class="row gy-4">
                    @php
                        $sideArticles = \App\Models\Article::latest()->take(2)->get();
                        $banner = \App\Models\Ads::latest()->first();
                    @endphp
                    @foreach ($sideArticles as $article)
                        <div class="col-xl-12 col-sm-6 border-blog dark-theme img-overlay2">
                            <div class="blog-style3">
                                <div class="blog-img">
                                    <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#{{ $article->category->color }}" href="{{ url('category/'.$article->category->id) }}" class="category">{{ $article->category->name }}</a>
                                    <h3 class="box-title-22"><a class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                    <div class="blog-meta">
                                        <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-6 mt-4 mt-xl-0">
                @php
                        $mainArticle = \App\Models\Article::first();
                    @endphp
                @if ($mainArticle)
                <div class="dark-theme img-overlay2">
                    <div class="blog-style3">
                        <div class="blog-img">
                            <img src="{{ asset('storage/'.$mainArticle->image) }}" alt="{{ $mainArticle->title }}">
                        </div>
                        <div class="blog-content">
                            <a data-theme-color="#{{ $mainArticle->category->color }}" href="{{ url('category/'.$mainArticle->category->id) }}" class="category">{{ $mainArticle->category->name }}</a>
                            <h3 class="box-title-30"><a class="hover-line" href="{{ url('article/'.$mainArticle->id) }}">{{ $mainArticle->title }}</a></h3>
                            <div class="blog-meta">
                                <a href="#"><i class="fal fa-calendar-days"></i>{{ $mainArticle->created_at->format('d M, Y') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            </div>
            <div class="col-xl-3 mt-35 mt-xl-0">
                <div class="nav tab-menu indicator-active" role="tablist">
                    <button class="tab-btn active" id="nav-one-tab" data-bs-toggle="tab" data-bs-target="#nav-one" type="button" role="tab" aria-controls="nav-one" aria-selected="true">Top News</button>
                    <button class="tab-btn" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two" type="button" role="tab" aria-controls="nav-two" aria-selected="false">Recent News</button>
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
                                $topNews = \App\Models\Article::latest()->take(4)->get();
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
                                                {{ $article->category->name }}
                                            </a>
                                            <h3 class="box-title-18"><a style="font-size: 14px !important;" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                            <div class="blog-meta">
                                                <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
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
                                $recentNews = \App\Models\Article::latest()->skip(4)->take(4)->get();
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
                                                {{ $article->category->name }}
                                            </a>
                                            <h3 class="box-title-18"><a class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                            <div class="blog-meta">
                                                <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
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
<div class="">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="sec-title has-line">Trending News</h2>
            </div>
            <div class="col-auto">
                <div class="sec-btn">
                    <div class="icon-box">
                        <button data-slick-prev="#blog-slide1" class="slick-arrow default"><i class="far fa-arrow-left"></i></button>
                        <button data-slick-next="#blog-slide1" class="slick-arrow default"><i class="far fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row th-carousel" id="blog-slide1" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="2">
            @php
                $trendingNews = \App\Models\Article::latest()
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();
            @endphp
            @foreach ($trendingNews as $article)
                <div class="col-sm-6 col-xl-4">
                    <div class="blog-style1">
                        <div class="blog-img">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                            <a data-theme-color="#{{ $article->category->color }}" href="{{ url('category/'.$article->category->id) }}" class="category">{{ $article->category->name }}</a>
                        </div>
                        <h3 class="box-title-22"><a style="font-size: 18px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                        <div class="blog-meta">

                            <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
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
                <h2 class="sec-title has-line">Technology News</h2>
            </div>
        </div>
        <div class="row">
            @php
                $technologyCategory = \App\Models\Category::where('name', 'অর্থনীতি')->first();
                $techArticles = $technologyCategory ? $technologyCategory->articles()->latest()->take(5)->get() : [];
            @endphp

            @if ($techArticles->isNotEmpty())
                <!-- Featured article (first article) -->
                <div class="col-xl-6 mb-35 mb-xl-0">
                    <div class="blog-style1 style-big">
                        <div class="blog-img">
                            <img src="{{ asset('storage/' . $techArticles->first()->image) }}" alt="{{ $techArticles->first()->title }}">
                            <a data-theme-color="#007BFF" href="{{ url('category/'.$technologyCategory->id) }}" class="category">Technology</a>
                        </div>
                        <h3 class="box-title-30"><a style="font-size:24px" class="hover-line" href="{{ url('article/'.$techArticles->first()->id) }}">{{ $techArticles->first()->title }}</a></h3>
                        <div class="blog-meta">
                            <a href="#"><i class="fal fa-calendar-days"></i>{{ $techArticles->first()->created_at->format('d M, Y') }}</a>
                        </div>
                    </div>
                </div>

                <!-- Remaining articles (grid layout) -->
                <div class="col-xl-6">
                    <div class="row gy-4">
                        @foreach ($techArticles->skip(1) as $article)
                            <div class="col-xl-6 col-sm-6 border-blog two-column">
                                <div class="blog-style1">
                                    <div class="blog-img">
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                        <a data-theme-color="#007BFF" href="{{ url('category/'.$technologyCategory->id) }}" class="category">Technology</a>
                                    </div>
                                    <h3 class="box-title-22"><a class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                    <div class="blog-meta">
                                        <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center">No articles found in Technology category.</p>
            @endif
        </div>
    </div>
</section>

@if($banner)
    <div class="container">
        <a href="{{ $banner->link ?? '#' }}">
            <img src="{{ asset('storage/'.$banner->image) }}" alt="ads" class="w-100">
        </a>
    </div>
@endif


<section class="space">
    <div class="container">
        <div class="row">
            <!-- International News Section -->
            <div class="col-xl-8">
                <h2 class="sec-title has-line">International News</h2>
                <div class="row gy-4">
                    @php
                        // Fetch the International category
                        $internationalCategory = \App\Models\Category::where('name', 'খেলাধুলা')->first();
                        // Get the latest 2 articles for display
                        $internationalArticles = $internationalCategory ? $internationalCategory->articles()->latest()->take(2)->get() : [];
                    @endphp

                    @foreach ($internationalArticles as $article)
                        <div class="col-sm-6 border-blog two-column">
                            <div class="blog-style1">
                                <div class="blog-img">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                    <a data-theme-color="#FF9500" href="{{ url('category/'.$internationalCategory->id) }}" class="category">International</a>
                                </div>
                                <h3 class="box-title-24"><a style="font-size:24px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                <div class="blog-meta">
                                    <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar with Tabs -->
            <div class="col-xl-4 mt-35 mt-xl-0">
                <div class="nav tab-menu indicator-active" role="tablist">
                    <button class="tab-btn active" id="nav2-one-tab" data-bs-toggle="tab" data-bs-target="#nav2-one" type="button" role="tab" aria-controls="nav2-one" aria-selected="true">Trending</button>
                    <button class="tab-btn" id="nav2-two-tab" data-bs-toggle="tab" data-bs-target="#nav2-two" type="button" role="tab" aria-controls="nav2-two" aria-selected="false">Recent</button>
                    <button class="tab-btn" id="nav2-three-tab" data-bs-toggle="tab" data-bs-target="#nav2-three" type="button" role="tab" aria-controls="nav2-three" aria-selected="false">Popular</button>
                </div>
                
                <div class="tab-content">
                    @php
                        // Fetch category IDs dynamically
                        $politicsCategory = \App\Models\Category::where('name', 'রাজনীতি')->first();
                        $economyCategory = \App\Models\Category::where('name', 'অর্থনীতি')->first();
                        $sportsCategory = \App\Models\Category::where('name', 'খেলাধুলা')->first();

                        // Fetch articles based on category_id
                        $trendingNews = $politicsCategory ? \App\Models\Article::where('category_id', $politicsCategory->id)->latest()->take(3)->get() : collect();
                        $recentNews = $economyCategory ? \App\Models\Article::where('category_id', $economyCategory->id)->latest()->take(3)->get() : collect();
                        $popularNews = $sportsCategory ? \App\Models\Article::where('category_id', $sportsCategory->id)->latest()->take(3)->get() : collect();
                    @endphp


                    <!-- Trending News -->
                    <div class="tab-pane fade show active" id="nav2-one" role="tabpanel" aria-labelledby="nav2-one-tab">
                        <div class="row gy-4">
                            @foreach ($trendingNews as $article)
                                <div class="col-xl-12 col-md-6 border-blog">
                                    <div class="blog-style2">
                                        <div class="blog-img">
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                        </div>
                                        <div class="blog-content">
                                            <a data-theme-color="#FF9500" href="{{ url('category/'.$article->category->id) }}" class="category">{{ $article->category->name }}</a>
                                            <h3 class="box-title-20"><a style="font-size:24px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                            <div class="blog-meta">
                                                <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent News -->
                    <div class="tab-pane fade" id="nav2-two" role="tabpanel" aria-labelledby="nav2-two-tab">
                        <div class="row gy-4">
                            @foreach ($recentNews as $article)
                                <div class="col-xl-12 col-md-6 border-blog">
                                    <div class="blog-style2">
                                        <div class="blog-img">
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                        </div>
                                        <div class="blog-content">
                                            <a data-theme-color="#00D084" href="{{ url('category/'.$article->category->id) }}" class="category">{{ $article->category->name }}</a>
                                            <h3 class="box-title-20"><a style="font-size:24px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                            <div class="blog-meta">
                                                <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Popular News -->
                    <div class="tab-pane fade" id="nav2-three" role="tabpanel" aria-labelledby="nav2-three-tab">
                        <div class="row gy-4">
                            @foreach ($popularNews as $article)
                                <div class="col-xl-12 col-md-6 border-blog">
                                    <div class="blog-style2">
                                        <div class="blog-img">
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                        </div>
                                        <div class="blog-content">
                                            <a data-theme-color="#E8137D" href="{{ url('category/'.$article->category->id) }}" class="category">{{ $article->category->name }}</a>
                                            <h3 class="box-title-20"><a style="font-size:24px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                            <div class="blog-meta">
                                                <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
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
                        <h2 class="sec-title has-line">Popular News</h2>
                    </div>
                    <div class="col-auto">
                        <div class="sec-btn">
                            <div class="filter-menu filter-menu-active">
                                <button data-filter="*" class="tab-btn active" type="button">ALL</button>
                                <button data-filter=".cat1" class="tab-btn" type="button">অর্থনীতি</button>
                                <button data-filter=".cat2" class="tab-btn" type="button">Politics</button>
                                <button data-filter=".cat3" class="tab-btn" type="button">Fitness</button>
                                <button data-filter=".cat4" class="tab-btn" type="button">Fashion</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-active">
                    @php
                        // Fetch category IDs dynamically
                        $travelCategory = \App\Models\Category::where('name', 'অর্থনীতি')->first();
                        $politicsCategory = \App\Models\Category::where('name', 'খেলাধুলা')->first();
                        $fitnessCategory = \App\Models\Category::where('name', 'রাজনীতি')->first();
                        $fashionCategory = \App\Models\Category::where('name', 'প্রযুক্তি')->first();

                        // Fetch articles by category ID
                        $travelArticles = $travelCategory ? \App\Models\Article::where('category_id', $travelCategory->id)->latest()->take(5)->get() : collect();
                        $politicsArticles = $politicsCategory ? \App\Models\Article::where('category_id', $politicsCategory->id)->latest()->take(5)->get() : collect();
                        $fitnessArticles = $fitnessCategory ? \App\Models\Article::where('category_id', $fitnessCategory->id)->latest()->take(5)->get() : collect();
                        $fashionArticles = $fashionCategory ? \App\Models\Article::where('category_id', $fashionCategory->id)->latest()->take(5)->get() : collect();
                    @endphp

                    <!-- Travel Category -->
                    @foreach ($travelArticles as $article)
                        <div class="border-blog2 filter-item cat1">
                            <div class="blog-style4">
                                <div class="blog-img">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#007BFF" href="{{ url('category/'.$travelCategory->id) }}" class="category">Travel</a>
                                    <h3 class="box-title-24"><a style="font-size:20px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                    <p class="blog-text">{{ Str::limit($article->content, 100) }}</p>
                                    <div class="blog-meta">
                                        <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Politics Category -->
                    @foreach ($politicsArticles as $article)
                        <div class="border-blog2 filter-item cat2">
                            <div class="blog-style4">
                                <div class="blog-img">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#FF9500" href="{{ url('category/'.$politicsCategory->id) }}" class="category">Politics</a>
                                    <h3 class="box-title-24"><a style="font-size:20px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                    <p class="blog-text">{{ Str::limit($article->content, 100) }}</p>
                                    <div class="blog-meta">
                                        <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Fitness Category -->
                    @foreach ($fitnessArticles as $article)
                        <div class="border-blog2 filter-item cat3">
                            <div class="blog-style4">
                                <div class="blog-img">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#E7473C" href="{{ url('category/'.$fitnessCategory->id) }}" class="category">Fitness</a>
                                    <h3 class="box-title-24"><a style="font-size:20px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                    <p class="blog-text">{{ Str::limit($article->content, 100) }}</p>
                                    <div class="blog-meta">
                                        <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Fashion Category -->
                    @foreach ($fashionArticles as $article)
                        <div class="border-blog2 filter-item cat4">
                            <div class="blog-style4">
                                <div class="blog-img">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                </div>
                                <div class="blog-content">
                                    <a data-theme-color="#59C2D6" href="{{ url('category/'.$fashionCategory->id) }}" class="category">Fashion</a>
                                    <h3 class="box-title-24"><a style="font-size:20px" class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h3>
                                    <p class="blog-text">{{ Str::limit($article->content, 100) }}</p>
                                    <div class="blog-meta">
                                        <a href="#"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d M, Y') }}</a>
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
<div class="space-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="sec-title has-line">Featured Post</h2>
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
            $featuredPosts = \App\Models\Article::latest()->take(6)->get();
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






@endsection