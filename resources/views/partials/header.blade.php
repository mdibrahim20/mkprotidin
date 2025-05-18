@php
    $allCategories = \App\Models\Category::all(); // Fetch all categories
    $categories = $allCategories->take(9); // First 9 categories
    $remainingCategories = $allCategories->skip(9); // Remaining categories
    $banner = \App\Models\Ads::latest()->first();
@endphp


<header class="th-header header-layout1">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto d-none d-lg-block">
                    <div class="header-links">
                        <ul>
<li>
    <i class="fal fa-calendar-days"></i>
    <a href="#" id="bangla-date"></a>
</li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="header-links">
                        <ul>
                            <li>
                                <div class="social-links">
                            <a href="https://www.facebook.com/share/18pSJUpJwy/?mibextid=wwXIfr" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/mkprotidin?igsh=emRtanMzbWFtdnlw" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="https://youtube.com/@mkprotidin?si=UJ9ZaXjfeWvDUe2y" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
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
                    
                        <a href="{{ $banner->link ?? '#' }}">
                            <img src="{{ asset('storage/'.$banner->image) }}" alt="ads" class="w-100">
                        </a>
                    
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
                                <li><a href="/">হোম</a></li>
                                
                                    @foreach ($categories as $category)
                                    <li><a href="{{ url('category/'.$category->id) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                    <li class="menu-item-has-children">
                                        <a href="#">অন্যান্য</a>
                                        <ul class="sub-menu">
                                            @foreach ($remainingCategories as $remainingCategorie)
                                            <li>
                                                <a href="{{ url('category/'.$category->id) }}">{{$remainingCategorie->name}}</a>
                                            </li>
                                            @endforeach
                                            
                                        </ul>
                                    </li>
                                    <li><a href="{{url('/archive')}}">আর্কাইভ</a></li>
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
                <li><a href="/">হোম</a></li>
                    @foreach ($categories as $category)
                    <li><a href="{{ url('category/'.$category->id) }}">{{ $category->name }}</a></li>
                    @endforeach
                    <li class="menu-item-has-children">
                        <a href="#">অন্যান্য</a>
                        <ul class="sub-menu">
                            @foreach ($remainingCategories as $remainingCategorie)
                            <li>
                                <a href="{{ url('category/'.$category->id) }}">{{$remainingCategorie->name}}</a>
                            </li>
                            @endforeach
                            
                        </ul>
                    </li>
            </ul>
        </div>
    </div>
</div>
<script>
    function convertToBanglaNumber(number) {
        const banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return number.toString().replace(/\d/g, digit => banglaDigits[digit]);
    }

    function updateBanglaDate() {
        const now = new Date();

        // Convert to Bangladesh Time (GMT+6)
        now.setUTCHours(now.getUTCHours() + 6);

        const day = convertToBanglaNumber(now.getDate());
        const year = convertToBanglaNumber(now.getFullYear());

        const monthNames = [
            'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন',
            'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
        ];
        const dayNames = [
            'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার'
        ];

        const month = monthNames[now.getMonth()];
        const dayName = dayNames[now.getDay()];

        document.getElementById('bangla-date').innerText = `${dayName}, ${day} ${month}, ${year}`;
    }

    // Initial call
    updateBanglaDate();

    // Update every 60 seconds
    setInterval(updateBanglaDate, 60000);
</script>