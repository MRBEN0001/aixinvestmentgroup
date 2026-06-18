@extends('layouts.guest')
@section('title', 'Plan')

@section('content')



 <!-- Wrapper Starts -->
 <div class="wrapper">
    <!-- Header Starts -->
  
    <!-- Header Ends -->
    <!-- Banner Area Starts -->
    <section class="banner-area">
        <div class="banner-overlay">
            <div class="banner-text text-center">
                <div class="container">
                    <!-- Section Title Starts -->
                    <div class="row text-center">
                        <div class="col-xs-12">
                            <!-- Title Starts -->
                            <h2 class="title-head">Our <span>plans</span></h2>
                            <!-- Title Ends -->
                            <hr>
                            <!-- Breadcrumb Starts -->
                            <ul class="breadcrumb">
                                <li><a href=" {{ '/' }} "> home</a></li>
                                <li>plan</li>
                            </ul>
                            <!-- Breadcrumb Ends -->
                        </div>
                    </div>
                    <!-- Section Title Ends -->
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area Ends -->
    <!-- Pricing Starts -->
    <section class="pricing">
        <div class="container">
            <!-- Section Content Starts -->
            
            <h3 class="text-center sell-title">ALL OUR PLANS ARE 6 DAYS</h3>
            <p class="text-center">Choose a plan, deposte, wait for 6 days and withdraw.</p>
            <div class="row pricing-tables-content pricing-page">
                <div class="pricing-container">
                    <!-- Pricing Tables Starts --> 
                   
                   <ul class="pricing-list bounce-invert">
                            @foreach ($plans as $plan)
    
                             <li class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
    
                               
                                <ul class="pricing-wrapper">
                                    <!-- Pricing Table #1 Starts -->
                                    <li>
                                        
                                        <header class="pricing-header">
                                            <h2>{{ $plan->percentage_return }}%, daily</h2>
                                            <h2><span>Minimum Investment</span>  <span>${{ $plan->min }}</span></h2>
                                            <h2><span>Maximim Investment</span><span>${{ $plan->max }}</span></h2>
                                            <h2><span> {{$plan->referral_bonus ?? 0}}% Referral Bonus</span> </h2>
                                           <div class="price">
                                            {{-- <span class="currency"><i class="fa fa-dollar"></i></span> --}}
                                            <span class="value">{{ $plan->name }}</span>
                                        </div>
                                        </header>
                                       
                                        <footer class="pricing-footer">
                                            <a href="{{route('login') }}" class="btn btn-primary">Invest Now</a>
                                        </footer>
                                    </li>
                                    <!-- Pricing Table #1 Ends -->
                                </ul>
                            </li>
                        @endforeach
                          
                        </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Ends -->
    <!-- Call To Action Section Starts -->
    <section class="call-action-all">
        <div class="call-action-all-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Call To Action Text Starts -->
                        <div class="action-text">
                            <h2>Start your investment journey today</h2>
                            <p class="lead">Open account for free and deposit!</p>
                        </div>
                        <!-- Call To Action Text Ends -->
                        <!-- Call To Action Button Starts -->
                        <p class="action-btn"><a class="btn btn-primary" href="{{ route('login') }}">Deposite  Now</a></p>
                        <!-- Call To Action Button Ends -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action Section Ends -->
    <!-- Footer Starts -->




@endsection