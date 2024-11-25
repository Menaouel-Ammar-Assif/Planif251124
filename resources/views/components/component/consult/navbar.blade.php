<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-lg custom-navbar-width" style="background-color: rgba(0, 76, 255, 0.56);max-height:5px;">

        <div class="navbar-header" data-logobg="skin5" >
        <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>

        <!-- ============================================================== -->
            <div class="navbar-brand justify-content-center">
                <!-- Logo icon -->
                <a class="d-flex align-items-center " href="{{ route('directeur.dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

        <!-- ============================================================== -->
            <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>


        <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom: transparent;">

            <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                <!-- Notification -->
                <li class="nav-item dropdown">

                    {{-- <li> --}}
                        <p class="nav-link pt-3 text-light fs-4" class="blockquote">
                            <strong>Système de Planification</strong>
                        </p>
                    {{-- </li> --}}

                </li>

            </ul>

            <ul class="navbar-nav float-left me-3 ms-auto ps-1">

            </ul>

            <ul class="navbar-nav float-end">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="../assets/images/users/user__.png" alt="user" class="rounded-circle"
                            width="40">
                        <span class="ms-2 d-none d-lg-inline-block"><span></span> <span
                                class="text-dark">Directeur Général</span> <i data-feather="chevron-down"
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

            </ul>
        </div>
    </nav>
</header>