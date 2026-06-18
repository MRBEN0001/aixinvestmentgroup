@extends('layouts.guest')
@section('content')
<section class="section-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12 position-relative text-center">
                <h1 class="mt-0 mb-1">Market information</h1>
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
                    <h1 class="fw-bold mb-0"><span class="text-highlight">Investment</span> Information</h1>
                    <p class="lead text-muted mt-0">We priotize transparency</p>
                    <p style="text-align: justify;">Funds invested into the {{config('app.name')}} platform are periodically moved into our ByBit centralized exchange spot accounts. The funds are then moved into an array of sub accounts where both our automated and manual strategies are run cohesively on multiple USDT pairs. All exchange accounts are monitored around the clock by individuals who are professionally trained on how to respond to any emergency scenarios.

                        A large part of {{config('app.name')}}’s success is: although we incorporate automated strategies into our investment ecosystem, everything is manually managed. What this means is we consistently re-allocate funds manually based on a number of checks and metrics. Managing the funds in this fashion has delivered amazing results consistently since the very start of our live trading period.</p>
                </div>
            </div>
         
        </div>
    </section>
    <!-- section content end -->
    <!-- section content begin -->
    <section class="py-4">
        <div class="container">
            <div class="row gy-md-2 gx-0 gx-lg-4">
                <div class="col-md-12 col-lg-8">
                    <div class="col d-md-flex d-lg-flex align-items-start">
                        <div class="mb-2 mb-mb-0 mb-lg-0 me-3 icon-wrap icon-wrap-large bg-primary rounded-circle flex-shrink-0">
                            <i class="fas fa-money-bill-wave fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h3>Why trade with {{config('app.name')}}?</h3>
                            <p>The {{config('app.name')}} system is built on Binance Smart Chain. All actions are performed through smart contracts which enhances the security of our platform. More on this is detailed further on in this document in the Security page.</p>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 mt-3 mb-3 mb-md-0 mb-lg-0">
                                <div class="col">
                                    <ul class="fa-ul lh-lg">
                                        <li><span class="fa-li"><i class="fas fa-check-square text-primary"></i></span>BTCUSDT</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square text-primary"></i></span>ETHUSDT</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square text-primary"></i></span>ATOMUSDT</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square text-primary"></i></span>SOLUSDT</li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <ul class="fa-ul lh-lg">
                                        <li><span class="fa-li"><i class="fas fa-check-square text-primary"></i></span>APEUSDT </li>
                                        <li><span class="fa-li"><i class="fas fa-check-square text-primary"></i></span>1000PEPEUSDT</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square text-primary"></i></span>CXRPUSDT</li>
                                        <li><span class="fa-li"><i class="fas fa-check-square text-primary"></i></span>ADAUSDT</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <h4>Our Shares offer</h4>
                    <table class="table table-striped mt-n1 mb-2">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Initial Deposit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">Apple Inc CFD</td>
                                <td class="text-center">10%</td>
                            </tr>
                            <tr>
                                <td class="text-center">Alibaba CFD</td>
                                <td class="text-center">15%</td>
                            </tr>
                            <tr>
                                <td class="text-center">Facebook CFD</td>
                                <td class="text-center">25%</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="#" class="link-primary text-decoration-none"><small>See Full Shares Table<i class="fas fa-arrow-right ms-1"></i></small></a>
                </div>
            </div>
        </div>
    </section>
    <!-- section content end -->
    <!-- section content begin -->
    <section class="py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-9 mb-2 text-center">
                    <h1 class="fw-bold mb-0">A <span class="text-highlight">Investment</span> Information</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body d-lg-flex justify-content-between align-items-center p-4">
                            <h4 class="fw-bold mb-0">Multiple automated strategies used on BTCUSDT pair. Manual management. Manual positions placed.</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body d-lg-flex justify-content-between align-items-center p-4">
                            <h4 class="fw-bold mb-0">Multiple automated strategies used on ETHUSDT pair. Manual management. Manual positions placed.</h4>
                            <!-- <a class="btn btn-primary rounded-pill mt-2 mt-lg-0" href="#">Open an Account<i class="fas fa-arrow-right fa-sm ms-1"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body d-lg-flex justify-content-between align-items-center p-4">
                            <h4 class="fw-bold mb-0">Multiple automated strategies placed on ATOMUSDT. Manual management. Manual positions placed.</h4>
                            <!-- <a class="btn btn-primary rounded-pill mt-2 mt-lg-0" href="#">Open an Account<i class="fas fa-arrow-right fa-sm ms-1"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body d-lg-flex justify-content-between align-items-center p-4">
                            <h4 class="fw-bold mb-0">Multiple automated strategies placed on SOLUSDT. Manual management. Manual positions placed.</h4>
                            <!-- <a class="btn btn-primary rounded-pill mt-2 mt-lg-0" href="#">Open an Account<i class="fas fa-arrow-right fa-sm ms-1"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body d-lg-flex justify-content-between align-items-center p-4">
                            <h4 class="fw-bold mb-0">Multiple automated strategies placed on SOLUSDT. Manual management. Manual positions placed.</h4>
                            <!-- <a class="btn btn-primary rounded-pill mt-2 mt-lg-0" href="#">Open an Account<i class="fas fa-arrow-right fa-sm ms-1"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body d-lg-flex justify-content-between align-items-center p-4">
                            <h4 class="fw-bold mb-0">1000PEPEUSDT manually traded - low risk.</h4>
                            <!-- <a class="btn btn-primary rounded-pill mt-2 mt-lg-0" href="#">Open an Account<i class="fas fa-arrow-right fa-sm ms-1"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body d-lg-flex justify-content-between align-items-center p-4">
                            <h4 class="fw-bold mb-0">APEUSDT manually traded - low risk</h4>
                            <!-- <a class="btn btn-primary rounded-pill mt-2 mt-lg-0" href="#">Open an Account<i class="fas fa-arrow-right fa-sm ms-1"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body d-lg-flex justify-content-between align-items-center p-4">
                            <h4 class="fw-bold mb-0">XRPUSDT automated strategies only. Monitored and rarely manually managed.</h4>
                            <!-- <a class="btn btn-primary rounded-pill mt-2 mt-lg-0" href="#">Open an Account<i class="fas fa-arrow-right fa-sm ms-1"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <a class="btn btn-primary rounded-pill mt-2 mt-lg-0" href="/register">Open an Account<i class="fas fa-arrow-right fa-sm ms-1"></i></a>
            </div>
        </div>
    </section>
    <!-- section content end -->
</main>
@endsection