@extends('layouts.guest')
@section('content')
    <!-- close_bw_header -->

    <div class="bw_main_body">
        <div data-scroll class="page">
            <main>
                <div class="bw_content">

                    <!-- start_bw_login_page_section -->
                    <section class="bw_login_page_section">
                        <div class="bw_container">
                            <div class="bw_login_page_wrap" data-aos="zoom-in" data-aos-duration="1000">
                                <div class="bw_regisiter_wrap active">
                                    <h3 class="bw_sub_title">Login</h3>
                                    {{-- <p class="bw_dec_title">We denounce with righteous indignation and dislike men who are
                                        so beguiled</p> --}}
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                      

                                        <input class="bw_custom_input" placeholder="E-mail" id="email" type="email"
                                            name="email" :value="old('email')" required>
                                            @error('email')
                                            <div style="color: red;" class="mt-1">{{ $message }}</div>
    
                                            @enderror


                                        <input class="bw_custom_input" placeholder="Password" id="password" type="password"
                                            name="password" autocomplete="current-password" required>
                                            @error('password')
                                            <div style="color: red;" class="mt-1">{{ $message }}</div>
    
                                            @enderror


{{-- 
                                        <p class="bw_pass_dec">The password should be at least eight characters long. To
                                            make it stronger, use upper and lower case letters, numbers, and symbols like !
                                            " ? $ % ^ & )</p> --}}


                                        <button class="btn btn-primary bw_custom_buttom" type="submit">Login</button>

                                        <p>Don’t have an account? <a href="{{route('register')}}" class="bw_register_click">Register</a></p>
                                        <p>Forgot your password? <a href="{{ route('password.request') }}" class="bw_register_click">Forgot Password</a></p>

                                      

                                    </form>
                                </div>

                            </div>
                        </div>
                    </section>
                    <!-- close_bw_login_page_section -->

                </div>
            </main>
        </div>
    </div>
@endsection