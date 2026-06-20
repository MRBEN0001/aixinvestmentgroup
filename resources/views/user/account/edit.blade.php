@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h4 class="page-title">{{ config('app.name') }}</h4>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">Edit</li>
                                    <li class="breadcrumb-item active" aria-current="page">Account</li>
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
                                <h4 class="box-title">Edit Account</h4>
                            </div>

                            <form class="form" action="/accounts/{{ auth()->user()->id }}/update" method="update">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                    <h5 class="box-title text-info mb-0 mt-20"><span>Select the coin
                                            that you may with to change the wallet address</span>
                                    </h5>
                                    <hr class="my-15">
                                    <div class="form-group">
                                        <label class="form-label">New Address</label>
                                        <input type="text" class="form-control" placeholder="Enter amount to invest"
                                            name="walletAddress">
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Select Coin</label>
                                                <select class="form-select" name="coin">

                                                    @forelse ($coins as $coin)
                                                        <option value="{{ $coin->companyWallet->id }}">
                                                            {{ $coin->companyWallet->coin }}</option>
                                                    @empty
                                                        <h4>Contact Admin</h4>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">

                                    <button type="submit" class="btn btn-theme">
                                        <i class="ti-save-alt"></i> Save
                                    </button>
                                </div>
                            </form>
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
