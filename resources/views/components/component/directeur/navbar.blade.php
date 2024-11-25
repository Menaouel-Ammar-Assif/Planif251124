<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-lg" style="background-color: rgba(0, 76, 255, 0.56); max-height:5px;">
        <div class="navbar-header" data-logobg="skin6" style="background-color: transparent">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-brand justify-content-center">
                <!-- Logo icon -->
                <a class="d-flex align-items-center " href="{{ route('directeur.dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom: transparent;">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                
                <li class="nav-item dropdown ms-3 mt-4">

                    <div class="card py-3 px-2 text-light rounded-pill" style="width: max-content; background-color: transparent; font-size: 18px; font-weight: bolder">
                        {{auth()->user()->Direction->lib_dir}}
                    </div>

                </li>

                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->

            </ul>

            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="../assets/images/users/user__.png" alt="user" class="rounded-circle"
                            width="40">
                            <span class="ms-2 d-none d-lg-inline-block"><span></span> <span
                            class="text-dark">Directeur {{auth()->user()->Direction->code}}</span> <i data-feather="chevron-down"
                            class="svg-icon"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
                        <a class="dropdown-item" href="{{route('profile.edit')}}"><i data-feather="user"
                                class="svg-icon me-2 ms-1"></i>
                            Profile
                        </a>


                        <div class="dropdown-divider"></div>
                        {{-- <a class="dropdown-item" href="javascript:void(0)"><i data-feather="power"
                                class="svg-icon me-2 ms-1"></i>
                            Logout
                        </a> --}}

                        <button class="dropdown-item btn" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i data-feather="power" class="svg-icon me-2 ms-1"></i>
                            Se déconnecter
                        </button>

                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>