@extends('layouts.auth')
@section('content')
<div class="form-container">
    <div>
        <!-- Section Title Starts -->
        <div class="row text-center">
            <h2 class="title-head hidden-xs">Reset<span>Password</span></h2>
            <p class="info-form">Enter your email address for password reset</p>
        </div>
        <!-- Section Title Ends -->
        <!-- Form Starts -->
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <!-- Input Field Starts -->
            <div class="form-group">
                <input type="hidden" name="token" value="{{ $request->route('token') }}">            
            </div>
            <!-- Input Field Starts -->
            <div class="form-group">
                <input id="username" name="email" height="50px" type="email" class="form-control" placeholder="Email" aria-label="Email">          
            
                @error('email')
                                <div class="alert text-danger">{{ $message }}!!</div>
                                @enderror
            </div>
            
             <!-- Input Field Starts -->
            <div class="form-group">
                <input id="password" type="password" name="password" height="50px" class="form-control" placeholder="New Password" aria-label="Password">           
             </div>

             <!-- Input Field Starts -->
            <div class="form-group">
                <input id="password" type="password" height="50px" name="password_confirmation" class="form-control" placeholder="Confirm Password" aria-label="Password">        
                @error('password')
                <div class="alert text-danger">{{ $message }}!!</div>
                @enderror

            </div>
          
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>

            
            <!-- Submit Form Button Ends -->
        </form>
        <!-- Form Ends -->
    </div>
</div>
@endsection