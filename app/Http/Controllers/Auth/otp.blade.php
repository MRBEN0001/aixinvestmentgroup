<!-- resources/views/auth/otp.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Enter OTP') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('otp.verify.submit') }}">
                        @csrf

                        <div class="form-group">
                            <label for="otp" class="col-form-label">{{ __('OTP') }}</label>
                            <input type="text" id="otp" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autofocus>

                            @error('otp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Verify OTP') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
