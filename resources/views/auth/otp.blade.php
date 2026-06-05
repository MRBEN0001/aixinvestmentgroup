@extends('layouts.guest')

@section('content')
    <div class="bw_main_body">
        <div data-scroll class="page">
            <main>
                <div class="bw_content">
                    <!-- start_bw_otp_page_section -->
                    <section class="bw_login_page_section">
                        <div class="bw_container">
                            <div class="bw_login_page_wrap" data-aos="zoom-in" data-aos-duration="1000">
                                <div class="bw_regisiter_wrap active">
                                    <h3 class="bw_sub_title">Verify OTP</h3>

                                    <form method="POST" action="{{ route('otp.verify.submit') }}">
                                        @csrf

                                        <input class="bw_custom_input" placeholder="Enter OTP" id="otp" type="text"
                                            name="otp" required autofocus>
                                        @error('otp')
                                            <div style="color: red;" class="mt-1">{{ $message }}</div>
                                        @enderror

                                        <button class="btn btn-primary bw_custom_buttom" type="submit">Verify</button>

                                        <p class="mt-3">Didn't get the OTP? <a href="{{ route('otp.resend') }}" class="bw_register_click">Resend OTP</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- close_bw_otp_page_section -->
                </div>
            </main>
        </div>
    </div>
@endsection
