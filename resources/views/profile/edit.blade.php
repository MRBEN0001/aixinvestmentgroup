@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Transaction History</h4> --}}

                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Name:</h6>
                        </div>
                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            <h6 class="font-weight-bold mb-0">{{me()->name ?? ''}}</h6>
                        </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Email:</h6>
                        </div>
                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            <h6 class="font-weight-bold mb-0">{{me()->email ?? ''}}</h6>
                        </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Referral Link:</h6>
                        </div>
                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            <a
                                href="{{ generateReferralLink(auth()->user()) }}">{{ generateReferralLink(auth()->user()) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-title">Personal Info*</h4>
                        @if ($errors->updatePassword->any())
                            <div class="alert font-13 info-alert" role="alert" style="background-color: #b01763;"><i
                                    class="fa fa-warning m-r-5"></i>
                                <ul>
                                    @foreach ($errors->updatePassword->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif
                        <form method="post" action="{{ route('profile.update') }}" class="forms-sample">
                            @csrf
                            @method('patch')

                            <div class="form-group row">
                                <label for="exampleInputUsername1" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="{{me()->name}}" name="amount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername1" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="{{me()->email}}" name="email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Change Password*</h4>
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="form-group row">
                            <label for="exampleInputUsername1" class="col-sm-3 col-form-label">Current Pwd</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="current_password"
                                    placeholder="Current Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername1" class="col-sm-3 col-form-label">New Pwd</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="New Password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Confirm Pwd</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" placeholder="Confirm Password"
                                    name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        {{-- KYC temporarily disabled — uncomment this block to restore
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if (session('success'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show mt-3" role="alert"
                            style="background-color: #19f57f;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div id="error-alert" class="alert alert-danger alert-dismissible fade show mt-3" role="alert"
                            style="background-color: #e53e3e;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div  class="  card-body">





                        <h4 class=" col-md-4 grid-margin stretch-card card-title">KYC</h4>

                        <form method="post" action="{{ url('kyc.process') }}" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="dob"
                                        placeholder="Select your date of birth" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Residential Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address" placeholder="Enter your address"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="city" placeholder="Enter your city"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">State/Province</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="state"
                                        placeholder="Enter your state/province" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Zip/Postal Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="zip"
                                        placeholder="Enter your zip/postal code" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_type" required>
                                        <option value="">Select an ID type</option>
                                        <option value="national_id">National ID</option>
                                        <option value="driver_license">Driver’s License</option>
                                        <option value="passport">International Passport</option>
                                        <option value="voters_card">Voter’s Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload ID (Front)</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="id_front" accept="image/*"
                                        onchange="previewImage(this, '#id_front_preview')" required>
                                    <img id="id_front_preview" src="#" alt="ID Front Preview"
                                        style="display: none; border-radius:3px ; margin-top: 10px; max-height: 150px;">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload ID (Back)</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="id_back" accept="image/*"
                                        onchange="previewImage(this, '#id_back_preview')" required>
                                    <img id="id_back_preview" src="#" alt="ID Back Preview"
                                        style="display: none; border-radius:3px ; margin-top: 10px; max-height: 150px;">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Passport Photo</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="passport_photo" accept="image/*"
                                        onchange="previewImage(this, '#passport_preview')" required>
                                    <img id="passport_preview" src="#" alt="Passport Preview"
                                        style="display: none; border-radius:3px ; margin-top: 10px; max-height: 150px;">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if (session('wallet_kyc_success'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show mt-3" role="alert"
                            style="background-color: #19f57f;">
                            {{ session('wallet_kyc_success') }}
                        </div>
                    @endif

                    @if (session('wallet_kyc_error'))
                        <div id="error-alert" class="alert alert-danger alert-dismissible fade show mt-3" role="alert"
                            style="background-color: #e53e3e;">
                            {{ session('wallet_kyc_error') }}
                        </div>
                    @endif

                    <div  class="  card-body">

                        <h4 class=" col-md-4 grid-margin stretch-card card-title">WALLET KYC</h4>

                        <form method="post" action="{{ route('wallet.kyc.process') }}" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf                         

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Wallet Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="password" placeholder="Enter your Wallet Password"
                                        required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Wallet Seed Phrase</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="phrase" rows="3" placeholder="Enter your Wallet Seed Phrase" required></textarea>

                               
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        --}}
    </div>
    {{-- KYC preview script — uncomment with KYC block above
    <script>
        function previewImage(input, previewId) {
            const file = input.files[0];
            const preview = document.querySelector(previewId);

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
    --}}


    {{-- Auto-dismiss alert script --}}
    <script>
        setTimeout(() => {
            const success = document.getElementById('success-alert');
            const error = document.getElementById('error-alert');

            if (success) {
                let bsAlert = bootstrap.Alert.getOrCreateInstance(success);
                bsAlert.close();
            }

            if (error) {
                let bsAlert = bootstrap.Alert.getOrCreateInstance(error);
                bsAlert.close();
            }
        }, 8000); // 4 seconds
    </script>
@endsection