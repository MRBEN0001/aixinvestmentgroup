@extends('layouts.guest')
@section('content')
<section class="section-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12 position-relative text-center">
                <h1 class="mt-0 mb-1">Our Monthly Data</h1>
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
                    <h1 class="fw-bold mb-0"><span class="text-highlight">Monthly</span> Data</h1>
                    <p class="lead text-muted mt-0">We priotize transparency</p>
                    <p>{{config('app.name')}} provides each investor with a monthly report which includes in-depth personalized investment information. This information makes it easy for investors to keep track of their progress and make informed decisions in order to reach their financial goals with the {{config('app.name')}} Project.

                        The monthly report includes metrics such as compound projections, total earned, deposit/withdraw statistics, and more. All categories include both personalized and global (entirety of {{config('app.name')}} Project) statistics.

                        As well as this, there is also simple personalized live-updating data in our application. This data includes total deposited, total earned, and a history of investment box purchases and refunds.</p>
                </div>
            </div>
            <!-- <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2 g-lg-3">
                <div class="col">
                    <div class="card card-green">
                        <div class="card-body p-3">
                            <div class="icon-wrap rounded-circle flex-shrink-0">
                                <i class="fas fa-seedling fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mt-4">
                                <a href="#" class="link-light text-decoration-none d-flex justify-content-between align-items-center">
                                    Investing
                                    <i class="fas fa-arrow-right fa-xs"></i>
                                </a>
                            </h5>
                            <hr>
                            <p class="text-white small">A wide selection of investment product to help build diversified portfolio</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-blue">
                        <div class="card-body p-3">
                            <div class="icon-wrap rounded-circle flex-shrink-0">
                                <i class="fas fa-chart-bar fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mt-4">
                                <a href="#" class="link-light text-decoration-none d-flex justify-content-between align-items-center">
                                    Trading
                                    <i class="fas fa-arrow-right fa-xs"></i>
                                </a>
                            </h5>
                            <hr>
                            <p class="text-white small">Powerful trading tools, resources, insight and support</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-purple">
                        <div class="card-body p-3">
                            <div class="icon-wrap rounded-circle flex-shrink-0">
                                <i class="fas fa-chart-pie fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mt-4">
                                <a href="#" class="link-light text-decoration-none d-flex justify-content-between align-items-center">
                                    Wealth management
                                    <i class="fas fa-arrow-right fa-xs"></i>
                                </a>
                            </h5>
                            <hr>
                            <p class="text-white small">Dedicated financial consultant to help reach your own specific goals</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-navy">
                        <div class="card-body p-3">
                            <div class="icon-wrap rounded-circle flex-shrink-0">
                                <i class="fas fa-chalkboard-teacher fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mt-4">
                                <a href="#" class="link-light text-decoration-none d-flex justify-content-between align-items-center">
                                    Investment advisory
                                    <i class="fas fa-arrow-right fa-xs"></i>
                                </a>
                            </h5>
                            <hr>
                            <p class="text-white small">A wide selection of investing strategies from seasoned portfolio managers</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-grey">
                        <div class="card-body p-3">
                            <div class="icon-wrap rounded-circle flex-shrink-0">
                                <i class="fas fa-funnel-dollar fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mt-4">
                                <a href="#" class="link-light text-decoration-none d-flex justify-content-between align-items-center">
                                    Smart portfolio
                                    <i class="fas fa-arrow-right fa-xs"></i>
                                </a>
                            </h5>
                            <hr>
                            <p class="text-white small">A revolutionary, fully-automated investmend advisory services</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-orange">
                        <div class="card-body p-3">
                            <div class="icon-wrap rounded-circle flex-shrink-0">
                                <i class="fas fa-handshake fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mt-4">
                                <a href="#" class="link-light text-decoration-none d-flex justify-content-between align-items-center">
                                    Mutual fund advisor
                                    <i class="fas fa-arrow-right fa-xs"></i>
                                </a>
                            </h5>
                            <hr>
                            <p class="text-white small">Specialized guidance from independent local advisor for hight-worth investors</p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>

</main>
@endsection