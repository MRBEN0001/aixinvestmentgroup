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
                                    {{-- <h3 class="bw_sub_title">Create your account</h3> --}}
                                    <p class="bw_dec_title">
                                        Forgot your password? No problem. Just let us know your email address and we will
                                        email you a password reset link that will allow you to choose a new one.

                                    </p>
                                    {{--
                                    @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                    @if (session('status'))
                                    <div class="d-flex justify-content-center mt-3">
                                        <div class="alert alert-success alert-dismissible fade show w-50 text-center"
                                            role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                    @endif --}}


                                    <form method="POST" action="{{ route('password.store') }}">
                                        @csrf

                                        <!-- Password Reset Token -->
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">


                                        {{-- email --}}
                                        <input class="bw_custom_input" placeholder="E-mail" id="email" type="email"
                                            name="email" :value="old('email', $request->email)" autofocus required>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                        {{-- password --}}
                                        <input class="bw_custom_input" placeholder="Password" id="password" type="password"
                                            name="password" required autocomplete="new-password" required>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                        {{-- confirm password --}}
                                        <input class="bw_custom_input" placeholder="Confirm Password"
                                            id="password_confirmation" type="password" name="password_confirmation" required
                                            autocomplete="new-password" required>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                        <button class="btn btn-primary bw_custom_buttom" type="submit">Reset your password
                                        </button>

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