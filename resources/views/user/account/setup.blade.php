@extends('layouts.dashboard')
@section('content')
@include('layouts.includes.account-summary')

<div class="row">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Wallet Addresses*</h4>
        <p class="card-description" id="card-description"> We require you setup your wallet addresses</p>
        <form action="/account" class="forms-sample" method="post" id="walletForm">
          @csrf
          @forelse ($companyWallets as $companyWallet)
          <div class="form-group">
            <label for="wallet_{{ $companyWallet->id }}">{{ $companyWallet->coin }} :</label>
            <input type="text" class="form-control wallet-input" id="wallet_{{ $companyWallet->id }}" placeholder="Enter address" name="{{ $companyWallet->id }}">
          </div>
          @empty
          <h6>Please contact admin if you are having problem setting up your wallets</h6>
          @endforelse
          @if (count($companyWallets) > 0)
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  document.getElementById('walletForm').addEventListener('submit', function(e) {
    const inputs = document.querySelectorAll('.wallet-input');
    let isAnyFieldFilled = false;

    // Check if at least one input field has a value
    inputs.forEach(input => {
      if (input.value.trim() !== '') {
        isAnyFieldFilled = true;
      }
    });

    if (!isAnyFieldFilled) {
      e.preventDefault(); // Prevent form submission
      $("#card-description")
        .text("Please fill in at least one wallet address before submitting the form.");
    }
  });
</script>
@endsection