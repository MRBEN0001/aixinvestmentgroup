@extends('layouts.guest')
@section('content')
    <div class="bw_main_body">
        <div data-scroll class="page">
            <main>
                <div class="bw_content">
                    <!-- start_bw_login_page_section -->
                    <section class="bw_login_page_section">
                        <div class="bw_container">
                            <div class="bw_login_page_wrap" data-aos="zoom-in" data-aos-duration="1000">
                                <div class="bw_regisiter_wrap active">
                                    <h3 class="bw_sub_title">Create your account</h3>
                                    <p class="bw_dec_title">Please fill in the form to create your account</p>
                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf

                                        {{-- Full Name --}}
                                        <input class="bw_custom_input" type="text" placeholder="Full Name" name="name"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                        <div style="color: red;" class="mt-1">{{ $message }}</div>

                                            {{-- <div class="text-danger mt-1">{{ $message }}</div> --}}
                                        @enderror

                                        {{-- Username --}}
                                        <input class="bw_custom_input" type="text" placeholder="Username" name="username"
                                            value="{{ old('username') }}" required>
                                        @error('username')
                                        <div style="color: red;" class="mt-1">{{ $message }}</div>
                                        @enderror

                                        {{-- Email --}}
                                        <input class="bw_custom_input" type="email" placeholder="Email" name="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                        <div style="color: red;" class="mt-1">{{ $message }}</div>

                                        @enderror

                                        {{-- Phone --}}
                                        <input class="bw_custom_input" type="text" placeholder="Phone Number" name="phone"
                                            value="{{ old('phone') }}">
                                        @error('phone')
                                        <div style="color: red;" class="mt-1">{{ $message }}</div>

                                        @enderror


                                        {{-- Country --}}
                                        <select class="bw_custom_input" name="country" required>
                                            <option value="">Select Country</option>
                                            @php
                                                $countries = [
                                                    'Afghanistan',
                                                    'Albania',
                                                    'Algeria',
                                                    'Andorra',
                                                    'Angola',
                                                    'Antigua and Barbuda',
                                                    'Argentina',
                                                    'Armenia',
                                                    'Australia',
                                                    'Austria',
                                                    'Azerbaijan',
                                                    'Bahamas',
                                                    'Bahrain',
                                                    'Bangladesh',
                                                    'Barbados',
                                                    'Belarus',
                                                    'Belgium',
                                                    'Belize',
                                                    'Benin',
                                                    'Bhutan',
                                                    'Bolivia',
                                                    'Bosnia and Herzegovina',
                                                    'Botswana',
                                                    'Brazil',
                                                    'Brunei',
                                                    'Bulgaria',
                                                    'Burkina Faso',
                                                    'Burundi',
                                                    'Cabo Verde',
                                                    'Cambodia',
                                                    'Cameroon',
                                                    'Canada',
                                                    'Central African Republic',
                                                    'Chad',
                                                    'Chile',
                                                    'China',
                                                    'Colombia',
                                                    'Comoros',
                                                    'Congo (Congo-Brazzaville)',
                                                    'Costa Rica',
                                                    'Croatia',
                                                    'Cuba',
                                                    'Cyprus',
                                                    'Czech Republic (Czechia)',
                                                    'Democratic Republic of the Congo',
                                                    'Denmark',
                                                    'Djibouti',
                                                    'Dominica',
                                                    'Dominican Republic',
                                                    'Ecuador',
                                                    'Egypt',
                                                    'El Salvador',
                                                    'Equatorial Guinea',
                                                    'Eritrea',
                                                    'Estonia',
                                                    'Eswatini (fmr. "Swaziland")',
                                                    'Ethiopia',
                                                    'Fiji',
                                                    'Finland',
                                                    'France',
                                                    'Gabon',
                                                    'Gambia',
                                                    'Georgia',
                                                    'Germany',
                                                    'Ghana',
                                                    'Greece',
                                                    'Grenada',
                                                    'Guatemala',
                                                    'Guinea',
                                                    'Guinea-Bissau',
                                                    'Guyana',
                                                    'Haiti',
                                                    'Holy See',
                                                    'Honduras',
                                                    'Hungary',
                                                    'Iceland',
                                                    'India',
                                                    'Indonesia',
                                                    'Iran',
                                                    'Iraq',
                                                    'Ireland',
                                                    'Israel',
                                                    'Italy',
                                                    'Jamaica',
                                                    'Japan',
                                                    'Jordan',
                                                    'Kazakhstan',
                                                    'Kenya',
                                                    'Kiribati',
                                                    'Kuwait',
                                                    'Kyrgyzstan',
                                                    'Laos',
                                                    'Latvia',
                                                    'Lebanon',
                                                    'Lesotho',
                                                    'Liberia',
                                                    'Libya',
                                                    'Liechtenstein',
                                                    'Lithuania',
                                                    'Luxembourg',
                                                    'Madagascar',
                                                    'Malawi',
                                                    'Malaysia',
                                                    'Maldives',
                                                    'Mali',
                                                    'Malta',
                                                    'Marshall Islands',
                                                    'Mauritania',
                                                    'Mauritius',
                                                    'Mexico',
                                                    'Micronesia',
                                                    'Moldova',
                                                    'Monaco',
                                                    'Mongolia',
                                                    'Montenegro',
                                                    'Morocco',
                                                    'Mozambique',
                                                    'Myanmar (formerly Burma)',
                                                    'Namibia',
                                                    'Nauru',
                                                    'Nepal',
                                                    'Netherlands',
                                                    'New Zealand',
                                                    'Nicaragua',
                                                    'Niger',
                                                    'Nigeria',
                                                    'North Korea',
                                                    'North Macedonia',
                                                    'Norway',
                                                    'Oman',
                                                    'Pakistan',
                                                    'Palau',
                                                    'Palestine State',
                                                    'Panama',
                                                    'Papua New Guinea',
                                                    'Paraguay',
                                                    'Peru',
                                                    'Philippines',
                                                    'Poland',
                                                    'Portugal',
                                                    'Qatar',
                                                    'Romania',
                                                    'Russia',
                                                    'Rwanda',
                                                    'Saint Kitts and Nevis',
                                                    'Saint Lucia',
                                                    'Saint Vincent and the Grenadines',
                                                    'Samoa',
                                                    'San Marino',
                                                    'Sao Tome and Principe',
                                                    'Saudi Arabia',
                                                    'Senegal',
                                                    'Serbia',
                                                    'Seychelles',
                                                    'Sierra Leone',
                                                    'Singapore',
                                                    'Slovakia',
                                                    'Slovenia',
                                                    'Solomon Islands',
                                                    'Somalia',
                                                    'South Africa',
                                                    'South Korea',
                                                    'South Sudan',
                                                    'Spain',
                                                    'Sri Lanka',
                                                    'Sudan',
                                                    'Suriname',
                                                    'Sweden',
                                                    'Switzerland',
                                                    'Syria',
                                                    'Tajikistan',
                                                    'Tanzania',
                                                    'Thailand',
                                                    'Timor-Leste',
                                                    'Togo',
                                                    'Tonga',
                                                    'Trinidad and Tobago',
                                                    'Tunisia',
                                                    'Turkey',
                                                    'Turkmenistan',
                                                    'Tuvalu',
                                                    'Uganda',
                                                    'Ukraine',
                                                    'United Arab Emirates',
                                                    'United Kingdom',
                                                    'United States of America',
                                                    'Uruguay',
                                                    'Uzbekistan',
                                                    'Vanuatu',
                                                    'Venezuela',
                                                    'Vietnam',
                                                    'Yemen',
                                                    'Zambia',
                                                    'Zimbabwe'
                                                ];
                                            @endphp

                                            @foreach ($countries as $country)
                                                <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>
                                                    {{ $country }}</option>
                                            @endforeach
                                        </select>

                                        @error('country')
                                        <div style="color: red;" class="mt-1">{{ $message }}</div>
                                        @enderror

                                        {{-- Password --}}
                                        <input class="bw_custom_input" type="password" placeholder="Password"
                                            name="password" required>
                                        @error('password')
                                        <div style="color: red;" class="mt-1">{{ $message }}</div>
                                        @enderror

                                        {{-- Confirm Password --}}
                                        <input class="bw_custom_input" type="password" placeholder="Confirm Password"
                                            name="password_confirmation" required>
                                        @error('password_confirmation')
                                        <div style="color: red;" class="mt-1">{{ $message }}</div>
                                        @enderror

                                        <p class="bw_pass_dec">
                                            The password should be at least eight characters long. To make it stronger, use
                                            upper and lower case letters, numbers, and symbols like ! ? $ % ^ & )
                                        </p>

                                        <button class="btn btn-primary bw_custom_buttom" type="submit">Create
                                            Account</button>

                                        <p>Already have an account? <a href="{{ route('login') }}"
                                                class="bw_register_click">Log in</a></p>
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
    <script>
        document.getElementById('profile_image').addEventListener('change', function(event) {
            const preview = document.getElementById('profile_preview');
            const file = event.target.files[0];
    
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
    
@endsection