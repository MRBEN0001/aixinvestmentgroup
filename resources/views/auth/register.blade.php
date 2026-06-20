@extends('layouts.auth')
@section('content')
<div class="form-container">
    <div>
        <!-- Section Title Starts -->
        <div class="row text-center">
            <h2 class="title-head hidden-xs">get <span>started</span></h2>
            {{-- <p class="info-form">Open account for free and start trading Bitcoins now!</p> --}}
        </div>
        <!-- Section Title Ends -->
        <!-- Form Starts -->
        <form method="POST" action="{{ route('register') }}">
            
            @csrf

             <!-- Referral  Input Field Starts -->
             <div class="form-group">
                <input class="form-control" type="hidden" name="referral_code" value="{{ $referralCode }}" id="" placeholder="">
              
            </div>

            <!-- Name Input Field Starts -->
            <div class="form-group">
                <input class="form-control" name="name" id="name" placeholder="NAME" type="text" aria-label="Name" required>
                @error('name')
                <div class="alert text-danger">{{ $message }}!!</div>
                @enderror
            </div>

            <!-- Username Input Field Starts -->
            <div class="form-group">
                <input class="form-control" id="username" name="username" placeholder="USERNAME" type="text" aria-label="Username" required>
                @error('username')
                <div class="alert text-danger">{{ $message }}!!</div>
                @enderror
            </div>
          
            <!-- EmailInput Field Starts -->
            <div class="form-group">
                <input class="form-control" name="email" id="username" placeholder="EMAIL" type="email" aria-label="Email" required>
           
                @error('email')
                <div class="alert text-danger">{{ $message }}!!</div>
                @enderror
            </div>
           
            <!-- Password Input Field Starts -->
            <div class="form-group">
                <input class="form-control" name="password" id="password" placeholder="PASSWORD" type="password" aria-label="Password" required>
              
             @error('password')
            <div class="alert text-danger">{{ $message }}!!</div>
            @enderror
            </div>

             <!-- Match password Input Field Starts -->
             <div class="form-group">
                <input class="form-control" name="password_confirmation" id="password" type="password" placeholder="Confirm Password" aria-label="Password Confirmation" required>
              
            
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="website" style="display:none" autocomplete="off" placeholder="website">              
            
            </div>
            
            <!-- Input Field Ends -->
            <!-- Submit Form Button Starts -->
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Create Account</button>
                <p class="text-center">already have an account ? <a href="{{ route('login')}}">Login</a>
            </div>
            <!-- Submit Form Button Ends -->
        </form>
        <!-- Form Ends -->
    </div>
</div>

@endsection