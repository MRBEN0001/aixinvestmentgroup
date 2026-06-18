@extends('layouts.dashboard')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        @include('layouts.includes.alert')
        <div class="card-body">
            <h4 class="card-title">Withdraw History</h4>
            </p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> S/N </th>
                            <th> Coin </th>
                            <th> Amount </th>
                            <th> Status </th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawals as $index => $withdrawal)
                        <tr>
                            <td>
                                <!-- <img src="assets/images/faces/face1.jpg" alt="image" /> -->
                                <span class="pl-2">{{$index}}</span>
                            </td>
                            <td> {{$withdrawal->companyWallet->coin}} </td>
                            <td> {{config('app.currency').number_format($withdrawal->amount)}} </td>
                            <td>
                                @if(strtolower($withdrawal->status) == 'approaved')
                                <div class="badge badge-outline-success">Approved</div>
                                @elseif(strtolower($withdrawal->status) == 'pending')
                                <div class="badge badge-outline-warning">Pending</div>
                                @elseif(strtolower($withdrawal->status) == 'declined')
                                <div class="badge badge-outline-danger">Declined</div>
                                @endif
                            </td>
                            <td> {{$withdrawal->created_at->diffForHumans()}} </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($withdrawals->isEmpty())
                <h4 class="mt-5"><i> No Record Found</i></h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection