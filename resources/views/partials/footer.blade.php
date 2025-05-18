@php
    $categories = \App\Models\Category::latest()->limit(8)->get();
    $recentPosts = \App\Models\Article::latest()->limit(2)->get(); 
@endphp
<footer class="footer-wrapper footer-layout1" style="background-color: #7e7878;">
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-3">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo">
                                <a href="home-newspaper.html"><img src="{{asset('assets/image.png')}}" alt="Tnews"></a>
                            </div>
                            <div class="contact-info">
                                <p><strong>সম্পাদক:</strong></p>
                                <p><strong>মোঃ কবির নেওয়াজ রাজ</strong></p>
                                <p><strong>Mailing Address:</strong> House# 4/A, Main Road, Ati Model Society, Ati, Keraniganj, Dhaka-1312</p>
                                <p><strong>E-mail:</strong> <a href="mailto:mkprotidin@gmail.com">mkprotidin@gmail.com</a></p>
                                <p><strong>Contact:</strong> 
                                    <a href="tel:+8801643565087">(+880) 1643-565087</a>, 
                                    <a href="tel:+8801922619387">(+880) 1922-619387</a>
                                </p>
                                
                            </div>                            
                            <div class="th-social style-black">
                            <a href="https://www.facebook.com/share/18pSJUpJwy/?mibextid=wwXIfr" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/mkprotidin?igsh=emRtanMzbWFtdnlw" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="https://youtube.com/@mkprotidin?si=UJ9ZaXjfeWvDUe2y" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">ক্যাটাগরি</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                @foreach ($categories as $category)
                                <li><a href="{{ url('category/'.$category->id) }}">{{ $category->name }}</a></li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <h3 class="widget_title">সাম্প্রতিক পোস্ট</h3>
                        <div class="recent-post-wrap">
                            @foreach ($recentPosts as $post)
                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="{{ url('article/'.$post->id) }}">
                                            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title">
                                            <a class="hover-line" href="{{ url('article/'.$post->id) }}">{{ $post->title }}</a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            <a href="{{ url('blog') }}">
                                                <i class="fal fa-calendar-days"></i> {{ $post->created_at->format('d M, Y') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--<div class="col-md-6 col-xl-3">-->
                <!--    <div class="widget footer-widget">-->
                <!--        <h3 class="widget_title">Follow Us</h3>-->
                <!--        <div class="social-icons">-->
                <!--            <a href="https://www.facebook.com/share/18pSJUpJwy/?mibextid=wwXIfr" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>-->
                <!--            <a href="https://www.instagram.com/mkprotidin?igsh=emRtanMzbWFtdnlw" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>-->
                <!--            <a href="https://youtube.com/@mkprotidin?si=UJ9ZaXjfeWvDUe2y" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row jusity-content-between align-items-center">
                <div class="col-lg-12 text-center">
                    <p class="copyright-text">Copyright <i class="fal fa-copyright"></i>  {{ date('Y') }} <a href="Mkpratidin.com">MKprotidin</a>. All Rights Reserved.</p>
                </div>
                {{-- <div class="col-lg-auto ms-auto d-none d-lg-block">
                    <div class="footer-links">
                        <ul>
                            <!--<li><a href="home-newspaper.html">Home</a></li>-->
                            <!--<li><a href="about.html">About Us</a></li>-->
                            <!--<li><a href="about.html">Faq</a></li>-->
                            <!--<li><a href="contact.html">Contact Us</a></li>-->
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</footer>