@extends('layouts.auth')
@section('content')
<div class="form-container">
    <div>
        <!-- Section Title Starts -->
        <div class="row text-center">
            <h2 class="title-head hidden-xs">member <span>login</span></h2>
        </div>
        <!-- Section Title Ends -->
        <!-- Form Starts -->
        <form method="post" action="/login">
            @csrf
            <!-- Input Field Starts -->
            <div class="form-group">
                <input class="form-control" name="email" id="email" placeholder="EMAIL" type="email" required>
            </div>
            <!-- Input Field Ends -->
            <!-- Input Field Starts -->
            <div class="form-group">
                <input class="form-control" name="password" id="password" placeholder="PASSWORD" type="password" required>
            </div>
            <!-- Input Field Ends -->
            <!-- Submit Form Button Starts -->
            <div class="form-group">
                <button class="btn btn-primary" type="submit">login</button>
                <p class="text-center">don't have an account ? <a href="/register">register now</a>
                    <p class="text-center">forgot your password ? <a href="{{ route('password.request') }}">reset now</a>
                    </div>
            <!-- Submit Form Button Ends -->
        </form>
        <!-- Form Ends -->
    </div>
</div>
@endsection