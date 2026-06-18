<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li>
                        <a href="/dashboard">
                            <i data-feather="refresh-ccw"></i>
                            <span>Overview</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i data-feather="users"></i>
                            <span>Manage Profile</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/profile"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Profile
                                </a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i data-feather="monitor"></i>
                            <span>Manage Account</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if (!auth()->user()->account)
                            <li><a href="/account/setup"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Set Up Account
                                </a></li>
                            @endif
                            @if (auth()->user()->account)
                            <li><a href="/accounts/{{ auth()->user()->id }}/edit"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Edit
                                </a></li>
                            @endif

                            <li><a href="/my-referrals"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>My Referrals
                                </a></li>

                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i data-feather="pie-chart"></i>
                            <span>Manage Investment</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/investments"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>History
                                </a></li>
                            <li><a href="/invest"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Invest
                                </a></li>

                        </ul>
                    </li>


                    <li class="treeview">
                        <a href="#">
                            <i data-feather="dollar-sign"></i>
                            <span>Withdraw</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>

                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/withdrawals"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>History
                                </a></li>
                            <li><a href="/withdraw"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Withdraw
                                </a></li>

                        </ul>
                    <li class="treeview">
                        <a href="#">
                            <i data-feather="credit-card"></i> <span>Deposit</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/deposits/create"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Deposit Fund
                                </a></li>
                            <li><a href="/deposits"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>History
                                </a></li>

                        </ul>
                    </li>
                    </li>

                    {{-- <li class="treeview">
                        <a href="#">
                            <i data-feather="bar-chart-2"></i>
                            <span>Report</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="transactions_tables.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Earnings
                                </a></li>
                            <li><a href="transaction_search.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Transactions
                                    Search</a></li>
                        </ul>
                    </li> --}}
                </ul>
                <div class="mx-25 mb-30 p-30 text-center rounded5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button href="/invest" type="submit" class="waves-effect waves-light btn btn-sm btn-theme mb-5">Logout</button>
                    </form>
                </div>


                <div class="sidebar-widgets">
                    <div class="mx-25 mb-30 p-30 text-center bg-primary-light rounded5">
                        <img src="{{ asset('/images/trophy.png') }}" alt="">
                        <h4 class="my-3 fw-500 text-uppercase text-primary">Start Investment</h4>
                        <span class="fs-12 d-block mb-3 text-black-50">The journey of a large portfolio begins with a
                            good investment</span>
                        <a href="/invest" type="button" class="waves-effect waves-white text-white btn btn-sm btn-theme mb-5" style="color:white">Invest
                            Now</a>
                    </div>
                    {{-- <div class="copyright text-center m-25">
                        <p><strong class="d-block">Crypto Admin Dashboard</strong> © 2022 All Rights Reserved
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
</aside>