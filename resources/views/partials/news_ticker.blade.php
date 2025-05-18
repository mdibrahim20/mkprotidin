<div>
    <div class="container">
        <div class="news-area">
            <div class="title">সদ্যপ্রাপ্ত সংবাদ :</div>
            <div class="news-wrap">
                <div class="row slick-marquee">
                    @php
                        $latestArticles = \App\Models\Article::where('status','published')->latest()->limit(20)->get(['id', 'title']);
                    @endphp

                    @foreach ($latestArticles as $article)
                        <div class="col-auto">
                            <a href="{{ url('article/'.$article->id) }}" class="breaking-news">{{ $article->title }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
