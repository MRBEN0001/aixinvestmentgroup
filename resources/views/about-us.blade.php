@extends('layouts.guest')
@section('title', 'About Us')

@section('content')
<section class="banner-area">
    <div class="banner-overlay">
        <div class="banner-text text-center">
            <div class="container">
                <!-- Section Title Starts -->
                <div class="row text-center">
                    <div class="col-xs-12">
                        <!-- Title Starts -->
                        <h2 class="title-head">About <span>Us</span></h2>
                        <!-- Title Ends -->
                        <hr>
                        <!-- Breadcrumb Starts -->
                        <ul class="breadcrumb">
                            <li><a href="/"> home</a></li>
                            <li>About</li>
                        </ul>
                        <!-- Breadcrumb Ends -->
                    </div>
                </div>
                <!-- Section Title Ends -->
            </div>
        </div>
    </div>
</section>
<!-- Banner Area Starts -->
<!-- About Section Starts -->
<section class="about-page">
    <div class="container">
        <!-- Section Content Starts -->
        <div class="row about-content">
            <!-- Image Starts -->
            <div class="col-sm-12 col-md-5 col-lg-6 text-center">
                <img id="about-us" class="img-responsive img-about-us" src="{{asset('images/about-us.png')}}"
                    alt="about us">
            </div>
            <!-- Image Ends -->
            <!-- Content Starts -->
            <div class="col-sm-12 col-md-7 col-lg-6">
                <div class="feature-about">
                    <h3 class="title-about">WE ARE  {{ Str::upper(config('app.name')) }}
</h3>
                    <p> Zürich, Switzerland based and FINMA regulated
                        crypto company with Funds secured in offline wallets.
                        Fully compliant with IT and money laundering security standards.
                    </p>

                    <div class="col-sm-12 col-md-5 col-lg-6 text-center">
                        <img id="about-us" class="img-responsive img-about-us" src="{{asset('images/certificate-asset-top.jpg')}}"
                            alt="about us">
                            
                    </div>

                </div>
                <div class="feature-about">
                    <br> <br>
                    <p> Here at {{ config('app.name') }}, our goal is to promote the financial status of our clients through our
                        uncompromised financial automated crypto investment software. Our platform
                        is an Award winning crypto company, providing investors 24 hours support towards investing their
                        way to financial freedom.
                        Our team consists of leading experts from traditional finance but also from the crypto industry.
                        This mix makes {{ config('app.name') }} not only unique but also
                        enables the company to bridge the gap between the two worlds, offering investors attractive
                        investment
                        opportunities.

                        A community founded to revolutionize the market of crypto-investors, inserted in this
                        trillionaire
                        market.
                        We constantly act in the best interest of our customers.
                        We challenge the status quo and offer innovative tailor-made solutions.
                        We implement our projects on time and serve our customers beyond that.
                        We behave professionally and treat each other equal with respect and esteem.
                        We stand by our words and take responsibility for every detail.
                        We always strive for the highest quality in the interest of our stakeholders.
                        Be our partner by investing with us and get percentage return on investment.
                        We keep your investment safe and your profit is assured.

                    </p>
                </div>

                <a class="btn btn-primary btn-services" href=" {{ route('plan') }} ">Plan</a>
            </div>
            <!-- Content Ends -->

        </div>
        <!-- Section Content Ends -->
    </div><!--/ Content row end -->
</section>
<!-- About Section Ends -->
<!-- Facts Section Starts -->
<section class="facts">
    <!-- Container Starts -->
    <div class="container">
        <!-- Fact Badges Starts -->
        <div class="row text-center facts-content">
            <div class="text-center heading-facts">
                <h2>Our<span> numbers</span></h2>
                <p></p>
            </div>
            <!-- Fact Badge Item Starts -->
            <div class="col-xs-12 col-md-3 col-sm-6 fact">
                <h3>$3.76B</h3>
                <h4>Payouts</h4>
            </div>
            <!-- Fact Badge Item Ends -->
            <!-- Fact Badge Item Starts -->
            <div class="col-xs-12 col-md-3 col-sm-6 fact fact-clear">
                <h3>243K</h3>
                <h4>daily transactions</h4>
            </div>
            <!-- Fact Badge Item Ends -->
            <!-- Fact Badge Item Starts -->
            <div class="col-xs-12 col-md-3 col-sm-6 fact">
                <h3>369K</h3>
                <h4>active accounts</h4>
            </div>
            <!-- Fact Badge Item Ends -->
            <!-- Fact Badge Item Starts -->
            <div class="col-xs-12 col-md-3 col-sm-6">
                <h3>17</h3>
                <h4>years on the market</h4>
            </div>
            <!-- Fact Badge Item Ends -->
            <div class="col-xs-12 buttons">
                <a class="btn btn-primary btn-pricing" href="{{ route('login') }}">Login</a>
                <span class="or"> or </span>
                <a class="btn btn-primary btn-register" href=" {{ route('register') }} ">Register Now</a>
            </div>
        </div>
        <!-- Fact Badges Ends -->
    </div>
    <!-- Container Ends -->
</section>
<!-- facts Section Ends -->
<!-- Team Section Starts -->

<!-- Team Section Ends -->
<!-- Call To Action Section Starts -->
<section class="call-action-all">
    <div class="call-action-all-overlay">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Call To Action Text Starts -->
                    <div class="action-text">
                        <h2>Get Started Today With crypto investment</h2>
                        <p class="lead">Open account for free and start investing!</p>
                    </div>
                    <!-- Call To Action Text Ends -->
                    <!-- Call To Action Button Starts -->
                    <p class="action-btn"><a class="btn btn-primary" href=" {{ ('register') }} ">Register Now</a></p>
                    <!-- Call To Action Button Ends -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
