@extends('layouts.user-dashboard')
@section('content')
<main class="main-wrapper col-md-9 ms-sm-auto py-4 col-lg-9 px-md-4 border-start">
    <div class="title-group mb-3">
        <h1 class="h2 mb-0">Overview</h1>

        <small class="text-muted">Hello {{Auth::user()->name }}, welcome back!</small>
    </div>

    {{-- account deactivated  notification alert --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 py-2 px-3" role="alert"
        style="max-width: 500px; width: 100%; font-size: 0.9rem;">
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"
            style="width: 0.75rem; height: 0.75rem; marging-top: 2px;"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3 py-2 px-3" role="alert"
        style="max-width: 500px; width: 100%; font-size: 0.9rem;">
        {{ session('error') }}
        <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"
            style="width: 0.75rem; height: 0.75rem; marging-top: 2px;"></button>
    </div>
    @endif

    {{--
@if (session('success'))
    <div class="d-flex justify-content-center">
        <div class="alert alert-success alert-dismissible fade show mt-3 py-2 px-3" role="alert"
             style="max-width: 500px; width: 100%; font-size: 0.9rem;">
            {{ session('success') }}
    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"
        style="width: 0.75rem; height: 0.75rem; "></button>
    </div>
    </div>
    @endif

    @if (session('error'))
    <div class="d-flex justify-content-center">
        <div class="alert alert-danger alert-dismissible fade show mt-3 py-2 px-3" role="alert"
            style="max-width: 500px; width: 100%; font-size: 0.9rem;">
            {{ session('error') }}
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" aria-label="Close"
                style="width: 0.75rem; height: 0.75rem; marging-top: 2px;"></button>
        </div>
    </div>
    @endif --}}








    <div class="row my-4">
        <div class="col-lg-7 col-12">
            @include('layouts.partials.balance-summary')
            <div class="custom-block custom-block-transations">
                <h5 class="mb-4">Recent Transations</h5>

                {{-- @foreach(me()->transactions->take(3) as $transaction) --}}
                @foreach(me()->transactions->sortByDesc('created_at')->take(3) as $transaction)

                <div class="d-flex flex-wrap align-items-center mb-4">
                    <div class="d-flex align-items-center">

                        <img src="{{ asset('dash/images/profile/transaction.png') }}" class="profile-image img-fluid" alt="">

                        <div>
                            <p>
                                <a href="transation-detail.html">{{ \Illuminate\Support\Str::limit($transaction->description, 25) }}</a>
                            </p>

                            <small class="text-muted">{{$transaction->status}}</small>
                        </div>
                    </div>

                    <div class="ms-auto">
                        <small>{{$transaction->created_at->diffForHumans()}}</small>
                        @php
                        $isNegative = in_array($transaction->transaction_type, ['withdrawal', 'transfer']);
                        $amountClass = $isNegative ? 'text-danger' : 'text-success';
                        @endphp

                        <strong class="d-block {{ $amountClass }}">
                            <span class="me-1">{{ $isNegative ? '-' : '' }}</span>
                            ${{ number_format($transaction->amount, 2) }}
                        </strong>

                    </div>
                </div>
                @endforeach

                <div class="border-top pt-4 mt-4 text-center">
                    <a class="btn custom-btn" href="/transactions">
                        View all transations
                        <i class="bi-arrow-up-right-circle-fill ms-2"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="col-lg-5 col-12">
            <div class="custom-block custom-block-profile-front custom-block-profile text-center bg-white">
                <div class="custom-block-profile-image-wrap mb-4">
                    @if (env('APP_LEVEL') === 'local')
                    <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('image/avatar.jpeg') }}" class="custom-block-profile-image img-fluid" alt="">
                    @else
                    <img src="{{ Auth::user()->profile_image ? asset('vault-bank/public/' . Auth::user()->profile_image) : asset('vault-bank/public/image/avatar.jpeg') }}" class="custom-block-profile-image img-fluid" alt="">
                    @endif

                    <a href="/settings" class="bi-pencil-square custom-block-edit-icon"></a>
                </div>

                <p class="d-flex flex-wrap mb-2">
                    <strong>Name:</strong>

                    <span>{{me()->name ?? ''}}</span>
                </p>

                <p class="d-flex flex-wrap mb-2">
                    <strong>Email:</strong>

                    <a href="#">
                        {{me()->email ?? ''}}
                    </a>
                </p>

                {{-- <p class="d-flex flex-wrap mb-0">
                    <strong>Phone:</strong>

                    <a href="#">
                        {{me()->phone ?? ''}}
                    </a>
                </p> --}}
            </div>

            <div class="custom-block custom-block-bottom d-flex">
                <div class="custom-block-bottom-item">
                    <a href="{{route('withdrawal.index')}}" class="d-flex flex-column">
                        <i class="custom-block-icon bi-wallet"></i>

                        <small>withdraw</small>
                    </a>
                </div>

                <!-- <div class="custom-block-bottom-item">
                    <a href="#" class="d-flex flex-column">
                        <i class="custom-block-icon bi-upc-scan"></i>

                        <small>Send</small>
                    </a>
                </div> -->

                <div class="col-lg-4 col-md-4 col-4">
                    <a class="dropdown-item text-center" href="{{ route('transfer.form') }}">
                        <i class="custom-block-icon bi-send"></i>
                        <small>Transfer</small>
                    </a>
                </div>

                <div class="custom-block-bottom-item">
                    <a href="/deposit" class="d-flex flex-column">
                        <i class="custom-block-icon bi-plus"></i>

                        <small>Add Money</small>
                    </a>
                </div>
            </div>

            <div class="custom-block primary-bg">
                <h5 class="text-white mb-4">Send Money</h5>

                <a href="/deposit">
                    <img src="{{ asset('dash/images/profile/young-woman-with-round-glasses-yellow-sweater1.jpg') }}" class="profile-image img-fluid" alt="">
                </a>

                <a href="/deposit">
                    <img src="{{ asset('dash/images/profile/young-beautiful-woman-pink-warm-sweater1.jpg') }}" class="profile-image img-fluid" alt="">
                </a>

                <a href="/deposit">
                    <img src="{{ asset('dash/images/profile/senior-man-white-sweater-eyeglasses1.jpg') }}" class="profile-image img-fluid" alt="">
                </a>

                <div class="profile-rounded">
                    <a href="/deposit">
                        <i class="profile-rounded-icon bi-plus"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
    
    @include('user-dashboard-pages.footer-include')
</main>


@endsection