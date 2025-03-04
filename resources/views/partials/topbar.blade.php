
@php
    $articles = \App\Models\Article::latest()->limit(5)->get(['id', 'title','created_at']);
@endphp

<!-- Side Menu Wrapper -->

<div class="sidemenu-wrapper sidemenu-1 d-none d-md-block">
    <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
        <div class="widget">
            <div class="th-widget-about">
                <div class="about-logo">
                    <a href="/">
                        <img class="light-img" src="{{asset('assets/image.png')}}" alt="Tnews">
                        {{-- <img class="dark-img" src="/assets/img/logo-footer.svg" alt="Tnews"> --}}
                    </a>
                </div>
                <p class="about-text">Magazines cover a wide range of subjects, including fashion, lifestyle, health, politics, business, entertainment, sports, and science.</p>
                <div class="th-social style-black">
                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Dynamic Recent Posts -->
        <div class="widget">
            <h3 class="widget_title">Recent Articles</h3>
            <div class="recent-post-wrap">
                @foreach ($articles as $article)
                    <div class="recent-post">
                        <div class="media-img">
                            <a href="{{ url('article/'.$article->id) }}"><img src="{{ asset($article->image) }}" alt="Article Image"></a>
                        </div>
                        <div class="media-body">
                            <h4 class="post-title"><a class="hover-line" href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></h4>
                            <div class="recent-post-meta">
                                <a href="{{ url('articles') }}"><i class="fal fa-calendar-days"></i>{{ $article->created_at->format('d F, Y') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>
</div>

<div class="popup-search-box">
    <button class="searchClose"><i class="fal fa-times"></i></button>
    <form action="{{ route('search') }}">
        <input type="text" placeholder="What are you looking for?">
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>
</div>
