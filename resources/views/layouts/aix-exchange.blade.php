<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AIX Exchange | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <style>
        body.aix-exchange-shell .content-wrapper,
        body.aix-exchange-shell .main-panel {
            background: #0b0f14;
        }

        body.aix-exchange-shell .table {
            --bs-table-bg: transparent;
            --bs-table-color: #f8fafc;
            --bs-table-border-color: rgba(255, 255, 255, 0.08);
            --bs-table-hover-bg: rgba(255, 255, 255, 0.03);
            background-color: transparent !important;
        }

        body.aix-exchange-shell .table > :not(caption) > * > * {
            background-color: transparent !important;
            box-shadow: none !important;
            color: inherit;
        }
    </style>
    @include('partials.jivo-chat')
</head>
<body class="aix-exchange-shell">
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="{{ route('aix.exchange') }}">
                    <h4 style="color: #b08361;">AIX EXCHANGE</h4>
                </a>
                <a class="sidebar-brand brand-logo-mini" href="{{ route('aix.exchange') }}">
                    <img src="{{ asset('assets/images/smart-wealth.png') }}" alt="logo" />
                </a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face15.jpg') }}" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal">{{ me()->name ?? '' }}</h5>
                                <span>Exchange</span>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item nav-category">
                    <span class="nav-link">Exchange</span>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link {{ request()->routeIs('aix.exchange') ? 'active' : '' }}" href="{{ route('aix.exchange') }}">
                        <span class="menu-icon">
                            <i class="mdi mdi-chart-timeline-variant"></i>
                        </span>
                        <span class="menu-title">Home</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link {{ request()->routeIs('aix.exchange.assets') ? 'active' : '' }}" href="{{ route('aix.exchange.assets') }}">
                        <span class="menu-icon">
                            <i class="mdi mdi-wallet"></i>
                        </span>
                        <span class="menu-title">My Assets</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link {{ request()->routeIs('aix.exchange.withdrawal') ? 'active' : '' }}" href="{{ route('aix.exchange.withdrawal') }}">
                        <span class="menu-icon">
                            <i class="mdi mdi-cash"></i>
                        </span>
                        <span class="menu-title">Withdrawal</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link {{ request()->routeIs('aix.exchange.trade-password') ? 'active' : '' }}" href="{{ route('aix.exchange.trade-password') }}">
                        <span class="menu-icon">
                            <i class="mdi mdi-lock"></i>
                        </span>
                        <span class="menu-title">Set Trade Password</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link {{ request()->routeIs('aix.exchange.transactions') ? 'active' : '' }}" href="{{ route('aix.exchange.transactions') }}">
                        <span class="menu-icon">
                            <i class="mdi mdi-swap-horizontal"></i>
                        </span>
                        <span class="menu-title">Transactions</span>
                    </a>
                </li>

                <li class="nav-item nav-category mt-4">
                    <span class="nav-link">Account</span>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{ route('dashboardoverview') }}">
                        <span class="menu-icon">
                            <i class="mdi mdi-arrow-left"></i>
                        </span>
                        <span class="menu-title">Back to Dashboard</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="menu-icon">
                            <i class="mdi mdi-logout"></i>
                        </span>
                        <span class="menu-title">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="{{ route('aix.exchange') }}">
                        <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
                    </a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100"></ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item d-none d-lg-block">
                            <span class="nav-link text-muted">AIX Exchange</span>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ me()->name ?? '' }}</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                <a class="dropdown-item preview-item" href="{{ route('dashboardoverview') }}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-speedometer text-success"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Investment Dashboard</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{ config('app.name') }}</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
