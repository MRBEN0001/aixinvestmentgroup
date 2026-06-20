@extends('layouts.dashboard')
@section('content')
@include('layouts.includes.account-summary')

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
            <h4 class="card-title">Investment form</h4>

            @include('layouts.includes.alert')
                <form action="/invest" class="forms-sample" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="exampleInputUsername1" placeholder="Enter amount to invest" name="amount" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label" for="plan">Plan</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="plan" name="plan" required>
                                @forelse ($investmentPlans as $investmentPlan)
                                <option value="{{ $investmentPlan->id }}"> {{$investmentPlan->name}}</option>
                                @empty
                                <h4>Contact Admin</h4>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-form-label" for="coin">Select Coin</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="coin" name="coin" required>
                                @forelse ($coins as $coin)
                                <option value="{{ $coin->companyWallet->id }}">
                                    {{ $coin->companyWallet->coin }}
                                </option>
                                @empty
                                <h4>Contact Admin</h4>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection