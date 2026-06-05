@extends('layouts.user-dashboard')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

<main class="main-wrapper col-md-9 ms-sm-auto py-4 col-lg-9 px-md-4 border-start">
    <div class="title-group mb-3">
        <h1 class="h2 mb-0">Settings</h1>
    </div>

    <div class="row my-4">
        <div class="col-lg-7 col-12">
            <div class="custom-block bg-white">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                            aria-selected="true">Profile</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab"
                            data-bs-target="#password-tab-pane" type="button" role="tab"
                            aria-controls="password-tab-pane" aria-selected="false">Password</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="notification-tab" data-bs-toggle="tab"
                            data-bs-target="#notification-tab-pane" type="button" role="tab"
                            aria-controls="notification-tab-pane" aria-selected="false">Notification</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel"
                        aria-labelledby="profile-tab" tabindex="0">
                        <h6 class="mb-4">User Profile</h6>


                        <div class="flex items-center gap-4">

                            {{-- profile update alert --}}

                            @if (session('status') === 'profile-updated')
                            <div
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                style="background-color: #38a169; color: white; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; position: relative;"
                                role="alert">
                                <strong>Success!</strong>
                                <span>{{ __('Profile updated.') }}</span>

                                <!-- Close button -->
                                <button
                                    @click="show = false"
                                    style="position: absolute; top: 8px; right: 8px; background: transparent; border: none; color: white; font-size: 20px; cursor: pointer;">
                                    &times;
                                </button>
                            </div>
                            @endif
                        </div>


                        {{-- password alert --}}
                        @if (session('status') === 'password-updated')
                        <div
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            style="background-color: #38a169; color: white; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; position: relative;"
                            role="alert">
                            <strong>Success!</strong>
                            <span>{{ __('Password updated.') }}</span>
                            <!-- Close button -->
                            <button
                                @click="show = false"
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


                        {{-- notification alert  --}}
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" style="background-color: #19f57f;">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" style="background-color: #e53e3e;">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif




                        <form class="custom-form profile-form" action="{{ route('profile.update') }}" method="post"
                            role="form" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <input class="form-control" id="name" name="name" type="text" value="{{Auth::user()->name}}"
                                :value="old('name', $user->name)" required autofocus autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />

                            <input class="form-control" type="email" id="email" name="email"
                                value="{{Auth::user()->email}}" :value="old('email', $user->email)" required
                                autocomplete="username">
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            <div class="input-group mb-1">
                            @if (env('APP_LEVEL') === 'local')
                            <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('image/avatar.jpeg') }}" class="profile-image img-fluid" alt="">
                                @else
                                <img src="{{ Auth::user()->profile_image ? asset('vault-bank/public/' . Auth::user()->profile_image) : asset('vault-bank/public/image/avatar.jpeg') }}" class="profile-image img-fluid" alt="">
                                @endif

                                {{-- <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image"class="profile-image img-fluid" alt=""> --}}

                                <input id="profile_image" type="file" name="profile_image" class="form-control" onchange="previewImage(event)">

                                <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />

                            </div>

                            <!-- Image Preview -->
                            <div class="mt-4" style=" padding-bottom: 10px; ">
                            @if (env('APP_LEVEL') === 'local')
                            <img class="img-fluid rounded" id="image_preview" src="{{ $user->profile_image ? asset($user->profile_image) : '' }}"
                                    alt="Image Preview" class="h-32 w-32 object-cover rounded-full border"
                                    style="display: {{ $user->profile_image ? 'block' : 'none' }};">
                                    @else
                                    <img class="img-fluid rounded" id="image_preview" src="{{ Auth::user()->profile_image ? asset('vault-bank/public/' . Auth::user()->profile_image) : asset('vault-bank/public/image/avatar.jpeg') }}"
                                    alt="Image Preview" class="h-32 w-32 object-cover rounded-full border"
                                    style="display: {{ $user->profile_image ? 'block' : 'none' }};">
                                    @endif
                            </div>


                            <div class="d-flex">
                                {{-- <button type="button" class="form-control me-3">
                                        Reset
                                    </button> --}}

                                <button type="submit" class="form-control ms-2">
                                    Update Profile
                                </button>
                            </div>



                        </form>
                    </div>

                    <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab"
                        tabindex="0">
                        <h6 class="mb-4">Password</h6>

                        <form class="custom-form password-form" action="{{ route('password.update') }}" method="post" role="form">
                            @csrf
                            @method('put')
                            <input id="update_password_current_password" name="current_password" type="password" pattern="[0-9a-zA-Z]{4,10}" autocomplete="current-password "
                                class="form-control" placeholder="Current Password" required="">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />


                            <input id="update_password_password" name="password" type="password"
                                pattern="[0-9a-zA-Z]{4,10}" class="form-control" placeholder="New Password" required="" autocomplete="new-password">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

                            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                                pattern="[0-9a-zA-Z]{4,10}" class="form-control" placeholder="Confirm Password"
                                required="" autocomplete="new-password">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />


                            <div class="d-flex">
                                {{-- <button type="button" class="form-control me-3">
                                        Reset
                                    </button> --}}

                                <button type="submit" class="form-control ms-2">
                                    Update Password
                                </button>
                            </div>



                        </form>
                    </div>

                    <div class="tab-pane fade" id="notification-tab-pane" role="tabpanel" aria-labelledby="notification-tab" tabindex="0">
                        <h6 class="mb-4">Notification</h6>


                        <form class="custom-form notification-form" action="{{ route('profile.notifications.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-check form-switch d-flex mb-3 ps-0">
                                <label class="form-check-label" for="notificationToggle">Enable Notifications</label>
                                <input class="form-check-input ms-auto" type="checkbox"
                                    name="is_notification_enable" id="notificationToggle"
                                    {{ auth()->user()->is_notification_enable ? 'checked' : '' }}>
                            </div>

                            <div class="form-check form-switch d-flex mb-3 ps-0">
                                <label class="form-check-label" for="twoFactorToggle">Enable 2 Factor Auth</label>
                                <input class="form-check-input ms-auto" type="checkbox"
                                    name="is_two_factor_auth_enable" id="twoFactorToggle"
                                    {{ auth()->user()->is_two_factor_auth_enable ? 'checked' : '' }}>
                            </div>
                            <button type="submit" class="form-control ms-2">
                                Update Notification
                            </button>
                        </form>


                    </div>

                </div>
            </div>
        </div>

        {{-- <div class="col-lg-5 col-12">
            <div class="custom-block custom-block-contact">
                <h6 class="mb-4">Still can’t find what you looking for?</h6>

                <p>
                    <strong>Call us:</strong>
                    <a href="tel: 305-240-9671" class="ms-2">
                        (60)
                        305-240-9671
                    </a>
                </p>

                <a href="#" class="btn custom-btn custom-btn-bg-white mt-3">
                    Chat with us
                </a>
            </div>
        </div> --}}
    </div>

    @include('user-dashboard-pages.footer-include')

</main>





<script>
    // JavaScript function to preview the image before upload
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            // Update the preview image with the selected file
            const preview = document.getElementById('image_preview');
            preview.src = e.target.result;
            preview.style.display = 'block'; // Show the image
        }

        // If a file is selected, read it as Data URL
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection