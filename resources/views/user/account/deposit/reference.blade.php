@extends('layouts.dashboard')
@section('content')
@include('layouts.includes.account-summary')


<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            @include('layouts.includes.alert')

            <div class="card-body">
                <!-- <h4 class="card-title">Payment Reference*</h4> -->
                <h4>{{session('message') ?? 'Deposit Request Recieved!'}}</h4>

                <p class="card-description">Follow the steps below to complete ypur deposit<br> 1.
                    copy the <strong>{{ $deposit->companyWallet->coin }} </strong>wallet address below
                    and deposit the sum of <strong>${{ $deposit->amount ?? '' }}</strong>
                    <br>2. After deposit, copy transaction referrence and
                    enter in the input box below. <br> 3. Submit the transaction referrence <br> <strong>You will be notified once your investment is activated</strong>
                </p>
                <span class="badge badge-lg btn-theme" style="background-color: #0C1A32; font-size:16px">Deposit Address: {{ $walletAddress ?? '' }}</span>

                <form class="form" action="/deposits/{{$deposit->id}}/reference" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputUsername1" class="col-sm-3 col-form-label">Transaction Hash:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter your transaction reference" name="reference" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="/deposits/{{$deposit->id}}/cancel" type="button" class="btn btn-primary mr-2">Cancel deposit</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection