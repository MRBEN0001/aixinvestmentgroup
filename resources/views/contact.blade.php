@extends('layouts.guest')
@section('title', 'Contact')

@section('content')



<section class="contact">
    <div class="container">
        <div class="row">
         
            <div class="col-xs-12 col-md-8 contact-form">
                <h3 class="col-xs-12">feel free to leave us a message</h3>
                <p class="col-xs-12">Need to speak to us? Do you have any queries or suggestions? Please contact us about all enquiries including membership and volunteer work using the form below.</p>
                <!-- Contact Form Starts -->
                

 

<!-- Display Success Message -->




<form class="form-contact" method="POST" action=" {{ route('contact.submit') }} ">
    @csrf
      <!-- Form Submit Message Starts -->
      <div class="col-xs-12 text-center output_message_holder d-none">
        <p class="output_message"></p>
    </div>
    <!-- Input Field Starts -->
    <div class="form-group col-md-6">
        <input class="form-control" name="firstname" id="firstname" placeholder="FIRST NAME" type="text" required>
    </div>
    <!-- Input Field Ends -->
    <!-- Input Field Starts -->
    <div class="form-group col-md-6">
        <input class="form-control" name="lastname" id="lastname" placeholder="LAST NAME" type="text" required>
    </div>
    <!-- Input Field Ends -->
    <!-- Input Field Starts -->
    <div class="form-group col-md-6">
        <input class="form-control" name="email" id="email" placeholder="EMAIL" type="email" required>
    </div>
    <!-- Input Field Ends -->
    <!-- Input Field Starts -->
    <div class="form-group col-md-6">
        <input class="form-control" name="subject" id="subject" placeholder="SUBJECT" type="text" required>
    </div>
    <!-- Input Field Ends -->
    <!-- Input Field Starts -->
    <div class="form-group col-xs-12">
        <textarea class="form-control" id="message" name="message" placeholder="MESSAGE" required></textarea>
    </div>
    <!-- Input Field Ends -->
    <!-- Submit Form Button Starts -->
    <div class="form-group col-xs-12 col-sm-4">
        <button class="btn btn-primary btn-contact" type="submit">send message</button>
    </div>
    <!-- Submit Form Button Ends -->
    <!-- Form Submit Message Starts -->
    <div class="col-xs-12 text-center output_message_holder d-none">
        <p class="output_message"></p>
    </div>
     <!-- Form Submit Message Ends -->
</form>


                
                <!-- Contact Form Ends -->
            </div>
            <!-- Contact Widget Starts -->
            <div class="col-xs-12 col-md-4">
                <div class="widget">
                    <div class="contact-page-info">
                        <!-- Contact Info Box Starts -->
                        <div class="contact-info-box">
                            <i class="fa fa-home big-icon"></i>
                            <div class="contact-info-box-content">
                                <h4>Address</h4>
                                <p>Zürich, Switzerland</p>
                            </div>
                        </div>
                        <!-- Contact Info Box Ends -->
                        <!-- Contact Info Box Starts -->
                    
                        <!-- Contact Info Box Ends -->
                        <!-- Contact Info Box Starts -->
                        <div class="contact-info-box">
                            <i class="fa fa-envelope big-icon"></i>
                            <div class="contact-info-box-content">
                                <h4>Email Addresses</h4>

                                <p>
                                    {{ config('app.email') }}
                                </p>
                            </div>
                        </div>
                        <!-- Contact Info Box Ends -->
                        <!-- Social Media Icons Starts -->
                        <div class="contact-info-box">
                            <i class="fa fa-share-alt big-icon"></i>
                            <div class="contact-info-box-content">
                                <h4>Social Profiles</h4>
                                <div class="social-contact">
                                    <ul>
                                        <li class="facebook"><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li class="twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        {{-- <li class="google-plus"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Social Media Icons Starts -->
                    </div>
                </div>
            </div>
            <!-- Contact Widget Ends -->
        </div>
    </div>
</section>
<!-- Contact Section Ends -->
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
                    <p class="action-btn"><a class="btn btn-primary" href=" {{ route('register') }} ">Register Now</a></p>
                    <!-- Call To Action Button Ends -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Call To Action Section Ends -->
<!-- Footer Starts -->





@endsection

