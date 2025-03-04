@php
    $categories = \App\Models\Category::all();
    $banner = \App\Models\Ads::latest()->first();
@endphp

<header class="th-header header-layout1">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto d-none d-lg-block">
                    <div class="header-links">
                        <ul>
                            <li><i class="fal fa-calendar-days"></i><a href="#">{{ now()->format('d F, Y') }}</a></li>
                            <li><a href="about.html">Privacy Policy</a></li>
                            <li><a href="about.html">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="header-links">
                        <ul>
                            <li><i class="far fa-user"></i><a href="/login">Login / Register</a></li>
                            <li>
                                <div class="social-links">
                                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-3 d-none d-lg-block">
                    <div class="header-logo">
                        <a href="/"><img class="light-img" src="{{asset('assets/image.png')}}" alt="Tnews" width="90%"></a>
                    </div>
                </div>
                <div class="col-8">
                    @if($banner)
                    <div class="header-ads">
                        <a href="{{ $banner->link ?? '#' }}">
                            <img src="{{ asset('storage/'.$banner->image) }}" alt="ads" class="w-100">
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="sticky-wrapper">
        <div class="menu-area">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto d-lg-none d-block">
                        <div class="header-logo">
                            <a href="home-newspaper.html"><img src="{{asset('assets/image.png')}}" alt="Tnews"></a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <nav class="main-menu d-none d-lg-inline-block">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li class="menu-item-has-children">
                                    <a href="#">Categories</a>
                                    <ul class="sub-menu">
                                        @foreach ($categories as $category)
                                            <li><a href="{{ url('category/'.$category->id) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-auto">
                        <div class="header-button">
                            <button class="searchBoxToggler"><i class="far fa-search"></i></button>
                            <a href="#" class="icon-btn sideMenuToggler d-none d-lg-block"><i class="far fa-bars"></i></a>
                            <button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="/"><img src="{{asset('assets/image.png')}}" alt="Tnews"></a>
        </div>
        <div class="th-mobile-menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li class="menu-item-has-children">
                    <a href="#">Categories</a>
                    <ul class="sub-menu">
                        @foreach ($categories as $category)
                            <li><a href="{{ url('category/'.$category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
    </div>
</div>