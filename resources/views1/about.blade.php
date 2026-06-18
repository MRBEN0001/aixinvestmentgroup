@extends('layouts.guest')
@section('content')
<section class="section-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12 position-relative text-center">
                <h1 class="mt-0 mb-1">About</h1>
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
<main>
    <!-- section content begin -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-9 text-center">
                    <h1>{{config('app.name')}} Project <span class="text-highlight">Introduction</span></h1>
                    <p class="lead text-muted" style="text-align: justify;">{{config('app.name')}} Project is a cryptocurrency investment fund which offers a “hands-free” investment solution to those who are invited. Our team offers our asset management expertise and track record in return for a performance fee on any profits generated and a small deposit/withdrawal fee.

                        {{config('app.name')}} started as an experiment in early 2022 after our realization that there was limited talent and expertise in general being applied to the building of high yielding automated strategies for trading cryptocurrencies, with most highly talented and experienced operations going towards developing more slow-yielding and conservative automated strategies. Though the project has grown significantly from this point and we now use both automated and manual trading strategies.

                        {{config('app.name')}} approaches investing in a different way to most teams. With our “ecosystem” investment approach.

                        This means we pool investments into an ecosystem of completely different cryptocurrency trading strategies as well as venture capital and liquidity farming. What we mean by ecosystem is each of these strategies complement each other in a hedging fashion and have their own place in the “ecosystem”. Thus providing increased sustainability and security.

                        After months of testing and development, we moved into our beta phase in early 2023 and have since achieved over 12 months straight of live market trading with an average profit per month of 25%.

                        {{config('app.name')}} Project currently remains in the pre-launch phase, and will be officially launching in mid 2024.</p>
                </div>
               
                <div class="col-12 mt-3">
                <div class="row justify-content-center mb-3">
                    <img src="/images/cert.jpg" style="height: 950px; width: 1000px; opacity: 0.5; background: #DB2F69;" alt="">
                </div>
                    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 gy-2 gy-md-2 gx-0 gx-md-2 gx-lg-4">
                        <div class="col d-flex align-items-start">
                            <div class="icon-wrap bg-primary rounded-circle flex-shrink-0 me-2">
                                <i class="fas fa-leaf fa-lg text-primary"></i>
                            </div>
                            <div>
                                <h3 class="h4">A proven track record that speaks for itself</h3>
                                <p class="mb-0">With over 12 months straight of profitable history of 25%+ per month, and hundreds of hours of testing before we built {{config('app.name')}}, we are prepared for any and all market events and conditions.</p>
                            </div>
                        </div>
                        <div class="col d-flex align-items-start">
                            <div class="icon-wrap bg-primary rounded-circle flex-shrink-0 me-2">
                                <i class="fas fa-hourglass-end fa-lg text-primary"></i>
                            </div>
                            <div>
                                <h3 class="h4">Private pool now open</h3>
                                <p class="mb-0">You can invest in our private pool by clicking "Start Earning Now!" in the menu above.</p>
                            </div>
                        </div>
                        <div class="col d-flex align-items-start">
                            <div class="icon-wrap bg-primary rounded-circle flex-shrink-0 me-2">
                                <i class="fas fa-flag fa-lg text-primary"></i>
                            </div>
                            <div>
                                <h3 class="h4">Stay up to date
                                </h3>
                                <p class="mb-0">{{config('app.name')}} provides comprehensive monthly reports to investors on capital growth. These reports include graphs, trade summaries and more data. This means investors can either keep track of their investment through basic statements, or delve deep into how the fund is operating on an advanced level.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section content end -->
    <!-- section content begin -->

    <!-- section content end -->
    <!-- section content begin -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-9">
                    <div class="row row-cols-1 row-cols-lg-2 align-items-center gy-3">
                        <div class="col text-md-center text-lg-start">
                            <h4 class="text-secondary mb-1">Number speaks</h4>
                            <h1>We always ready<br>for a you.</h1>
                            <a href="/register" class="btn btn-primary rounded-pill mt-2">Start Investing<i class="fas fa-arrow-right fa-sm ms-1"></i></a>
                        </div>
                        <div class="col">
                            <div class="row align-items-start gx-0 mb-2 mb-md-4">
                                <div class="col-12 col-md-4 text-md-end border-bottom border-primary">
                                    <h1 class="text-primary">
                                        <span class="count" data-counter-end="410">0</span>
                                    </h1>
                                </div>
                                <div class="col-12 col-md-8 mt-2 mt-md-0 ps-md-4">
                                    <h5>Trading instruments</h5>
                                    <p>We trade +410 instruments</p>
                                </div>
                            </div>
                            <div class="row align-items-start gx-0">
                                <div class="col-12 col-md-4 text-md-end border-bottom border-primary">
                                    <h1 class="text-primary">
                                        <span class="count" data-counter-end="27">0</span>
                                    </h1>
                                </div>
                                <div class="col-12 col-md-8 mt-2 mt-md-0 ps-md-4">
                                    <h5>Countries covered</h5>
                                    <p>We cover +27 countries</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section content end -->
</main>
@endsection