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
        <link rel="stylesheet" href="{{asset('assets/all.min.css')}}">
        <!-- This page css -->
        <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    
        <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">
    </head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg" style="background-color: rgba(49, 148, 175, 0.556);max-height:5px;">
                <div class="navbar-header" data-logobg="skin6" style="background-color: transparent">
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <div class="navbar-brand justify-content-center">
                        <a class="d-flex align-items-center " href="{{ route('admin.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom: transparent;">
                    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                        <li class="nav-item dropdown ms-3 mt-4">
                            <div class="card py-3 px-2 text-light rounded-pill" style="width: max-content; background-color: transparent; font-size: 18px; font-weight: bolder">
                               Système de Planification
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="../assets/images/users/user__.png" alt="user" class="rounded-circle"
                                    width="40">
                                    <span class="ms-2 d-none d-lg-inline-block"><span></span> <span
                                    class="text-dark">Administrateur</span> <i data-feather="chevron-down"
                                    class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="{{route('profile.edit')}}"><i data-feather="user"
                                        class="svg-icon me-2 ms-1"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
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


        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(49, 148, 175, 0.556)">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> 
                            <a class="sidebar-link" href="{{ route('admin.dashboard') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i>
                                <span
                                    class="hide-menu font-weight-medium">Dashboard</span>
                            </a>
                        </li>

                        <li class="list-divider"></li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.users') }}" 
                                aria-expanded="false"><i data-feather="users" class="feather-icon"></i>
                                <span class="hide-menu font-weight-medium">Gestion des utilisateurs</span>
                            </a>
                        </li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu font-weight-medium">Planification</span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.actions') }}" 
                                aria-expanded="false"><i data-feather="settings" class="feather-icon"></i>
                                <span class="hide-menu font-weight-medium">Actions Planification</span>
                            </a>
                        </li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu font-weight-medium">C O P</span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.actionsCop') }}" 
                                aria-expanded="false"><i data-feather="settings" class="feather-icon"></i>
                                <span class="hide-menu font-weight-medium">Actions COP</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.pageAddValue') }}" 
                                aria-expanded="false"><i class="fa-solid fa-calculator me-2 fa-lg"></i>
                                <span class="hide-menu font-weight-medium">Les calculs</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </aside>

        <div class="page-wrapper">
            <div class="container-fluid">
                @if (session()->has('success-msg'))
                        <div class="alert alert-success text-center" role="alert" style="padding: 15px;">
                                <h4 class="alert-heading mb-0">{{session()->get('success-msg')}}</h4>
                        </div>
                @endif


                @if (session()->has('warning-msg'))
                    <div class="alert alert-warning text-center" role="alert" style="padding: 15px;">
                        <h4 class="alert-heading mb-0">{{session()->get('warning-msg')}}</h4>
                    </div>
                @endif

                
            
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title font-weight-bold text-dark">
                                        Gestion des utilisateurs
                                    </h4>
                                    <div>
                                        <button type="button" class="btn btn-success mr-2" id="addUser">
                                            <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
                                        </button>

                                    </div>
                                </div>
                                <table id="users" class="table border">
                                    <thead>
                                        <tr class="font-weight-medium text-light bg-info">
                                            <th>Nom et prénom</th>
                                            <th>Nom d'utilisateur</th>
                                            <th>Structure</th>
                                            <th>Role</th>
                                            <th>Action sur l'utilisateur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user) 
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>
                                                    @if ($user->Direction)
                                                        {{$user->Direction->lib_dir}}
                                                    @else
                                                        Direction Générale des Douanes
                                                    @endif
                                                </td>
                                                <td>{{$user->role}}</td>
                                                <td>
                                                    @if ($user->role != "admin")
                                                        <div class="d-flex justify-content-between">
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#resetModal{{$user->id}}">
                                                                <i class="fa-solid fa-key" style="color: #ffffff;"></i>
                                                            </button>

                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{$user->id}}">
                                                                <i class="fa-solid fa-user-minus "></i>
                                                            </button>

                                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                            data-bs-target="#lockModal{{$user->id}}">
                                                                <i class="fa-solid fa-lock "></i>
                                                            </button>
                                                        </div>

                                                        <div class="modal fade" id="resetModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="resetUserModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="resetUserModalLabel">Réinitialiser le mot de passe</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Êtes-vous sûr de bien vouloir réinitialiser le mot de passe de cet utilisateur ?</p>
                                                                        <form id="resetPasswordForm{{$user->id}}" action="{{ route('admin.reset_user', ['userId' => $user->id]) }}" method="POST">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <div class="input-group mb-3">
                                                                                    <span class="input-group-text">Mot de passe </span>
                                                                                    <input type="hidden" name="userId" value="{{$user->id}}">
                                                                                    <input type="password" class="form-control" placeholder="Réinitialiser Mot de passe" name="passwordr" id="passwordr">
                                                                                    <span class="btn btn-secondary input-group-text" onclick="passwordVisible('passwordr')">
                                                                                        <i class="far fa-eye-slash"></i>
                                                                                    </span>
                                                                                </div>
                                                                            
                                                                                
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                                                    <button type="submit" class="btn btn-warning" style="color: #ffffff;" id="resetPasswordBtn{{$user->id}}">Réinitialiser</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteUserModalLabel">Supprimer Utilisateur</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Êtes-vous sûr de bien vouloir supprimer cet utilisateur ?</p>
                                                                        <form id="deleteUserForm{{$user->id}}" action="{{ route('admin.delete_user', ['userId' => $user->id]) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="userId" value="{{$user->id}}">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="modal fade" id="lockModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="lockUserModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="lockUserModalLabel">Bloquer Compte Utilisateur</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Êtes-vous sûr de vouloir bloquer le compte de cet utilisateur ?</p>
                                                                        <!-- Form to submit user ID for locking -->
                                                                        <form id="lockUserForm{{$user->id}}" action="{{ route('admin.block_user', ['userId' => $user->id]) }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="userId" value="{{$user->id}}">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                                                <button type="submit" class="btn btn-secondary">Bloquer</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        {{-- <div class="modal fade" id="unlockModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="unlockUserModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="unlockUserModalLabel">Débloquer Compte Utilisateur</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Êtes-vous sûr de vouloir débloquer le compte de cet utilisateur ?</p>
                                                                        <!-- Form to submit user ID for locking -->
                                                                        <form id="unlockUserForm{{$user->id}}" action="{{ route('admin.unblock_user', ['userId' => $user->id]) }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="userId" value="{{$user->id}}">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                                                <button type="submit" class="btn btn-primary">Débloquer</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    @endif
                                                </td>
                                                
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                            
                                
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title font-weight-bold text-dark">
                                    Les comptes utilisateurs bloqués
                                </h4>
                                <table id="usersblocked" class="table border">
                                    <thead>
                                        <tr class="font-weight-medium text-light bg-dark">
                                            <th>Nom et prénom</th>
                                            <th>Nom d'utilisateur</th>
                                            <th>Structure</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usersBlockeds as $b) 
                                            <tr>
                                                <td>{{$b->user->name}}</td>
                                                <td>{{$b->user->email}}</td>
                                                <td>{{$b->user->Direction?->lib_dir}}</td>
                                                <td>{{$b->user->role}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#unlockModal{{$b->id_user_blocked}}">
                                                                <i class="fa-solid fa-unlock fa-xs"></i>
                                                    </button>
                                                    <div class="modal fade" id="unlockModal{{$b->id_user_blocked}}" tabindex="-1" role="dialog" aria-labelledby="unlockUserModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="unlockUserModalLabel">Débloquer Compte Utilisateur</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Êtes-vous sûr de vouloir débloquer le compte de cet utilisateur ?</p>
                                                                    <!-- Form to submit user ID for locking -->
                                                                    <form id="unlockUserForm{{$b->id_user_blocked}}" action="{{ route('admin.unblock_user', ['userId' => $b->id_user_blocked]) }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="userId" value="{{$b->id_user_blocked}}">
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                                            <button type="submit" class="btn btn-primary">Débloquer</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                            
                                
                        </div>
                    </div>
                </div>


                
            </div>
        </div>


    </div>



    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-light" id="myLargeModalLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-hidden="true"></button>
                </div>
                <div class="modal-body">Cliquez sur « Se déconnecter » ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-primary">
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Se déconnecter') }}
                            </x-dropdown-link>
                        </button>
                    </form>
                </div>

                <!-- Modal -->
    

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!------------------------------ Start Modal Ajouter Utilisateur ----------------------------------------------------->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Ajouter Utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{Route('admin.add_user')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nom et prénom </span>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>  
                        
                                <div class="input-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Nom d'utilisateur</span>
                                        <input type="text" class="form-control" name="email" id="email">
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group">
                                        <label class="input-group-text" for="selectedRole">Role </label>
                                            <select class="form-select" id="selectedRole" name="role">
                                                <option disabled selected>Choisissez Le Rôle</option>
                                                <option value="directeur">Directeur</option>
                                                <option value="consult">Consultant</option>
                                                <option value="admin">Administrateur</option>
                                            </select>
                                    </div>
                                </div>
                                    
                                <div class="input-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Mot de passe </span>
                                            <input type="password" class="form-control" name="password" id="password">
                                                <div id="password-message" style="color: red;"></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3" id="structureSelection">
                                    <div class="input-group">
                                        <label class="input-group-text" for="selectedDirection">Structure</label>
                                        <select class="form-select" name="direction" id="direction">
                                            <option disabled selected>Choisissez la structure </option>
                                            @foreach ($directions as $direction)
                                                <option value="{{$direction->id_dir}}">{{$direction->lib_dir}}</option>
                                            @endforeach    
                                        </select>
                                    </div>
                                </div>
                                    
                               

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                        Fermer
                                    </button>
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                                        Ajouter
                                    </button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------ End Modal Ajouter Utilisateur ----------------------------------------------------->
    

     



<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>

    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{asset('dist/js/app-style-switcher.js')}}"></script>

    <script src="{{asset('dist/js/feather.min.js')}}"></script>
    <script src="{{asset('assets/all.min.js')}}"></script>

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
    <!--Morris JavaScript -->
    <script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/libs/morris.js/morris.min.js')}}"></script>
    {{-- <script src="{{asset('dist/js/pages/morris/morris-data.js')}}"></script> --}}


    {{-------------------------------------------------------------------------------------}}

{{------------------------------------------DataTables-----------------------------------------------------}}
<script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

{{-- <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script src="{{asset('dist/js/bootstrap.min.js')}}"></script>

<script>

    $(document).ready(function(){
        $('#users').DataTable();
    });

    $(document).ready(function(){
        $('#usersblocked').DataTable();
    });

//------------------------------ Start Modal Ajouter Utilisateur -----------------------------------------------------

  document.addEventListener("DOMContentLoaded", function() {
        const addUserButton = document.getElementById('addUser');
        addUserButton.addEventListener('click', function() {
        $('#addUserModal').modal('show');
    });
  });


  
$(document).ready(function () {
        $('#iddir').change(function () {
            var dirId = $(this).val();
            
                $.ajax({
                    type: "GET",
                    url: '/admin/getDirections/' + dirId,
                    success: function (response) {

                        var response = JSON.parse(response);

                        $('#usersList').empty();
                        $('#usersList').append(`<option value="0" disabled selected>Selectionner un utilisateur</option>`);

                        response.forEach(element => { $('#usersList').append(`<option value="${element['id']}">${element['name']} | Matricule : ${element['email']}</option>`); });
                        
                },
                error: function (xhr, status, error) {
                    console.error(error); 
                }
                });
        });
    });


    $(document).ready(function () {
    $('#selectedRole').change(function () {
        var selectedRole = $(this).val();
        if (selectedRole === 'admin' || selectedRole === 'consult') {
            $('#structureSelection').hide(); // Hide structure selection
        } else {
            $('#structureSelection').show(); // Show structure selection for other roles
        }
    });
});


//------------------------------ End Modal Ajouter Utilisateur -----------------------------------------------------

//------------------------------ Start js Réinitialiser Mot de passe Utilisateur -----------------------------------------------------

$(document).ready(function() {
        // Attach a click event handler to the reset password button
        $('[id^="resetPasswordBtn"]').click(function() {
            // Extract the user ID from the button ID
            var userId = $(this).attr('id').replace('resetPasswordBtn', '');
            // Send an AJAX request to reset the password
            $.ajax({
                url: '/admin/reset_user/' + userId,
                type: 'POST',
                data: $('#resetPasswordForm' + userId).serialize(),
                success: function(response) {
                    // Display the success message in the message div
                    $('#messageDiv').removeClass('alert alert-danger').addClass('alert alert-success').html(response.message).show();
                    $('#resetUserModal' + userId).modal('hide');
                },
                error: function(xhr) {
                    // Display the error message in the message div
                    $('#messageDiv').removeClass('alert alert-success').addClass('alert alert-danger').html('Error: ' + xhr.responseText).show();
                }
            });
        });
    });

//------------------------------ End js Réinitialiser Mot de passe Utilisateur -----------------------------------------------------


////////////////////////////////////////Start Eye Psw/////////////////////////////////////////
function passwordVisible(inputId) {
            var passwordInput = document.getElementById('passwordr');
            var passwordToggleIcon = document.getElementById('passwordToggleIcon');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggleIcon.className = "far fa-eye";
            } else {
                passwordInput.type = "password";
                passwordToggleIcon.className = "far fa-eye-slash";
            }
        }
////////////////////////////////////////End Eye Psw//////////////////////////////////////////

</script>

</body>
</html>