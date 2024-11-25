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

    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/all.min.css')}}">

</head>

<body id="page-top">

        <!-- Content Wrapper -->
        <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full"  >

            <!-- Main Content -->
            {{-- <div id="content" style="background-color: #e9e4de;height: 100vh;"> --}}
            <div id="content" class="content-wrapper" style="background-image: url('assets/img/back.svg');background-position: center;background-size: cover; height: 100vh;">

                    <!-- Begin Page Content -->
                    <div class="container d-flex justify-content-center align-items-center" style="" >
                        
                        <div class="row p-4 py-5 justify-content-center align-items-center" >

                            <div class="col-9 d-flex justify-content-center align-items-center p-0" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 30px 90px; width: 80vw; height: 80vh; background-color: rgb(255, 255, 255)">

                                <div class="col-6 d-flex justify-content-center align-items-center" style="background-color: #bccbdf; height: 100%;">
                                    <div class="col-12 alpatchino d-flex justify-content-center align-items-center mb-3">
                                        <div class="image" style="width: 50%; height: 75%;">
                                            <img src="{{asset('assets/join.svg')}}" alt="" style="width: 100%;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 divFormSins justify-content-center align-items-center p-3" style="background-color: rgb(255, 255, 255); max-height: 100%; ">
                                    {{-- <div> --}}

                                        {{-- <div class="alert alert-danger text-center" role="alert" style="padding: 10px;">
                                            <h5 class="alert-heading mb-0"><i class="fa-solid fa-triangle-exclamation fa-beat"></i> Vous devez finaliser votre inscription</h5>
                                        </div> --}}

                                        {{-- <form method="POST" action="{{route('complete-profile')}}">
                                            @csrf

                                            <div class="input-group mt-4" id="inputGroup1">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Nom et prénom</span>
                                                <input type="text" aria-label="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" name="name" id="name" placeholder=" Nom">
                                                
                                            </div>
                                                @if (session()->has('name_err'))
                                                    <p class="text-danger mt-0">
                                                        {{session()->get('name_err')}}
                                                    </p>
                                                @endif

                                            <div class="input-group mt-4" id="inputGroup2">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Matricule :</span>
                                                <input type="text" class="form-control" aria-label="Sizing example input" value="{{ old('matricule', auth()->user()->matricule) }}" name="matricule" id="matricule" placeholder="Exemple : 230000">
                                            </div>
                                                @if (session()->has('matricule_err'))
                                                    <p class="text-danger mt-0">
                                                        {{session()->get('matricule_err')}}
                                                    </p>
                                                @endif
                                            
                                            <div class="input-group mt-4" id="inputGroup3">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Numéro de téléphone :</span>
                                                <input type="text" class="form-control" aria-label="Sizing example input" value="{{ old('phone', auth()->user()->phone) }}" name="phone" id="phone" placeholder="Exemple :0666666666">
                                            </div>
                                                @if (session()->has('phone_err'))
                                                    <p class="text-danger mt-0">
                                                        {{session()->get('phone_err')}}
                                                    </p>
                                                @endif
                                            
                                            <div class="input-group mt-4" id="inputGroup5">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Mot de passe actuel :</span>
                                                <input type="password" class="form-control" value="" name="old_password" id="old_password" placeholder="">
                                                <span class="btn btn-secondary input-group-text" onclick="passwordVisible('old_password')">
                                                    <i class="fa-solid fa-eye"></i>
                                                </span>
                                            </div>
                                                @if (session()->has('old_password_err'))
                                                    <p class="text-danger mt-0">
                                                        {{session()->get('old_password_err')}}
                                                    </p>
                                                @endif

                                            <div class="input-group mt-4" id="inputGroup6">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Nouveau mot de passe :</span>
                                                <input type="password" class="form-control" value="" name="new_password" id="new_password" placeholder="">
                                                <span class="btn btn-secondary input-group-text" onclick="passwordVisible('new_password')">
                                                    <i class="fa-solid fa-eye"></i>
                                                </span>

                                                <p class="ms-2" style="opacity: 70%;">Votre mot de passe doit comporter plus que de 8 caractères et contenir des lettres et des chiffres.</p>
                                            </div>
                                                @if (session()->has('new_password_err'))
                                                    <p class="text-danger mt-0">
                                                        {{session()->get('new_password_err')}}
                                                    </p>
                                                @endif
                                        
                                            <button type="submit" id="btn1" class="btn btn-outline-success float-end px-4 mt-1" >S'inscrire</button>
                                        </form> --}}
                                        <form method="POST" action="{{route('complete-profile')}}">
                                            @csrf
                                        
                                            <div class="input-group mt-4" id="inputGroup1">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Nom et prénom</span>
                                                <input type="text" aria-label="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" name="name" id="name" placeholder="Nom">
                                            </div>
                                            @if (session()->has('name_err'))
                                                <p class="text-danger mt-0">{{ session()->get('name_err') }}</p>
                                            @endif
                                        
                                            <div class="input-group mt-4" id="inputGroup2">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Matricule :</span>
                                                <input type="text" class="form-control" aria-label="Sizing example input" value="{{ old('matricule', auth()->user()->matricule) }}" name="matricule" id="matricule" placeholder="Exemple : 230000">
                                            </div>
                                            <p id="matricule-error" class="text-danger mt-0"></p>
                                            @if (session()->has('matricule_err'))
                                                <p class="text-danger mt-0">{{ session()->get('matricule_err') }}</p>
                                            @endif
                                        
                                            <div class="input-group mt-4" id="inputGroup3">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Numéro de téléphone :</span>
                                                <input type="text" class="form-control" aria-label="Sizing example input" value="{{ old('phone', auth()->user()->phone) }}" name="phone" id="phone" placeholder="Exemple : 0666666666">
                                            </div>
                                            <p id="phone-error" class="text-danger mt-0"></p>
                                            @if (session()->has('phone_err'))
                                                <p class="text-danger mt-0">{{ session()->get('phone_err') }}</p>
                                            @endif
                                        
                                            <div class="input-group mt-4" id="inputGroup5">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Mot de passe actuel :</span>
                                                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="">
                                                <span class="btn btn-secondary input-group-text" onclick="passwordVisible('old_password')">
                                                    <i class="fa-solid fa-eye"></i>
                                                </span>
                                            </div>
                                            @if (session()->has('old_password_err'))
                                                <p class="text-danger mt-0">{{ session()->get('old_password_err') }}</p>
                                            @endif
                                        
                                            <div class="input-group mt-4" id="inputGroup6">
                                                <span class="input-group-text text-dark" style="background-color: #d4d9e0;">Nouveau mot de passe :</span>
                                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="">
                                                <span class="btn btn-secondary input-group-text" onclick="passwordVisible('new_password')">
                                                    <i class="fa-solid fa-eye"></i>
                                                </span>
                                                <p class="ms-2" style="opacity: 70%;">Votre mot de passe doit comporter plus que de 8 caractères et contenir des lettres et des chiffres.</p>
                                            </div>
                                            @if (session()->has('new_password_err'))
                                                <p class="text-danger mt-0">{{ session()->get('new_password_err') }}</p>
                                            @endif
                                        
                                            <button type="submit" id="btn1" class="btn btn-outline-success float-end px-4 mt-1">S'inscrire</button>
                                        </form>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="btn mt-1 btn-outline-secondary"  style="color:#b3b3b3 !important;" id="btn2">
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

                    <!-- End Begin Page Content -->



            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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


    

    <script>
        function passwordVisible(inputId) {
            var passwordInput = document.getElementById(inputId);
            var passwordToggleIcon = document.getElementById('passwordToggleIcon');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggleIcon.className = "fa-solid fa-eye-slash";
            } else {
                passwordInput.type = "password";
                passwordToggleIcon.className = "fa-solid fa-eye";
            }
        }

        // var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

        // if (screenWidth >= 1200) {
        //     document.getElementById('input-group').classList.add('input-group-lg');
        // }
        $(document).ready(function() {
            if ($(window).width() >= 1350) {
                $('#inputGroup1').addClass('input-group-lg');
                $('#inputGroup2').addClass('input-group-lg');
                $('#inputGroup3').addClass('input-group-lg');
                $('#inputGroup4').addClass('input-group-lg');
                $('#inputGroup5').addClass('input-group-lg');
                $('#inputGroup6').addClass('input-group-lg');
                $('#btn1').addClass('btn-lg');
                $('#btn2').addClass('btn-lg');
            }
        });

