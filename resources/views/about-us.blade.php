@extends('layouts.guest')
@section('content')

<div class="bw_main_body">
    <div data-scroll class="page">
        <main>
            <div class="bw_content">

                <!-- start_bw_about_hero_section -->
                <section class="bw_about_hero_section bw_padding_y">
                    <div class="bw_container">
                        <div class="bw_about_hero_wrap">
                            <div class="bw_about_hero_images bw_images_cover" data-aos="flip-right" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                <img src="image/bank_img.jpg" alt="">	
                            </div>
                            <div class="bw_about_hero_content">
                                <h3 class="bw_sub_title_2" data-aos="fade-up" data-aos-duration="1500">e-banking plateform</h3>
                                <h2 class="bw_sub_title" data-aos="fade-up" data-aos-duration="1500">About {{ config('app.name') }}</h2>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    {{ config('app.name') }} stands at the forefront of digital banking innovation in the United States. As a fully licensed and regulated U.S. e-bank, we are committed to delivering secure, accessible, and customer-centric financial services. Our cutting-edge platform combines the strength of traditional banking with the flexibility of modern fintech, offering individuals and businesses seamless control over their finances. With a strong presence across all 50 states, {{ config('app.name') }} continues to redefine banking standards—providing trusted solutions, transparent operations, and 24/7 digital access to your money.
                                    </p> 
                                    <p data-aos="fade-up" data-aos-duration="1500">
                                        {{ config('app.name') }} is a next-generation digital banking platform built to simplify and enhance 
                                        the way you manage money. Whether you're handling personal finances or business transactions, 
                                        {{ config('app.name') }} offers secure, intuitive, and efficient banking—anytime, anywhere.
    
                                        </p>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    Our mission is to empower individuals and businesses through technology-driven financial solutions. With a strong focus on innovation, reliability, and user experience, {{ config('app.name') }} is redefining what it means to bank in the modern world.

                                    </p>
                            </div>
                        </div>
                    </div>		
                </section>
                <!-- close_bw_about_hero_section -->

                <!-- start_bw_about_page_section -->
                <section class="bw_about_page_section bw_padding_y">
                    <div class="bw_container">
                        <div class="bw_about_page_wrap">
                            <div class="bw_title_wrap_center">
                                <h3 class="bw_sub_title_2" data-aos="fade-up" data-aos-duration="1500">Bank With Us</h3>
                                <h2 class="bw_sub_title" data-aos="fade-up" data-aos-duration="1500">Growing our customers e-banking experience from <span class="bw_title_gradient">1996 to {{ date('Y') }} </span></h2>
                            </div>
                            <div class="bw_about_page_content" data-aos="zoom-in" data-aos-duration="1500">
                                <canvas id="bw_about_page_charts"></canvas>
                                <script >
                                    var ctx = document.getElementById('bw_about_page_charts').getContext('2d');
                                    var gradient = ctx.createLinearGradient(0, 0, 0, 1000);
                                    gradient.addColorStop(0, 'rgba(247, 251, 164, 0.28)');
                                    gradient.addColorStop(0.7, 'rgba(100, 220, 182, 0.2)');

                                    let gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
                                    gradientStroke.addColorStop(0, '#F7FBA4');
                                    gradientStroke.addColorStop(1, '#64DCB6');

                                    var myChart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: ['0', '1996', '19999', '2002', '2005', '2012', '2018', '2021'],
                                            datasets: [{
                                                backgroundColor: gradient,
                                                label: '',
                                                fill: true,
                                                data: [0, 1, 0.5, 2, 1.5, 3, 2.5, 4],
                                                pointRadius: 5,
                                                pointBorderColor: [
                                                    'rgb(255 255 255)'
                                                    ],
                                                pointBackgroundColor: gradientStroke,
                                                borderWidth: 3,
                                                borderColor: [
                                                    'rgba(247, 251, 164, 1)',
                                                    'rgba(217, 217, 217, 1)'
                                                    ],
                                            }]
                                        },
                                        options: {
                                            display: false,
                                            scales: {
                                                y: {
                                                    display: false,
                                                    beginAtZero: true
                                                },
                                                x: {
                                                    display: false,
                                                    beginAtZero: true
                                                },
                                            },
                                            tension: 0.4,
                                            plugins: {
                                                legend: {
                                                    display: false
                                                }
                                            }
                                        },
                                    });
                                </script>

                            </div>
                        </div>
                    </div>		
                </section>
                <!-- close_bw_about_section -->


                <!-- start_bw_money_section -->
                <section class="bw_money_section bw_padding_y">
                    <div class="bw_container">
                        <div class="bw_money_wrap">

                            <div class="bw_money_content">
                                <h3 class="bw_sub_title_2" data-aos="fade-up" data-aos-duration="1500">Money</h3>
                                <h2 class="bw_sub_title" data-aos="fade-up" data-aos-duration="1500">Transfer & deposite anytime, anywhere</h2>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    At {{ config('app.name') }}, we believe your money should move at your speed. Our secure and fast transfer system allows you to send, receive, and deposit funds globally without delay.

                                </p>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    Manage your finances with complete flexibility. Whether it’s a personal transfer or a business transaction, {{ config('app.name') }} ensures smooth, reliable operations with just a few clicks.

                                    </p>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    Our platform is built on simplicity, speed, and security—giving you full control of your financial life, 24/7.

                                </p>
                            </div>
                            <div class="bw_money_images bw_images_cover" data-aos="flip-right" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                <img src="image/money.png" alt="">	
                            </div>
                        </div>
                    </div>		
                </section>
                <!-- close_bw_money_section -->


                <!-- start_bw_team_slider_section -->
               

                <!-- start_bw_team_popup -->
               
                <!-- close_bw_team_popup -->

                <!-- close_bw_team_slider_section -->


                <!-- start_bw_digitalize_section -->
                <section class="bw_digitalize_section bw_padding_y">
                    <div class="bw_container">
                        <div class="bw_digitalize_wrap">
                            <div class="bw_digitalize_images" data-aos="flip-right" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                <img src="image/mockup_app.png" alt="">
                            </div>
                            <div class="bw_digitalize_content">
                                <h3 class="bw_sub_title_2" data-aos="fade-up" data-aos-duration="1500">Digital Transformation</h3>
                                <h2 class="bw_sub_title" data-aos="fade-up" data-aos-duration="1500">Step Into the Future of Banking with <span class="bw_title_gradient">{{ config('app.name') }}</span></h2>
                                <a data-aos="fade-up" data-aos-duration="1500" class="bw_custom_buttom" href="/register">Bank with Us</a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- close_bw_digitalize_section -->


                <!-- start_bw_testimonial_section -->
                <section class="bw_testimonial_section bw_padding_y">
                    <div class="bw_container">
                        <div class="bw_testimonial_wrap">
                            <div class="bw_testimonial_content">
                                <h3 class="bw_sub_title_2" data-aos="fade-up" data-aos-duration="1500">Testimonial</h3>
                                <h2 class="bw_sub_title" data-aos="fade-up" data-aos-duration="1500">We satisfy Our Customers</h2>
                            </div>
                            <div class="bw_testimonial_slider" data-aos="fade-up" data-aos-duration="1500">
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="bw_testimonial_box">
                                                <p>
                                                    "{{ config('app.name') }} made opening an account so simple and stress-free. Their support
                                                     team is always quick to assist, and I love how easy it is to manage my finances on the app!"
                                                </p>
                                                <div class="bw_testimonial_user">
                                                    <div class="bw_testimonial_user_border">
                                                        <div class="bw_images_cover">
                                                            <img src="{{ asset('image/user.jpg') }}" alt="">
                                                        </div>
                                                    </div>
                                                    <h4><a href="javascript:;">Luise Moore, Teacher.</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="bw_testimonial_box">
                                                <p>
                                                    "I transferred money internationally within minutes — no hidden fees, no hassle. {{ config('app.name') }} truly understands modern banking needs!"
                                                </p>
                                                <div class="bw_testimonial_user">
                                                    <div class="bw_testimonial_user_border">
                                                        <div class="bw_images_cover">
                                                            <img src="{{ asset('image/1.jpeg') }}" alt="">
                                                        </div>
                                                    </div>
                                                    <h4><a href="javascript:;">James L., Freelance Designer.</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="bw_testimonial_box">
                                                <p>
                                                    "The best part about {{ config('app.name') }} is their transparency and customer-first attitude. I've never felt more confident trusting a bank with my savings."
                                                </p>
                                                <div class="bw_testimonial_user">
                                                    <div class="bw_testimonial_user_border">
                                                        <div class="bw_images_cover">
                                                            <img src="{{ asset('image/2.jpeg') }}" alt="">
                                                        </div>
                                                    </div>
                                                    <h4><a href="javascript:;">Sarah M., Entrepreneur.</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- close_bw_testimonial_section -->


                <!-- start_bw_join_contact_section -->
                <section class="bw_join_contact_section bw_padding_y" data-aos="fade-right" data-aos-duration="1500">
                    <div class="bw_container">
                        <div class="bw_join_contact_content">
                            <h2 class="bw_sub_title">Connect your finance with {{ config('app.name') }}</h2>
                            <button>Create Account</button>
                            <svg-path-elements class="line_canvas" id="FIVE" count="25"></svg-path-elements>
                        </div>
                    </div>	
                </section>
                <!-- close_bw_join_contact_section -->


                <!-- start_bw_faq_section -->
                <section class="bw_faq_section bw_padding_y">
                    <div class="bw_container">
                        <div class="bw_faq_wrap">
                            <div class="bw_faq_content bw_title_wrap_center">
                                <h3 class="bw_sub_title_2" data-aos="fade-up" data-aos-duration="1500">FAQ</h3>
                                <h2 class="bw_sub_title" data-aos="fade-up" data-aos-duration="1500">Our FAQ’s</h2>
                            </div>
                            <div class="accordion">
                                <div class="accordion-item" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="accordion-tabs acco-active">
                                        <h5><span class="accordion-title">How do I open  bank account online?.</span><span class="material-symbols-sharp accordion_icon">remove</span></h5>
                                    </div>
                                    <div class="accordion-content">
                                        <p>
                                            You can open an account easily online or by clicking the "Bank with Us" link.
                                        </p>
                                    </div>
                                </div>
                                <div class="accordion-item" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="accordion-tabs">
                                        <h5><span class="accordion-title">How safe is our online banking?</span><span class="material-symbols-sharp accordion_icon">add</span></h5>
                                    </div>
                                    <div class="accordion-content" style="display: none;">
                                        <p>
                                            Our online banking platform uses advanced encryption and multi-factor authentication to ensure your transactions and personal data are secure.
                                        </p>
                                    </div>
                                </div>
                                <div class="accordion-item" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="accordion-tabs">
                                        <h5><span class="accordion-title">How can I reset my online banking password?</span><span class="material-symbols-sharp accordion_icon">add</span></h5>
                                    </div>
                                    <div class="accordion-content" style="display: none;">
                                        <p>
                                            Click "Forgot Password" on the login page and follow the secure verification steps. You can reset it within minutes.
                                        </p>
                                    </div>
                                </div>
                                <div class="accordion-item" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="accordion-tabs">
                                        <h5><span class="accordion-title">How long does it take to process a fund transfer?</span><span class="material-symbols-sharp accordion_icon">add</span></h5>
                                    </div>
                                    <div class="accordion-content" style="display: none;">
                                        <p>
                                            Local transfers are usually instant or completed within a 
                                            few minutes. International transfers may take 1–3 business days depending on the destination.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- close_bw_faq_section -->

            </div>
        </main>
    </div>
</div>
    <!-- start_bw_footer -->





@endsection
