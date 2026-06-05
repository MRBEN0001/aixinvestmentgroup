<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.webbytemplate.com/html-templates/css3/urban-bank/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Mar 2025 09:40:37 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Website</title>
    <link rel="icon" href="image/five-icon.png" type="image/gif">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/error.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
{{-- bootstrap css --}}
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <style>
        .bw_custom_buttom {
            text-decoration: none;
            outline: none;
            box-shadow: none;
        }

        .bw_custom_buttom:focus {
            outline: none;
            box-shadow: none;
        }

        li {
            list-style: none;
            /* Removes bullets or dots on li */
        }
    </style>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mixitup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ripples-min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/imask.min.js') }}"></script>


    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments) };
            t = l.createElement(r); t.async = 1; t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "mqqllhuboa");
    </script>

</head>

<body>


    <!-- start_bw_menubar_wrap -->
    <div class="bw_menubar_wrap">

        <div class="bw_container">
            <div class="bw_menubar_content">

                <a class="bw_menubar_close" href="javascript:;">
                    <span class="material-symbols-rounded">close</span>
                </a>
                <ul class="bw_menubar_menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/about-us">About us</a></li>
                    <li><a href="/contact-us">Contact</a></li>
                    <li><a class="bw_custom_buttom" href="{{ route('login') }}">Login</a></li>
                    <li><a class="bw_custom_buttom" href="{{ route('register') }}">Bank with Us</a></li>

                </ul>



            </div>
        </div>
    </div>

    <!-- close_bw_menubar_wrap -->

    <!-- start_bw_header  Desktop view-->
    <header class="bw_header">
        <div class="bw_container">
            <div class="bw_header_contant">
                <div class="bw_header_logo_content">
                    <a href="/" style="width: 250px;"><img src="{{ asset('image/logo.png') }}" alt=""></a>
                </div>
                <ul class="bw_all_menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/about-us">About us</a></li>

                    <li><a href="/contact-us">Contact</a></li>
                </ul>

                <div class="bw_mobile_menu_icon" style="margin-left: auto;">
                    <a href="javascript:;"><span class="material-symbols-outlined">menu</span></a>
                </div>

                <div class="d-flex gap-2" style="display: flex; gap: 20px;">
                    <li><a class="bw_custom_buttom" href="{{ route('login') }}">Login</a></li>
                    <li><a class="bw_custom_buttom" href="{{ route('register') }}">Bank with Us</a></li>
                </div>

            </div>
        </div>
    </header>
    <!-- close_bw_header -->

    @yield('content')



    <!-- start_bw_footer -->
    <footer class="bw_footer">
        <div class="bw_container">
            <div class="bw_footer_main_wrap">
                <div class="bw_footer_mobile_logo">
                    <a href="/"><img src="{{ asset('image/logo.png') }}" alt="Footer_Logo"></a>
                </div>
                <div class="bw_footer_col frist">
                    <div class="bw_footer_wrap">
                        <h5 class="bw_footer_title">Useful links</h5>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About us</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                    {{-- <div class="bw_footer_wrap">
                        <h5 class="bw_footer_title">Useful link</h5>
                        <ul>
                            <li><a href="about.html">About us</a></li>
                            <li><a href="feature.html">Feature</a></li>
                            <li><a href="javascript:;">Pages</a></li>
                        </ul>
                    </div> --}}
                    <div class="bw_footer_wrap">
                        <h5 class="bw_footer_title">Support</h5>
                        <ul>
                            <li><a href="">vaultfinance6@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="bw_footer_col second">
                    <div class="bw_mf_email_wrap">
                        <h4>Join our account</h4>
                        <div class="mf_email_box">
                            <input type="email" name="email" placeholder="Enter your email address">
                            <a class="bw_custom_buttom" href="/register"><span>Create Account</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bw_copy_right_content">
                <div class="bw_footer_logo_content">
                    <a href="/"><img style="width: 250px;"  src="{{ asset('image/logo.png') }}" alt="FOoter_Logo"></a>
                </div>
                @include('user-dashboard-pages.footer-include')

            </div>
        </div>
    </footer>
    <!-- close_bw_footer -->

    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/scroll-parallax.js') }}"></script>
    <script src="{{ asset('js/scroll-zoom.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @include('partials.jivo-chat')
</body>


<!-- Mirrored from demo.webbytemplate.com/html-templates/css3/urban-bank/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Mar 2025 09:40:58 GMT -->

</html>