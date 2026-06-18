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
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <!-- Input Field Starts -->
            <div class="form-group">
                <input class="form-control" name="email" id="username" aria-label="Email" placeholder="EMAIL" type="email" required>
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