<header id="page-topbar">
    <div class="d-flex">
        <div class="navbar-brand-box text-center">
            <a href="{{ url('/')}}" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ url('/')}}/assets/images/logo-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ url('/')}}/assets/images/logo.png" alt="" height="20">
                </span>
            </a>
            <a href="{{ url('/')}}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ url('/')}}/assets/images/logo-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ url('/')}}/assets/images/logo_dark.png" alt="" height="20">
                </span>
            </a>
        </div>

           
    </div>    
</header>
<!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title text-uppercase">Main</li>
                            <li>
                                <a href="{{ url('/')}}/stock" class="waves-effect">
                                    <i class="dripicons-calendar"></i>
                                    <span>Transaksi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/')}}/user" class="waves-effect">
                                    <i class="dripicons-calendar"></i>
                                    <span>User</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/')}}/stock/view" class="waves-effect">
                                    <i class="dripicons-calendar"></i>
                                    <span>Stock</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/')}}/user/logout" class="waves-effect">
                                    <i class="dripicons-calendar"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

