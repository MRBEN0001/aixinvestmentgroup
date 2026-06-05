<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Tooplate">

    <title>{{config('app.name')}}</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;700&display=swap" rel="stylesheet">

    <link href="{{ asset('dash/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('dash/css/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- <link href="{{ asset('dash/css/apexcharts.css') }}" rel="stylesheet"> -->

    <link href="{{ asset('dash/css/tooplate-mini-finance.css') }}" rel="stylesheet">
    <!--

Tooplate 2135 Mini Finance

https://www.tooplate.com/view/2135-mini-finance

Bootstrap 5 Dashboard Admin Template

-->
</head>

<body>
    <header class="navbar sticky-top flex-md-nowrap">
        <div class="col-md-3 col-lg-3 me-0 px-3 fs-6">
            <a class="navbar-brand" href="">
                <i class="bi-box"></i>
                {{config('app.name')}}
            </a>
        </div>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- <form class="custom-form header-form ms-lg-3 ms-md-3 me-lg-auto me-md-auto order-2 order-lg-0 order-md-0" action="#" method="get" role="form">
            <input class="form-control" name="search" type="text" placeholder="Search" aria-label="Search">
        </form> --}}

        <div class="navbar-nav me-lg-2">
            <div class="nav-item text-nowrap d-flex align-items-center">
                <div class="dropdown ps-3">
                    <a class="nav-link dropdown-toggle text-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="navbarLightDropdownMenuLink">
                        <i class="bi-bell"></i>
                        <span class="position-absolute start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-lg-end notifications-block-wrap bg-white shadow" aria-labelledby="navbarLightDropdownMenuLink">
                        <small>Notifications</small>

                        <li class="notifications-block border-bottom pb-2 mb-2">
                            <a class="dropdown-item d-flex  align-items-center" href="#">
                                <div class="notifications-icon-wrap bg-success">
                                    <i class="notifications-icon bi-check-circle-fill"></i>
                                </div>

                                <div>
                                    <span>Your account has been created successfuly.</span>

                                    {{-- <p>{{me()->created_at->diffForHumans()}}</p> --}}
                                </div>
                            </a>
                        </li>

                        <li class="notifications-block">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="notifications-icon-wrap bg-danger">
                                    <i class="notifications-icon bi-question-circle"></i>
                                </div>

                                <div>
                                    <span>Account verification pending.</span>

                                    {{-- <p>{{me()->updated_at->diffForHumans()}}</p> --}}
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="dropdown ps-1">
                    <a class="nav-link dropdown-toggle text-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-three-dots-vertical"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-social bg-white shadow">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-4">
                                    <a class="dropdown-item text-center" href="{{ route('withdrawal.index') }}">
                                        <i class="custom-block-icon bi-wallet"></i>
                                        <span class="d-block">Withdraw</span>
                                    </a>
                                </div>


                                <div class="col-lg-4 col-md-4 col-4">
                                    <a class="dropdown-item text-center" href="{{ route('transfer.form') }}">
                                        <i class="custom-block-icon bi-send"></i>
                                        <span class="d-block">Transfer</span>
                                    </a>
                                </div>


                                <div class="col-lg-4 col-md-4 col-4">
                                    <a class="dropdown-item text-center" href="/deposit">
                                        <i class="custom-block-icon bi-plus"></i>
                                        <span class="d-block">Add Money</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown px-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (env('APP_LEVEL') === 'local')
                    <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('image/avatar.jpeg') }}" class="profile-image img-fluid" alt="">
                        @else
                        <img src="{{ Auth::user()->profile_image ? asset('vault-bank/public/' . Auth::user()->profile_image) : asset('vault-bank/public/image/avatar.jpeg') }}" class="profile-image img-fluid" alt="">
                        @endif

                        {{-- <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="profile-image img-fluid" alt=""> --}}
                    </a>
                    <ul class="dropdown-menu bg-white shadow">
                        <li>
                            <div class="dropdown-menu-profile-thumb d-flex">
                            @if (env('APP_LEVEL') === 'local')
                            <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('image/avatar.jpeg') }}" class="profile-image img-fluid" alt="">
                                @else
                                <img src="{{ Auth::user()->profile_image ? asset('vault-bank/public/' . Auth::user()->profile_image) : asset('vault-bank/public/image/avatar.jpeg') }}" class="profile-image img-fluid" alt="">
                                @endif

                                {{-- <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="profile-image img-fluid me-3" alt=""> --}}

                                <div class="d-flex flex-column">
                                    <small>{{ Auth::user()->name }}</small>
                                    <a href="#">{{ Auth::user()->email }}</a>
                                </div>
                            </div>
                        </li>

                        <li>
                            <a class="dropdown-item" href="/user/profile">

                                <i class="bi-person me-2"></i>
                                Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="/settings">
                                <i class="bi-gear me-2"></i>
                                Settings
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="help-center.html">
                                <i class="bi-question-circle me-2"></i>
                                Help
                            </a>
                        </li>
                        @if(me()->is_admin)
                        <li>
                            <a class="dropdown-item" href="/admin">
                                <i class="bi-question-circle me-2"></i>
                                Admin Area
                            </a>
                        </li>
                        @endif
                        <li class="border-top mt-3 pt-2 mx-4">
                            <a class="dropdown-item ms-0 me-0" href="{{ route('logout') }}">

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                        <i class="bi-box-arrow-left me-2"></i> {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                                {{-- <i class="bi-box-arrow-left me-2"></i>
                                    Logout --}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-3 d-md-block sidebar collapse">
                <div class="position-sticky py-4 px-3 sidebar-sticky">
                    <ul class="nav flex-column h-100">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/dashboard">
                                <i class="bi-house-fill me-2"></i>
                                Overview
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{route('user_profile')}}">
                        <i class="bi-person me-2"></i>
                        Profile
                        </a>
                        </li> --}}
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{route('wallet')}}">
                                <i class="bi-wallet me-2"></i>
                                My Wallet
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('transactions')}}">
                                <i class="bi-wallet me-2"></i>
                                Transactions
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="/kyc">
                                <i class="bi-file-earmark me-2"></i>
                                Kyc
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('settings')}}">
                                <i class="bi-gear me-2"></i>
                                Settings
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="mailto:{{ config('app.email') }}">
                                <i class="bi-question-circle me-2"></i>
                                Help Center
                            </a>
                        </li>

                        <li class="nav-item featured-box mt-lg-5 mt-4 mb-4">
                            <img src="{{ asset('dash/images/credit-card.png') }}" class="img-fluid" alt="">

                            <a class="btn custom-btn" href="/deposit">Quick Deposit</a>
                        </li>


                        <li class="nav-item border-top mt-auto pt-2">
                            <a class="nav-link" href="#">

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                        <i class="bi-box-arrow-left me-2"></i> {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                                {{-- <i class="bi-box-arrow-left me-2"></i>
                                    Logout --}}
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>


        </div>
    </div>

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('dash/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dash/js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="{{ asset('dash/js/apexcharts.min.js') }}"></script> -->
    <script src="{{ asset('dash/js/custom.js') }}"></script>

    <!-- <script type="text/javascript">
        var options = {
            series: [13, 43, 22],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Balance', 'Expense', 'Credit Loan', ],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
        chart.render();
    </script>

    <script type="text/javascript">
        var options = {
            series: [{
                name: 'Income',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: 'Expense',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
                name: 'Transfer',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script> -->

    @include('partials.jivo-chat')
</body>

</html>
@yield('content')