</script>
    
<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>

    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{asset('dist/js/app-style-switcher.js')}}"></script>

    <script src="{{asset('dist/js/feather.min.js')}}"></script>
    <script src="{{asset('assets/all.min.js')}}"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>

    <script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>

    <!--Custom JavaScript -->
    <script src="{{asset('dist/js/custom.min.js')}}"></script>

    <script>
        function validateForm(event) {
            // Get the input elements
            const phoneInput = document.getElementById('phone');
            const matriculeInput = document.getElementById('matricule');
            
            // Get the input values
            const phoneValue = phoneInput.value;
            const matriculeValue = matriculeInput.value;
            
            // Get the error message elements
            const phoneError = document.getElementById('phone-error');
            const matriculeError = document.getElementById('matricule-error');
            
            // Clear any previous error messages
            phoneError.textContent = '';
            matriculeError.textContent = '';
            
            let isValid = true;
            
            // Validate phone number
            if (!/^\d{10,15}$/.test(phoneValue)) {
                phoneError.textContent = 'Le numéro de téléphone doit comporter entre 10 et 15 chiffres et contenir uniquement des chiffres.';
                isValid = false;
            }
            
            // Validate matricule (assuming it should be a 6-digit number for this example)
            if (!/^\d{6}$/.test(matriculeValue)) {
                matriculeError.textContent = 'Le matricule doit comporter exactement 6 chiffres.';
                isValid = false;
            }
            
            // If any validation fails, prevent form submission
            if (!isValid) {
                event.preventDefault();
            }
        }
    
        // Attach the validation function to the form submit event
        document.querySelector('form').addEventListener('submit', validateForm);
    
        // Restrict input to numbers only
        document.getElementById('phone').addEventListener('input', function (event) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    
        document.getElementById('matricule').addEventListener('input', function (event) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>

</body>

</html>