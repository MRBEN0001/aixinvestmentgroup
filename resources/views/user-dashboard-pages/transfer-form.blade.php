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
                            <h6 class="mb-4">Make Transfer</h6>



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

                            @if (session('success'))
                                <script>
                                    setTimeout(function () {
                                        window.location.href = "{{ route('transactions') }}";
                                    }, 2000); // 3000ms = 3 seconds
                                </script>
                            @endif



                            {{-- transfer form --}}


                            <form class="custom-form profile-form" action="{{ route('transfer.process') }}" method="POST"
                                role="form" id="transfer-form">
                                @csrf

                                <!-- Beneficiary Account Number -->
                                <input class="form-control" id="account_number" name="account_number" type="text"
                                    placeholder="Enter beneficiary account number" value="{{ old('account_number') }}"
                                    required autofocus>

                                  
                         
                                <!-- Bank Selection -->
                                <select class="form-control" id="bank" name="bank" required>
                                    <option value="">-- Select Bank --</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}" {{ old('bank') == $bank->id ? 'selected' : '' }}>
                                            {{ $bank->name }}
                                        </option>
                                    @endforeach
                                </select>


                                             <!-- Beneficiary  routine Number -->
                                             <input class="form-control" id="routine" name="routine" type="text"
                                             placeholder="Enter beneficiary routine number" value="{{ old('routine') }}"
                                             required autofocus>
             

                                <!-- Transfer Amount -->
                                <input class="form-control mt-3" id="amount" name="amount" type="number" min="1" step="0.01"
                                    placeholder="Enter amount to transfer" value="{{ old('amount') }}" required>

                                <!-- Account Details -->
                                <div id="account-details" class="mt-2 text-sm text-success"></div>
                                <div id="account-error" class="mt-2 text-sm text-danger"></div>


                                <!-- Submit Button -->
                                <div class="d-flex mt-3">
                                    <button type="submit" class="form-control ms-2" id="submit-button">
                                        <span class="button-text">Complete Transfer</span>
                                        <span class="spinner-border spinner-border-sm d-none" role="status"
                                            aria-hidden="true"></span>
                                    </button>
                                </div>


                            </form>






                        </div>






                    </div>
                </div>
            </div>


        </div>
        @include('user-dashboard-pages.footer-include')

    </main>






    {{-- JavaScript: Show Spinner + Prevent Multiple Clicks --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById('transfer-form');
            const submitButton = document.getElementById('submit-button');
            const spinner = submitButton.querySelector('.spinner-border');
            const buttonText = submitButton.querySelector('.button-text');

            form.addEventListener('submit', function (e) {
                // Disable button to prevent multiple submissions
                submitButton.disabled = true;

                // Show spinner and hide text
                spinner.classList.remove('d-none');
                buttonText.textContent = 'Processing...';
            });
        });
    </script>


    {{-- auto display account name after entering account number and bank --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const accountInput = document.getElementById('account_number');
            const bankSelect = document.getElementById('bank');
            const token = document.querySelector('input[name="_token"]').value;

            function fetchAccountDetails() {
                const accountNumber = accountInput.value;
                const bankId = bankSelect.value;

                if (accountNumber && bankId) {
                    fetch("{{ route('transfer.jax.validate') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": token
                        },
                        body: JSON.stringify({
                            account_number: accountNumber,
                            bank: bankId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            const detailsDiv = document.getElementById('account-details');
                            const errorDiv = document.getElementById('account-error');
                            detailsDiv.textContent = '';
                            errorDiv.textContent = '';

                            if (data.name) {
                                detailsDiv.textContent = `Account Name: ${data.name}`;
                            } else if (data.error) {
                                errorDiv.textContent = data.error;
                            }
                        })
                        .catch(() => {
                            document.getElementById('account-error').textContent = 'Error fetching account details.';
                        });
                }
            }

            accountInput.addEventListener('input', fetchAccountDetails);
            bankSelect.addEventListener('change', fetchAccountDetails);
        });
    </script>
@endsection