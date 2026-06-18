 <header class="main-header">
     <div class="d-flex align-items-center logo-box justify-content-start">
         <!-- <a href="index.html" class="logo">
             <div class="logo-mini w-30">
                 <span class="light-logo"><img src="{{ asset('/images/logo-letter.png') }}" alt="logo"></span>
                 <span class="dark-logo"><img src="{{ asset('/images/logo-letter.png') }}" alt="logo"></span>
             </div>
             <div class="logo-lg">
                 <span class="light-logo"><img src="{{ asset('/images/logo-dark-text.png') }}" alt="logo"></span>
                 <span class="dark-logo"><img src="{{ asset('/images/maxlogo.png') }}" alt="logo" style="margin-top: 10px;"></span>
             </div>
         </a> -->
     </div>
     <!-- Header Navbar -->
     <nav class="navbar navbar-static-top">
         <!-- Sidebar toggle button-->
         <div class="app-menu">
             <ul class="header-megamenu nav">
                 <li class="btn-group nav-item">
                     <a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light"
                         data-toggle="push-menu" role="button">
                         <i data-feather="align-left"></i>
                     </a>
                 </li>
                 <li class="btn-group nav-item d-none d-xl-inline-block">
                     <a href="javascript::void[0]"
                         class="waves-effect waves-light nav-link svg-bt-icon btn-primary-light" title="Chat">
                         <i data-feather="message-circle"></i>
                     </a>
                 </li>
                 <li class="btn-group nav-item d-none d-xl-inline-block">
                     <a href="javascript::void[0]" class="waves-effect waves-light nav-link svg-bt-icon btn-primary-light"
                         title="Mailbox">
                         <i data-feather="at-sign"></i>
                     </a>
                 </li>
                 <li class="btn-group nav-item d-none d-xl-inline-block">
                     <a href="/"
                         class="waves-effect waves-light nav-link svg-bt-icon btn-primary-light" title="Back to website">
                         <i data-feather="clipboard"></i>
                     </a>
                 </li>
             </ul>
         </div>

         <div class="navbar-custom-menu r-side">
             <ul class="nav navbar-nav">
                 <li class="btn-group d-lg-inline-flex d-none">
                     <div class="app-menu">
                         <div class="search-bx mx-5">
                             <form>
                                 <div class="input-group">
                                     <input type="search" class="form-control" placeholder="Search" aria-label="Search"
                                         aria-describedby="button-addon2">
                                     <div class="input-group-append">
                                         <button class="btn" type="submit" id="button-addon3"><i
                                                 data-feather="search"></i></button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </li>
                 <li class="btn-group nav-item d-lg-inline-flex d-none">
                     <a href="#" data-provide="fullscreen"
                         class="waves-effect waves-light nav-link full-screen btn-primary-light" title="Full Screen">
                         <i data-feather="maximize"></i>
                     </a>
                 </li>
                 <!-- Notifications -->
                 <li class="dropdown notifications-menu">
                     <a href="#" class="waves-effect waves-light dropdown-toggle btn-primary-light"
                         data-bs-toggle="dropdown" title="Notifications">
                         <i data-feather="bell"></i>
                     </a>
                     <ul class="dropdown-menu animated bounceIn">

                         <li class="header">
                             <div class="p-20">
                                 <div class="flexbox">
                                     <div>
                                         <h4 class="mb-0 mt-0">Notifications</h4>
                                     </div>
                                     <div>
                                         <a href="#" class="text-danger">Clear All</a>
                                     </div>
                                 </div>
                             </div>
                         </li>

                         <li>
                             <!-- inner menu: contains the actual data -->
                             <ul class="menu sm-scrol">
                                 <li>
                                     <a href="#">
                                         <i class="fa fa-users text-info"></i> Your notifications will appear here
                                     </a>
                                 </li>
                                 {{-- <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu
                                                sapien elementum, in semper diam posuere.
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor
                                                commodo porttitor pretium a erat.
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et
                                                nisi
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero
                                                dictum fermentum.
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-primary"></i> Nunc fringilla lorem
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam
                                                interdum, at scelerisque ipsum imperdiet.
                                            </a>
                                        </li> --}}
                             </ul>
                         </li>
                         <li class="footer">
                             <a href="javascript::void[0]">View all</a>
                         </li>
                     </ul>
                 </li>

                 <!-- User Account-->
                 <li class="dropdown user user-menu">
                     <a href="#" class="waves-effect waves-light dropdown-toggle btn-primary-light"
                         data-bs-toggle="dropdown" title="User">
                         <i data-feather="user"></i>
                     </a>
                     <ul class="dropdown-menu animated flipInX">
                         <li class="user-body">
                             <a class="dropdown-item" href="/profile"><i class="ti-user text-muted me-2"></i>
                                 Profile</a>
                             <a class="dropdown-item" href="/dashboard"><i class="ti-wallet text-muted me-2"></i>
                                 My Wallet</a>
                             <a class="dropdown-item" href="javascript::void[0]"><i
                                     class="ti-settings text-muted me-2"></i> Settings</a>
                             <div class="dropdown-divider"></div>
                             {{-- <a class="dropdown-item" href="#"> --}}
                                 <form method="POST" action="{{ route('logout') }}">
                                         @csrf
                                         <button type="submit" class="dropdown-item">
                                             <i class="ti-lock text-muted me-2"><span class="text-white"> Logout</span></i>
                                         </button>
                                     </form>
                                    {{-- </a> --}}
                         </li>
                     </ul>
                 </li>

                 <!-- Control Sidebar Toggle Button -->
                 <li>
                     <a href="javascript::void[0]" data-toggle="" title="Setting"
                         class="waves-effect waves-light btn-primary-light">
                         <i data-feather="settings"></i>
                     </a>
                 </li>

             </ul>
         </div>
     </nav>
 </header>
