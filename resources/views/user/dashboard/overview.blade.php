@extends('layouts.dashboard')
@section('content')
@include('layouts.includes.account-summary')
<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Transaction History</h4>
                <?php
                $lastDeposit = me()->deposits()->latest('id')->first();
                $lastWithdrawal = me()->withdrawals()->latest('id')->first();
                ?>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Last Deposit</h6>
                        <p class="text-muted mb-0">{{$lastDeposit?->created_at->diffForHumans()}}</p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">{{$lastDeposit?->amount ?? 'No deposit record'}}</h6>
                    </div>
                </div>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Last Withdrawal</h6>
                        <p class="text-muted mb-0">{{$lastWithdrawal?->created_at->diffForHumans()}}</p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">{{$lastWithdrawal?->amount ?? 'No withdrawal record'}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1">My Assets</h4>
                    <p class="text-muted mb-1">Your data status</p>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="preview-list">
                            @forelse(me()->coins as $index => $coin)
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-primary">
                                        <i class="">{{$index}}</i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">{{$coin->companyWallet->coin ?? ''}}</h6>
                                        <p class="text-muted mb-0">{{$coin->wallet_address ?? ''}}</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">{{$coin->created_at->diffForHumans()}}</p>
                                        <p class="mb-0">{{config('app.currency').number_format($coin->balance)}}</p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <h4>Your assets will apear here</h4>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Revenue</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">$32123</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                        </div>
                        <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Sales</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">$45850</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">+8.3%</p>
                        </div>
                        <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Purchase</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">$2039</h2>
                            <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p>
                        </div>
                        <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
{{-- <div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Investment History</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> S/N </th>
                                <th> Wallet </th>
                                <th> Plan </th>
                                <th> Amount </th>
                                <th> ROI </th>
                                <th>Hash</th>
                                <th> Start Date </th>
                                <th>Next Payment</th>
                                <th>Working Days Paid</th>
                                <th>Last Payment Date</th>
                                <th> Payment Status </th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (me()->activeInvestments() as $index => $investment)
                            <tr>
                                <td>
                                    <!-- <img src="assets/images/faces/face1.jpg" alt="image" /> -->
                                    <span class="pl-2">{{$index}}</span>
                                </td>
                                <td> {{$investment->companyWallet->coin}} </td>
                                <td> {{$investment->plan->name ?? ''}} </td>
                                <td> {{config('app.currency').number_format($investment->amount)}} </td>
                                <td> {{$investment->roi}} </td>
                                <td> {{$investment->reference}} </td>

                                <td> {{$investment->start_date ? $investment->start_date : ''}} </td>
                                <td> {{$investment->next_payment_date ? $investment->next_payment_date : ''}} </td>
                                <td> {{$investment->working_days_paid}} </td>
                                <td> {{$investment->last_payment_date ? $investment->last_payment_date->diffForHumans() : ''}} </td>
                                <td> {{$investment->created_at->diffForHumans()}} </td>

                                <td>
                                    @if($investment->status == investmentStatuses()['active'])
                                    <div class="badge badge-outline-success">Active</div>
                                    @elseif($investment->status == investmentStatuses()['pending'])
                                    <div class="badge badge-outline-pending">Pending</div>
                                    @elseif($investment->status == investmentStatuses()['closed'])
                                    <div class="badge badge-outline-danger">Closed</div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(me()->activeInvestments()->isEmpty())
                    <h4 class="mt-5"><i> You don't have any active investment</i></h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection