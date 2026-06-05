@extends('layouts.user-dashboard')
@section('content')
<main class="main-wrapper col-md-9 ms-sm-auto py-4 col-lg-9 px-md-4 border-start">
    <div class="title-group mb-3">
        <h1 class="h2 mb-0">Wallet</h1>
    </div>

    <div class="row my-4">


        <div class="col-lg-7 col-12">
            @include('layouts.partials.balance-summary')


        </div>

        <div class="col-lg-5 col-12">
            <div class="custom-block custom-block-transations">
                <h5 class="mb-4">Top up USD</h5>

                <a href="/deposit/crypto" class="text-decoration-none text-dark">
                    <div class="d-flex flex-wrap align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('dash/images/profile/senior-man-white-sweater-eyeglasses.png') }}" class="profile-image img-fluid" alt="">

                            <div>
                                <p>
                                    <span>Add via stablecoins</span>
                                </p>

                                <small class="text-muted">Fund your US balance with USDC. Arrives in 1-5 mins</small>
                            </div>
                        </div>
                    </div>
                </a>

                <div class="d-flex flex-wrap align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('dash/images/profile/young-beautiful-woman-pink-warm-sweater.png') }}" class="profile-image img-fluid" alt="">

                        <div>
                            <p>
                                <a href="#">Add via bank transfer</a>
                            </p>

                            <small class="text-muted">Fund your account by sending money to your unique US bank account. Arrives in 1-3 days</small>
                        </div>
                    </div>

                </div>

                <div class="d-flex flex-wrap align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('dash/images/profile/young-woman-with-round-glasses-yellow-sweater.png') }}" class="profile-image img-fluid" alt="">

                        <div>
                            <p><a href="#">Add via conversion</a></p>

                            <small class="text-muted">Conver funds from another balance to your USD balance</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @include('user-dashboard-pages.footer-include')

</main> 
@endsection
