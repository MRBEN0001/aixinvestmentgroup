@extends('layouts.user-dashboard')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <main class="main-wrapper col-md-9 ms-sm-auto py-4 col-lg-9 px-md-4 border-start">
        <div class="title-group mb-3">
            <h1 class="h2 mb-0">KYC</h1>
        </div>

        <div class="row my-4">
            <div class="col-lg-7 col-12">
                <div class="custom-block bg-white">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel"
                            aria-labelledby="profile-tab" tabindex="0">
                            {{-- <h6 class="mb-4">User Profile</h6> --}}


                            <div class="flex items-center gap-4">

                                {{-- profile update alert --}}

                                @if (session('status') === 'profile-updated')
                                    <div x-data="{ show: true }" x-show="show" x-transition
                                        style="background-color: #38a169; color: white; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; position: relative;"
                                        role="alert">
                                        <strong>Success!</strong>
                                        <span>{{ __('Profile updated.') }}</span>

                                        <!-- Close button -->
                                        <button @click="show = false"
                                            style="position: absolute; top: 8px; right: 8px; background: transparent; border: none; color: white; font-size: 20px; cursor: pointer;">
                                            &times;
                                        </button>
                                    </div>
                                @endif
                            </div>


                            {{-- password alert --}}
                            @if (session('status') === 'password-updated')
                                <div x-data="{ show: true }" x-show="show" x-transition
                                    style="background-color: #38a169; color: white; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; position: relative;"
                                    role="alert">
                                    <strong>Success!</strong>
                                    <span>{{ __('Password updated.') }}</span>
                                    <!-- Close button -->
                                    <button @click="show = false"
                                        style="position: absolute; top: 8px; right: 8px; background: transparent; border: none; color: white; font-size: 20px; cursor: pointer;">
                                        &times;
                                    </button>
                                </div>

                                <script>
                                    // Alpine.js initialization (if needed)
                                    document.addEventListener('alpine:init', () => {
                                        Alpine.start();
                                    });
                                </script>
                            @endif


                           

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






                            <form class="custom-form profile-form" action="{{ route('kyc.process') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <h6 class="mb-4">KYC Verification</h6>

                                <!-- Date of Birth -->
                                <input class="form-control mb-3" type="date" name="date_of_birth"
                                    value="{{ old('date_of_birth') }}" required>

                                <!-- Address -->
                                <input class="form-control mb-3" type="text" name="address" value="{{ old('address') }}"
                                    placeholder="Residential Address" required>

                                <!-- City -->
                                <input class="form-control mb-3" type="text" name="city" value="{{ old('city') }}"
                                    placeholder="City" required>

                                <!-- State -->
                                <input class="form-control mb-3" type="text" name="state" value="{{ old('state') }}"
                                    placeholder="State/Province" required>

                                <!-- Zip Code -->
                                <input class="form-control mb-3" type="text" name="zip" value="{{ old('zip') }}"
                                    placeholder="Zip/Postal Code" required>

                                <!-- Government ID Type -->
                                <select class="form-control mb-3" name="id_type" required>
                                    <option value="">Select ID Type</option>
                                    <option value="passport" {{ old('id_type') == 'passport' ? 'selected' : '' }}>Passport
                                    </option>
                                    <option value="national_id" {{ old('id_type') == 'national_id' ? 'selected' : '' }}>
                                        National ID</option>
                                    <option value="driver_license" {{ old('id_type') == 'driver_license' ? 'selected' : '' }}>
                                        Driver's License</option>
                                    <option value="voter_card" {{ old('id_type') == 'voter_card' ? 'selected' : '' }}>Voter's
                                        Card</option>
                                </select>

                                <!-- Upload Government ID -->
                                <label class="form-label mt-3 mb-1">Upload Government ID (Front Side)</label>
                                <input class="form-control mb-3" type="file" name="id_document_front" id="id_document_front"
                                    required>
                                <img id="preview_id_document_front"
                                    style="max-width: 200px; display:none; border:1px solid #ccc; margin-bottom:10px;" />

                                <label class="form-label mt-3 mb-1">Upload Government ID (Back Side)</label>
                                <input class="form-control mb-3" type="file" name="id_document_back" id="id_document_back"
                                    required>
                                <img id="preview_id_document_back"
                                    style="max-width: 200px; display:none; border:1px solid #ccc; margin-bottom:10px;" />

                                <!-- Upload Passport Photo -->
                                <label class="form-label mt-3 mb-1">Upload Passport Photo</label>
                                <input class="form-control mb-3" type="file" name="selfie" id="selfie" required>
                                <img id="preview_selfie"
                                    style="max-width: 200px; display:none; border:1px solid #ccc; margin-bottom:10px;" />

                                <div class="d-flex">
                                    <button type="submit" class="form-control ms-2">
                                        Submit KYC
                                    </button>
                                </div>
                            </form>

                            <script>
                                function previewImage(inputId, imgId) {
                                    const input = document.getElementById(inputId);
                                    input.addEventListener('change', function (event) {
                                        const file = event.target.files[0];
                                        if (file) {
                                            const reader = new FileReader();
                                            reader.onload = function (e) {
                                                const img = document.getElementById(imgId);
                                                img.src = e.target.result;
                                                img.style.display = 'block';
                                            }
                                            reader.readAsDataURL(file);
                                        }
                                    });
                                }

                                // Connect inputs to previews
                                previewImage('id_document_front', 'preview_id_document_front');
                                previewImage('id_document_back', 'preview_id_document_back');
                                previewImage('selfie', 'preview_selfie');
                            </script>
@endsection