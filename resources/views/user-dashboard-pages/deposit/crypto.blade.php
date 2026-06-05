@extends('layouts.user-dashboard')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<main class="main-wrapper col-md-9 ms-sm-auto py-4 col-lg-9 px-md-4 border-start">
    <div class="title-group mb-3">
        <h1 class="h2 mb-0" style="font-size: 14px;">Fund your US account instantly</h1>
        <p class="text-muted" style="font-size: 14px;">Send USDC to this address to add funds to your USD balance</p>
    </div>

    <div class="row my-4">
        <div class="col-lg-6 col-12 mx-auto">

            <div class="alert alert-warning" style="background-color: rgba(255, 193, 7, 0.2); border-color: rgba(255, 193, 7, 0.5); font-size:14px" role="alert">
                <strong>PAYMENT INSTRUCTION</strong><br>
                {{settings()->instruction ?? ''}}
            </div>

            <div class="card text-center p-4" style="margin-bottom: -30px;">
                <!-- @if(settings()?->image)
                <div class="mb-4">
                    <img src="{{ imagePath(settings()?->image) }}" alt="QR Code" class="img-fluid" style="max-width: 200px;">

                </div>
                @endif -->
                <div class="mb-3">
                    <strong>Network</strong>
                    <p>{{settings()->network ?? ''}}</p>
                </div>

                <div class="mb-3">
                    <strong>USDC Address</strong>
                    <p class="text-break" style="font-size: 14px;">
                        {{settings()->address ?? ''}}
                        <button class="btn btn-sm btn-light" onclick="copyAddress()">Copy</button>
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Fee</strong>
                    <p style="font-size: 14px;">{{settings()->fee ?? ''}}</p>
                </div>

                <div>
                    <a href="javascript:void(0);" onclick="shareAddress()" class="btn btn-sm" style="border: 2px solid #A8DADC;">Share address</a>
                
                </div>
                <div class="nav-item  mt-lg-5 mt-4 mb-4">
                    <a class=" form-control btn custom-btn" href="/transaction/hash">Paid</a>
                </div>
            
            </div>

            <!-- <div class="mt-4 text-center">
                <a href="" class="btn btn-primary btn-lg w-100">Back to Home</a>
            </div> -->
            <div class="nav-item featured-box mt-lg-5 mt-4 mb-4">
                <a class="btn custom-btn" href="/dashboard">Back to Home</a>
            </div>

        </div>
    </div>
{{-- 
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <p class="copyright-text">Copyright © Mini Finance 2048
                        - Design: <a rel="sponsored" href="https://www.tooplate.com" target="_blank">Tooplate</a></p>
                </div>
            </div>
        </div>
    </footer> --}}
    @include('user-dashboard-pages.footer-include')

</main>

<script>
    function copyAddress() {
        navigator.clipboard.writeText('0xE7DA43AAdCc238A01fF2928bC54d30CC7959050');
        alert('Address copied to clipboard!');
    }
</script>
<script>
    function copyAddress() {
        navigator.clipboard.writeText('0xE7DA43AAdCc238A01fF2928bC54d30CC7959050');
        alert('Address copied to clipboard!');
    }

    function shareAddress() {
        const address = '0xE7DA43AAdCc238A01fF2928bC54d30CC7959050';

        if (navigator.share) {
            navigator.share({
                    title: 'USDC Deposit Address',
                    text: 'Send USDC to this address:',
                    url: address
                }).then(() => {
                    console.log('Thanks for sharing!');
                })
                .catch(console.error);
        } else {
            alert('Share not supported on this browser. You can copy the address instead.');
        }
    }
</script>

@endsection