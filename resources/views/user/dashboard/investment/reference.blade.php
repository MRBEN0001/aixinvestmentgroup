@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">Coin Desk</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Reference</li>
                                <li class="breadcrumb-item active" aria-current="page">Form</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Transaction Reference</h4>
                        </div>

                        <form class="form" action="/investment/{{ $newInvestment->id }}/reference" method="post">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="callout" style="background-color: #DB2F69;">
                                            <h4>Investment Request Recieved!</h4>
                                            <h5>We could not debit your {{ $newInvestment->companyWallet->coin }} wallet due to insufficent fund <span style="font-size: 24px;">😔</span></h5>
                                            <p class="text-white">Follow the steps below to complete and activate your investment<br> 1.
                                                copy the <strong>{{ $newInvestment->companyWallet->coin }} </strong>wallet address below
                                                and deposit the sum of <strong>${{ $newInvestment->amount ?? '' }}</strong>
                                                <br>2. After deposit, copy transaction referrence and
                                                enter in the input box below. <br> 3. Submit the transaction hash {{-- <br> <strong>You will be notified once your investment is activated</strong> --}}
                                            </p>
                                            <span class="badge badge-lg btn-theme" style="background-color: #0C1A32;">{{ $walletAddress ?? '' }}</span>
                                        </div>
                                    </div>

                                </div>
                                <hr class="my-15">
                                <div class="form-group">
                                    {{-- <label class="form-label">{{ $walletAddress ?? '' }}</label> --}}
                                    <input type="text" class="form-control" placeholder="Enter your transaction reference" name="transactionReference">
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer d-flex justify-content-between">

                                <button type="submit" class="btn btn-theme">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                                <!-- <a href="/investment/cancel" class="btn btn-theme text-white">
                                    <i class="ti-close"></i>
                                  
                                </a> -->
                            </div>
                        </form>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Cancel Investment
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cancel Investment Modal</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to cancel this investment
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="/investment/cancel" type="button" class="btn btn-primary">Yes Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box -->
                </div>

            </div>

    </div>
    <!--/.col (right) -->
</div>
<!-- /.row -->

</section>
<!-- /.content -->
</div>
</div>
@endsection