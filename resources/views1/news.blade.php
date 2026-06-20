@extends('layouts.guest')
@section('content')
<section class="section-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12 position-relative text-center">
                <h1 class="mt-0 mb-1">News</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </nav>
                <img class="position-absolute card-decor animate-5" src="{{ asset('front-end/img/in-avo-4-decor-1.svg') }}" alt="decor" style="top: 25%; left: 5%;">
                <img class="position-absolute card-decor animate-6" src="{{ asset('front-end/img/in-avo-4-decor-2.svg') }}" alt="decor" style="top: -22%; left: 30%;">
                <img class="position-absolute card-decor animate-7" src="{{ asset('front-end/img/in-avo-4-decor-3.svg') }}" alt="decor" style="top: -16%; left: 72%;">
                <img class="position-absolute card-decor animate-6" src="{{ asset('front-end/img/in-avo-4-decor-4.svg') }}" alt="decor" style="top: 89%; left: 94%;">

            </div>
        </div>
    </div>
</section>
<!-- breadcrumb content end -->
<main>
    <!-- section content begin -->
    <section class="py-5 card-style-10">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-9 mb-2 text-center">
                    <h1 class="fw-bold mb-0"><span class="text-highlight">Top</span> Stories</h1>
                    <p>Keep track of what's happening in the crypto and stock markets with our daily news briefs – designed to be read in 20 seconds or less.</p>
                </div>
            </div>
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
                    {
                        "feedMode": "all_symbols",
                        "isTransparent": false,
                        "displayMode": "regular",
                        "width": "1350",
                        "height": "550",
                        "colorTheme": "light",
                        "locale": "en"
                    }
                </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </section>

</main>
@endsection