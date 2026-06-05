@extends('layouts.user-dashboard')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <main class="main-wrapper col-md-9 ms-sm-auto py-4 col-lg-9 px-md-4 border-start">
        <div class="title-group mb-3">
            {{-- <h1 class="h2 mb-0">Settings</h1> --}}
        </div>

        <div class="row my-4">
            <div class="col-lg-7 col-12">
                <div class="custom-block bg-white">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel"
                            aria-labelledby="profile-tab" tabindex="0">
                            <h6 class="mb-4">Make Withdrawal</h6>








                            {{-- notification alert --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3 py-2 px-3 small-text"
                                    role="alert" style="background-color: #20a55e; font-size: 0.9rem; position: relative;">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"
                                        aria-label="Close" style="width: 0.75rem; height: 0.75rem; margin-top: -6px;"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3 py-2 px-3 small-text"
                                    role="alert" style="background-color: #c23434; font-size: 0.9rem; position: relative;">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"
                                        aria-label="Close" style="width: 0.75rem; height: 0.75rem; margin-top: -6px;"></button>
                                </div>
                            @endif




                            {{-- redirect to transactions --}}

                            @if (session('success'))
                                <script>
                                    setTimeout(function () {
                                        window.location.href = "{{ route('transactions') }}";
                                    }, 2000); // 2000ms = 2 seconds
                                </script>
                            @endif

                            {{-- transfer form --}}







                            <form class="custom-form profile-form" action="{{ route('withdraw.process') }}" method="POST"
                                id="withdrawalForm">
                                @csrf

                                <!-- Amount -->
                                <input class="form-control mt-3" type="number" name="amount" min="1" step="0.01"
                                    placeholder="Enter amount to withdraw" required>

                                <!-- Button -->
                                <button type="submit" class="form-control ms-2" id="withdraw-button">
                                    <span id="withdraw-btn-text">Complete Withdrawal</span>
                                    <span id="withdraw-spinner" class="spinner-border spinner-border-sm ms-2 d-none"
                                        role="status" aria-hidden="true"></span>
                                </button>
                            </form>


                        </div>






                    </div>
                </div>
            </div>


        </div>
        @include('user-dashboard-pages.footer-include')

    </main>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('withdrawalForm');
            const button = document.getElementById('withdraw-button');
            const btnText = document.getElementById('withdraw-btn-text');
            const spinner = document.getElementById('withdraw-spinner');

            form.addEventListener('submit', function (e) {
                // Disable the button immediately
                button.disabled = true;

                // Show spinner and hide text
                spinner.classList.remove('d-none');
                btnText.textContent = 'Processing...';
            });
        });
    </script>


@endsection