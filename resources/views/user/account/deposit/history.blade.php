@extends('layouts.dashboard')
@section('content')

<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @include('layouts.includes.alert')
                <h4 class="card-title">Deposit History</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> S/N </th>
                                <th> Wallet </th>
                                <th> Amount </th>
                                <th> Hash </th>
                                <th> Date </th>
                                <th> Payment Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deposits as $index => $deposit)
                            <tr>
                                <td>
                                    <!-- <img src="assets/images/faces/face1.jpg" alt="image" /> -->
                                    <span class="pl-2">{{$index}}</span>
                                </td>
                                <td> {{$deposit->companyWallet->coin}} </td>
                                <td> {{config('app.currency').number_format($deposit->amount)}} </td>
                                <td> {{$deposit->reference}} </td>
                                <td> {{$deposit->created_at->diffForHumans()}} </td>
                                <td>
                                    @if($deposit->status == 'approved')
                                    <div class="badge badge-outline-success">Approved</div>
                                    @elseif($deposit->status == 'pending')
                                    <div class="badge badge-outline-warning">Pending</div>
                                    @elseif($deposit->status == 'declined')
                                    <div class="badge badge-outline-danger">Declined</div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($deposits->isEmpty())
                    <h4 class="mt-5"><i> No Record Found</i></h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection