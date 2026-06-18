@extends('layouts.dashboard')
@section('content')
@include('layouts.includes.account-summary')

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            @include('layouts.includes.alert')

            <div class="card-body">
                <h4 class="card-title">Withdraw Funds*</h4>
                <form action="/withdraw" class="forms-sample" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputUsername1" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="exampleInputUsername1" placeholder="Enter amount to invest" name="amount" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-form-label" for="category">Select Coin</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="category" name="coin">
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