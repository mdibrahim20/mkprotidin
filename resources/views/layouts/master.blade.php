<!doctype html>
<html class="no-js" data-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MKprotidin | Newspaper</title>
    <meta name="author" content="Tnews">
    <meta name="description" content="Tnews - News & Magazine HTML Template">
    <meta name="keywords" content="Tnews - News & Magazine HTML Template">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets')}}/img/favicon.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets')}}/img/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets')}}/img/favicon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets')}}/img/favicon.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets')}}/img/favicon.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets')}}/img/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets')}}/img/favicon.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets')}}/img/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets')}}/img/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets')}}/img/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets')}}/img/favicon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets')}}/img/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets')}}/img/favicon.png">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">

    <link rel="manifest" href="{{asset('assets')}}/img/favicon.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets')}}/img/favicon.png">
    <meta name="theme-color" content="#ffffff">
    

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">


    <!-- Open Graph Meta Tags -->
    <meta property="fb:app_id" content="1018260203529253">
    <meta property="og:type" content="article">
    <meta property="og:title" content="@yield('og_title', 'MKprotidin | Newspaper')">
    <meta property="og:description" content="@yield('og_description', 'Latest news and updates')">
    <meta property="og:image" content="@yield('og_image', asset('assets/img/default.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="MKprotidin">

    
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'MKprotidin | Newspaper')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Latest news and updates')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/img/default.jpg'))">


    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.min.css')}}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.min.css')}}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{asset('assets/css/slick.min.css')}}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Isotope (for filtering) -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <style>
        /* Hide unwanted elements when printing */
        @media print {
            body {
                font-family: 'SolaimanLipi', sans-serif;
                padding: 20px;
                background: #fff;
                color: #000;
            }
    
            .no-print {
                display: none !important;
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
        }
    </style>
    
</head>
<body class="bg-gray-100 font-sans">

    @include('partials.topbar')
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>

    <script src="{{asset('assets')}}/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Slick Slider -->
    <script src="{{asset('assets')}}/js/slick.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset('assets')}}/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="{{asset('assets')}}/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up -->
    <script src="{{asset('assets')}}/js/jquery.counterup.min.js"></script>
    <!-- Range Slider -->
    <script src="{{asset('assets')}}/js/jquery-ui.min.js"></script>
    <!-- Isotope Filter -->
    <script src="{{asset('assets')}}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{asset('assets')}}/js/isotope.pkgd.min.js"></script>
    <!-- Vimeo Player -->
    <script src="{{asset('assets')}}/js/vimeo_player.js"></script>

    <!-- Main Js File -->
    <script src="{{asset('assets')}}/js/main.js"></script>

</body>
</html>
