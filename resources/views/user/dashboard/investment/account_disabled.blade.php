<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('/images/favicon.ico') }}">

    <title>Ggraton</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/skin_color.css') }}">

</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-5.jpg)">

    <section class="error-page h-p100">
        <div class="container h-p100">
            <div class="row h-p100 align-items-center justify-content-center text-center">
                <div class="col-lg-7 col-md-10 col-12">
                    <div class="rounded30 p-50">
                        <img src="../images/auth-bg/500.jpg" class="max-w-200" alt="" />
                        <div style="font-size: 48px;">🚫</div>
                        <h1>Unfortunately, Your Account Has Been Disabled!!</h1>

                        <h4>Contact An Admin For More Information @ <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></h4>

                        <a href="/dashboard" class="btn btn-primary mt-3">Back To dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Vendor JS -->
    <script src="{{ asset('/js/vendors.min.js') }}"></script>
    <script src="{{ asset('/js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('/assets/icons/feather-icons/feather.min.js') }}"></script>


</body>

</html>