
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

    <!-- This page css -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block p-0 justify-content-center align-items-center position-relative" style="background:url(assets/Pict.jpg) no-repeat center; width: 100%;">

            <div class="auth-box row" style="max-width: 61% !important;">
                {{-- #C2E0F0 --}}
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background: linear-gradient(to bottom,#ebeef7, #c0c8df, #c0c8df, #c0c8df); box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <div style="background-color: #ffffff04; border-radius: 0 100px 100px 0; height: 100%;">    
                        <div class="p-3" style="color:rgb(0, 0, 0); height: 100%;">
                            <div class="text-center" style="height: 100%; font-family: initial;">

                                <h1 class="align-items-start">REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE</h1>
                                <h1 class="h3 align-items-start mt-2">Ministère des Finances</h1>
                                <h1 class="h3 align-items-start" style="font-weight: 600;">Direction Générale des Douanes</h1>

                                <h1 class="h3 align-items-start mt-5" style="font-weight: 600; font-family:  'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Système De Planification</h1>

                                <img src="{{asset('assets/pl2.jpg')}}" alt="Logo" width="100" class="d-inline-block " style="width: 80%">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-7 " style="background-color: #fff; box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">
                    {{-- <div class="p-3">
                        <div class="text-center">    
                            <h1 class="h4 text-gray-900 mb-3 mt-4">Bienvenue</h1>
                            <img src="{{asset('assets/logo.png')}}" alt="Logo" width="60" class="d-inline-block align-text-top">

                        </div>

                        <div class="w-full sm:max-w-md mt-6 px-6 py-2 overflow-hidden sm:rounded-lg">
                            {{ $slot }}
                        </div>

                    </div> --}}
                    <div class="p-3">
                        <div style="justify-content: center; display: flex;">
                            <a href="/">
                                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                            </a>
                        </div>
                        <h2 class="mt-3 text-center text-dark font-weight-medium">Bienvenue</h2>
                        <p class="text-center" style="font-size: small;">Entrez votre nom d'utilisateur et votre mot de passe pour accéder à votre page.</p>
                        {{-- <form class="mt-4"> --}}
                            {{-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="uname">Username</label>
                                        <input class="form-control" id="uname" type="text"
                                            placeholder="enter your username">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label text-dark" for="pwd">Password</label>
                                        <input class="form-control" id="pwd" type="password"
                                            placeholder="enter your password">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn w-100 btn-dark">Sign In</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Don't have an account? <a href="#" class="text-danger">Sign Up</a>
                                </div>
                            </div> --}}
                            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
                                {{ $slot }}
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>