@extends('layouts.dashboard')
@section('content')
    <div class="row">


        <h4 class="card-title">All KYC Submissions</h4>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>S/N</th>
                        <th>User</th>
                        <th>DOB</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>ID Type</th>
                        <th>ID Front</th>
                        <th>ID Back</th>
                        <th>Passport</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kycs as $index => $kyc)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kyc->user->name ?? 'N/A' }}</td>
                            <td>{{ $kyc->dob }}</td>
                            <td>{{ $kyc->address }}</td>
                            <td>{{ $kyc->city }}</td>
                            <td>{{ $kyc->state }}</td>
                            <td>{{ $kyc->zip }}</td>
                            <td>{{ $kyc->id_type }}</td>
                            <td class="text-center">
                                <img src="{{ asset('kyc/'.$kyc->id_front) }}" alt="ID Front" style="border-radius: 2%; width: auto; height: auto; max-height: 80px;">
                            </td>
                            <td class="text-center">
                                <img src="{{ asset('kyc/'.$kyc->id_back) }}" alt="ID Back" style="border-radius: 2%; width: auto; height: auto; max-height: 80px;">
                            </td>
                            <td class="text-center">
                                <img src="{{ asset('kyc/'.$kyc->passport_photo) }}" alt="Passport" style="border-radius: 2%; width: auto; height: auto; max-height: 80px;">
                            </td>  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        


      
    </div>

    
    {{-- Preview Script --}}
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