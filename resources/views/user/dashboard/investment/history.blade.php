@extends('layouts.dashboard')
@section('content')

<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @include('layouts.includes.alert')
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
                            @foreach ($investments as $index => $investment)
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
                    @if($investments->isEmpty())
                    <h4 class="mt-5"><i> No Record Found</i></h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection