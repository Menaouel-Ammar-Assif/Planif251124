<!DOCTYPE html>
<html dir="ltr" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/logo.png')}}">
    <title >Système de Planification</title>

    {{------------------------------------------DataTables-----------------------------------------------------}}
    <link rel="stylesheet" href="{{asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    {{------------------------------------------DataTables-----------------------------------------------------}}

    <!-- This page css -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full"  >

        <!-- Main Content -->
        {{-- <div id="content" style="background-color: #e9e4de;height: 100vh;"> --}}
        <div id="content" class="content-wrapper" style="background-image: url('assets/img/back.svg');background-position: center;background-size: cover; height: 100vh;">

                <!-- Begin Page Content -->
                <div class="container d-flex justify-content-center align-items-center" style="" >
                    
                    <div class="row p-4 py-5 justify-content-center align-items-center" >

                        <div class="col-9 d-flex justify-content-center align-items-center p-0" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 30px 90px; width: 50vw; height: 80vh; background-color: rgb(255, 255, 255)">

                            <div class="col-6 d-flex justify-content-center align-items-center" style="background-color: #c6c6c8; height: 100%;">
                                <div class="col-12 alpatchino d-flex justify-content-center align-items-center mb-3">
                                    <div class="image" style="width: 100%; height: 75%;">
                                        <img src="{{asset('assets/stop.jpg')}}" alt="" style="width: 100%;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 divFormSins justify-content-center align-items-center p-3" style="background-color: rgb(255, 255, 255); max-height: 100%; ">
                                <h1 class="text-center">Ce compte est <br> bloqué</h1>


                                <div class="text-center">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="btn mt-1 fl" id="btn2" style="background-color: #9a9a9e;">
                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                {{ __('Se déconnecter') }}
                                            </x-dropdown-link>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Begin Page Content -->



        </div>
        <!-- End of Main Content -->

    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Cliquez sur « Se déconnecter » ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        {{-- <button class="btn btn-primary">
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Se déconnecter') }}
                            </x-dropdown-link>
                        </button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>

    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{asset('dist/js/app-style-switcher.js')}}"></script>

    <script src="{{asset('dist/js/feather.min.js')}}"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>

    <script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <!-- themejs -->
    <!--Menu sidebar -->

    <script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <!-- This Page JS -->

    

</body>

</html>