@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Referral Summary</h4>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">No of referrals</h6>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">{{ count($referrals) }} investors</h6>
                    </div>
                </div>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Total Referral Commission</h6>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">{{config('app.currency') . number_format(me()->account->total_referral_commission) ?? '$0.00' }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1">Copy referral link</h4>
                    <!-- <p class="text-muted mb-1">Your data status</p> -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="preview-list">

                            <div class="preview-item border-bottom">
                                <a
                                    href="{{ generateReferralLink(auth()->user()) }}">{{ generateReferralLink(auth()->user()) }}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">My Referrals</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> S/N </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Registered On </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($referrals as $index => $referral)
                            <tr>
                                <td>
                                    <!-- <img src="assets/images/faces/face1.jpg" alt="image" /> -->
                                    <span class="pl-2">{{$index}}</span>
                                </td>
                                <td> {{ $referral->name ?? '' }} </td>
                                <td> {{ $referral->email ?? '' }} </td>
                                <td>{{ $referral->created_at->diffForHumans() ?? '' }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($referrals->isEmpty())
                    <h4 class="mt-5"><i> No record found</i></h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection