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

    <link rel="stylesheet" href="{{asset('all.min.css')}}">
    <!-- This page css -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/all.min.css')}}">
    <link href="../assets/libs/morris.js/morris.css" rel="stylesheet">

  


    <style>
        .balls {
        width: 2.6em;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: space-between;
        }
    
        .balls div {
        width: 0.6em;
        height: 0.6em;
        border-radius: 50%;
        background-color: #fc2f70;
        animation: fade 0.8s ease-in-out alternate infinite;
        }
    
        .balls div:nth-of-type(1) {
        animation-delay: -0.4s;
        }
    
        .balls div:nth-of-type(2) {
        animation-delay: -0.2s;
        }
    
        @keyframes fade {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
        }
    
    
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            color: #fff;
            background-color: #0177cc !important;
        }
    
        .custom-tooltip {
            --bs-tooltip-bg: #2783fa;
            --bs-tooltip-color: var(--bs-white);
            --bs-tooltip-padding-x: 10px;
            --bs-tooltip-padding-y: 15px;
        }
    
        #fixedButton {
            position: fixed !important;
            bottom: 20px; 
            right: 20px; 
            width: 130px;
            padding: 8px 14px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            opacity: 30%;
            z-index: 10;
        }
    
        #fixedButton:hover {
            background-color: #0056b3;
            opacity: 100%;
        }
    
        .zoomed {
            zoom: 150%; 
        }

    .tooltip .tooltip-inner {
        background-color: #0d6efd !important; 
        color: white; 
    }
          
    </style>
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
            <div class="container">
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

                @if (session()->has('error-msg'))
                    <div class="alert alert-danger text-center" role="alert" style="padding: 15px;">
                        <h4 class="alert-heading mb-0">{{session()->get('error-msg')}}</h4>
                    </div>
                @endif

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                    </div>
                </div>
            </div>

            
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills">
                            <li class="nav-item" role="presentation" >
                                <a href="#Centrale" name="zoomButton" data-bs-toggle="tab" aria-expanded="true"
                                class="nav-link rounded-0 active">
                                <i class="mdi mdi-account-circle d-block me-1"></i>
                                <span class="d-none d-lg-block">Structures Centrales</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation" name="zoomButton">
                                <a href="#Regionale" name="zoomButton" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0">
                                <i class="mdi mdi-settings-outline d-block me-1"></i>
                                <span class="d-none d-lg-block">Directions Régionales</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            {{--////////////////////////////////////////////////////////Div Centrale/////////////////////////--}}
                            <div class="tab-pane mt-3 show active" id="Centrale">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12 mt-2 ">
                                                <div class="card border-end">
                                                    <div class="customize-input float-start" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                                                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" id="DCselect">

                                                            <option value="all" selected> Structures Centrales</option>
                                                            @foreach ($directionsDc as $direction)
                                                                <option value="{{ $direction->id_dir }}">{{ $direction->code }} - {{ $direction->lib_dir }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h4 class="card-title font-weight-bold text-dark">
                                                        Gestion des actions
                                                    </h4>
                                                    <div>
                                                        <button type="button" class="btn btn-success mr-2" id="addAction" style="display: none;">
                                                            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table id="zero_config" class="table border">
                                                        <thead>
                                                            <tr class="font-weight-medium text-light bg-info">
                                                                <th>Structure Centrale</th>
                                                                <th>Code Action</th>
                                                                <th>Action</th>
                                                                <th>Date début</th>
                                                                <th>Date fin</th>
                                                                <th>Action Prioritaire</th>
                                                                <th>CRUD</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        {{-- ////////////////////////////////////////////////////////Div Regionale////////////////////////--}}
                            <div class="tab-pane " id="Regionale">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-12 mt-2 ">
                                                <div class="card border-end">
                                                    <div class="customize-input float-start" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                                                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" id="DRselect">
                                                        <option value="all" selected> Directions Regionales</option>
                                                            @foreach ($directionsDr as $direction)
                                                                <option value="{{ $direction->id_dir }}">{{ $direction->code }} - {{ $direction->lib_dir }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h4 class="card-title font-weight-bold text-dark">
                                                        Gestion des actions
                                                    </h4>
                                                    <div>
                                                        <button type="button" class="btn btn-success mr-2" id="addActionDR" style="display: none;">
                                                            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table id="zero_config_dr" class="table border">
                                                        <thead>
                                                            <tr class="text-light bg-info">
                                                                <th>Direction Régionale</th>
                                                                <th>Code action</th>
                                                                <th>Action</th>
                                                                <th>Date début</th>
                                                                <th>Date fin</th>
                                                                <th>CRUD</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center text-muted" >
                Système de Planification
            </footer>
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

                

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<!------------------------------ Start Modal Add Action DC ----------------------------------------------------->
      <div class="modal fade" id="addActionModal" tabindex="-1" aria-labelledby="addActionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addActionModalLabel">Ajouter Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.add_actionDC') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">

                                <div class="input-group mb-3">
                                    <span class="input-group-text">Structure Centrale</span>
                                    <input type="text" class="form-control" id="structure_centrale_input" readonly>
                                    <input type="hidden" name="id_dir" id="id_dir">
                                </div> 

                                <div class="input-group mb-3">
                                    <span class="input-group-text">code Action</span>
                                    <input type="text" class="form-control" name="code_act" id="code_act">
                                </div>  

                                <div class="input-group mb-3">
                                    <span class="input-group-text">Action</span>
                                    <textarea class="form-control" name="lib_act" id="lib_act"></textarea>
                                </div>  
                        
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Date début</span>
                                    <input type="date" class="form-control" name="dd" id="dd">
                                </div>  

                                <div class="input-group mb-3">
                                    <span class="input-group-text">Date fin</span>
                                    <input type="date" class="form-control" name="df" id="df">
                                </div>  

                                <div class="input-group mb-3" id="selectedActionPrio">
                                    <div class="input-group">
                                        <label class="input-group-text" for="selectedActionPrio">Action prioritaire</label>
                                        <select class="form-select" name="act_prio" id="act_prio">
                                            <option disabled selected>Choisissez l'action prioritaire </option>
                                            @foreach ($prioritaires as $prio)
                                                <option value="{{$prio->id_p}}">{{$prio->lib_p}}</option>
                                            @endforeach    
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="input-group mb-3" id="selectedActionCop">
                                    <div class="input-group">
                                        <label class="input-group-text" for="selectedActionCop">Action COP</label>
                                        <select class="form-select" name="act_cop" id="act_cop">
                                            <option disabled selected>Choisissez l'action COP </option>
                                            @foreach ($cops as $cop)
                                                <option value="{{$cop->id_act_cop}}">{{$cop->lib_act_cop}}</option>
                                            @endforeach    
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="input-group mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" role="switch" value="1" name="cop" id="cop">
                                        <label for="form-check-label" class="text-dark">Action COP</label>
                                    </div> 
                                </div>  --}}
                        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                        Fermer
                                    </button>
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------ End Modal Add Action DC----------------------------------------------------->
    
 


<!------------------------------ Start Modal Add Action DR ----------------------------------------------------->
<div class="modal fade" id="addActionDRModal" tabindex="-1" aria-labelledby="addActionDRModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addActionDRModalLabel">Ajouter Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.add_actionDR') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Direction Régionale</span>
                                <input type="text" class="form-control" id="direction_regionale_input" readonly>
                                <input type="hidden" name="id_dr" id="id_dr">
                            </div> 

                            <div class="input-group mb-3">
                                <span class="input-group-text">code Action</span>
                                <input type="text" class="form-control" name="code_act" id="code_act">
                            </div>  

                            <div class="input-group mb-3">
                                <span class="input-group-text">Action</span>
                                <textarea class="form-control" name="lib_act" id="lib_act"></textarea>
                            </div>  
                    
                            <div class="input-group mb-3">
                                <span class="input-group-text">Date début</span>
                                <input type="date" class="form-control" name="dd" id="dd">
                            </div>  

                            <div class="input-group mb-3">
                                <span class="input-group-text">Date fin</span>
                                <input type="date" class="form-control" name="df" id="df">
                            </div>  
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                    Fermer
                                </button>
                                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!------------------------------ End Modal Add Action DR----------------------------------------------------->










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
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
    
    {{-- <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    
    <script src="{{asset('dist/js/bootstrap.min.js')}}"></script>

    <script>

//############################################### START DC PART ##########################################################//
/////////////////////////////////////////////////// Ajax Dc Selector //////////////////////////////

document.addEventListener("DOMContentLoaded", function() {
    const addActionButton = document.getElementById('addAction');
    addActionButton.addEventListener('click', function() {
    $('#addActionModal').modal('show');
    });
});


$(document).ready(function() {
    $('#DCselect').on('change', function () {
        $('#addAction').css('display', 'inline-block');
        var selectedDirectionId = $(this).val();
            // Update the value of the hidden input field with the selected direction's ID
            $('#id_dir').val(selectedDirectionId); 
        var dataTable = $('#zero_config').DataTable();  // DataTable instance
       
        $.ajax({
            type: 'GET',
            url: '{{ url('/admin/directionDc') }}/' + selectedDirectionId,
            success: function(response) 
            {
                console.log(response.actionsDc);
                // Clear DataTable
                dataTable.clear().draw();

                // Iterate through actionsDc array
                response.actionsDc.forEach(function(action) 
                {
                    var libPrio ="";
                    response.prioritaires.forEach(function(prio) 
                    {
                        if(action.id_p === prio.id_p)
                        {
                            libPrio = prio.lib_p; 
                        }
                    });
                
                    // Find the corresponding direction object
                    var correspondingDirection = response.directionsDc.find(function(direction) {
                        return action.id_dir === direction.id_dir;
                    });

                
                    if (correspondingDirection) {
                        // Populate the input field in the modal with lib_dir value
                        $('#structure_centrale_input').val(correspondingDirection.lib_dir);
                    }

                    // Add row to the DataTable
                    var startDate = new Date(action.dd);
                    var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
                    var endDate = new Date(action.df);
                    var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
                
                    var newRow = dataTable.row.add([
                        correspondingDirection ? correspondingDirection.lib_dir : '',
                        action.code_act,
                        action.lib_act,
                        formattedStartDate,
                        formattedEndDate,
                        libPrio,
                        '<div class="btn-group">' +
                            '<button class="btn btn-danger deleteRow" data-bs-toggle="modal" data-bs-target="#deleteActionModal' + action.id_act + '"><i class="fa-solid fa-trash"></i></button>' +
                            '<button class="btn btn-warning updateRow" data-bs-toggle="modal" data-bs-target="#updateActionModal' + action.id_act + '"><i class="fa-solid fa-pen-to-square"></i></button>' +
                            '<div class="modal fade" id="deleteActionModal' + action.id_act + '" tabindex="-1" aria-labelledby="deleteActionModalLabel" aria-hidden="true">' +
                                '<div class="modal-dialog">' +
                                    '<div class="modal-content">' +
                                        '<div class="modal-header">' +
                                            '<h5 class="modal-title" id="deleteActionModalLabel">Supprimer Action</h5>' +
                                            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                            '<p>Êtes-vous sûr de bien vouloir supprimer cette action ?</p>' +
                                        '</div>' +
                                        '<form id="deleteActionForm' + action.id_act + '" action="{{ route("admin.delete_actionDC") }}" method="POST">' +
                                            '@csrf' +
                                            '<input type="hidden" name="id_act" value="' + action.id_act + '">' +
                                            '<div class="modal-footer">' +
                                                '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>'+
                                                '<button type="submit" class="btn btn-danger" id="confirmDeleteAction' + action.id_act + '">Supprimer</button>' +
                                            '</div>' +
                                        '</form>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +

                            '<div class="modal fade" id="updateActionModal' + action.id_act + '" tabindex="-1" aria-labelledby="updateActionModalLabel" aria-hidden="true">' +
                                '<div class="modal-dialog">' +
                                    '<div class="modal-content">' +
                                        '<div class="modal-header">' +
                                            '<h5 class="modal-title" id="updateActionModalLabel">Modifier Action</h5>' +
                                            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                        '<form id="updateActionForm' + action.id_act + '" action="{{ route("admin.update_actionDC") }}" method="POST">' +
                                            '@csrf' +
                                            ' <div class="row">'+
                                                '<input type="hidden" name="id_act" value="' + action.id_act + '">' +
                                                '<div class="input-group mb-3">'+
                                                ' <span class="input-group-text">Action</span>'+
                                                ' <textarea class="form-control" name="lib_act" id="lib_act"></textarea>'+
                                                '</div>'+
                                                '<div class="input-group mb-3">'+
                                                   '<span class="input-group-text">Date début</span>'+
                                                    '<input type="date" class="form-control" name="dd" id="dd">'+
                                                '</div>'+
                                                '<div class="input-group mb-3">'+
                                                    '<span class="input-group-text">Date fin</span>'+
                                                  '<input type="date" class="form-control" name="df" id="df">'+
                                               '</div>'+
                                               ' <div class="input-group mb-3" id="selectedActionPrio">'+
                                                    '<div class="input-group">'+
                                                        '<label class="input-group-text" for="selectedActionPrio">Action prioritaire</label>'+
                                                        '<select class="form-select" name="act_prio" id="act_prio">'+
                                                            '<option disabled selected>Choisissez laction prioritaire </option>'+
                                                            '@foreach ($prioritaires as $prio)'+
                                                                '<option value="{{$prio->id_p}}">{{$prio->lib_p}}</option>'+
                                                            '@endforeach'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>'+
                                                    '<button type="submit" class="btn btn-warning" id="confirmUpdateAction' + action.id_act + '">Modifier</button>' +
                                                '</div>' +
                                            '</div>'+
                                        '</form>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>',
                    ]).draw(false).node();
                    newRow.id = action.id_act;

                    
                });
            
                // Show the modal after updating the input field
                //$('#addAction').modal('show');
            }
        });
    });
});



$(document).ready(function() {
    // Event listener for delete button click
    $('#zero_config').on('click', '.deleteRow', function() {
        var row = $(this).closest('tr');
        var id_act = row.attr('id');

        $('#deleteActionModal').modal('show');
        $('#confirmDeleteAction').data('id_act', id_act);
    });
});



$(document).ready(function() {
    // Event listener for delete button click
    $('#zero_config').on('click', '.updateRow', function() {
        var row = $(this).closest('tr');
        var id_act = row.attr('id');

        $('#updateActionModal').modal('show');
        $('#confirmUpdateAction').data('id_act', id_act);
    });
});



//############################################### END DC PART ###########################################################//
    
    
    
//############################################### START DR PART ##########################################################//
/////////////////////////////////////////////////// Ajax Dr Selector //////////////////////////////
document.addEventListener("DOMContentLoaded", function() {
    const addActionButton = document.getElementById('addActionDR');
    addActionButton.addEventListener('click', function() {
    $('#addActionDRModal').modal('show');
    });
});


$(document).ready(function() {
    $('#DRselect').on('change', function () {
        $('#addActionDR').css('display', 'inline-block');
        var selectedDirectionId = $(this).val();
            // Update the value of the hidden input field with the selected direction's ID
            $('#id_dr').val(selectedDirectionId); 
        var dataTable = $('#zero_config_dr').DataTable();  // DataTable instance
       
        $.ajax({
            type: 'GET',
            url: '{{ url('/admin/directionDr') }}/' + selectedDirectionId,
            success: function(response) 
            {
                console.log(response.actionsDr);
                
                dataTable.clear().draw();

                response.actionsDr.forEach(function(action) 
                {
                   
                    var correspondingDirection = response.directionsDr.find(function(direction) {
                        return action.id_dir === direction.id_dir;
                    });
                
                    if (correspondingDirection) {
                        $('#direction_regionale_input').val(correspondingDirection.lib_dir);
                    }

                    // Add row to the DataTable
                    var startDate = new Date(action.dd);
                    var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
                    var endDate = new Date(action.df);
                    var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
                
                    var newRow = dataTable.row.add([
                        correspondingDirection ? correspondingDirection.lib_dir : '',
                        action.code_act,
                        action.lib_act,
                        formattedStartDate,
                        formattedEndDate,
                        '<div class="btn-group">' +
                            '<button class="btn btn-danger deleteRowDR" data-bs-toggle="modal" data-bs-target="#deleteActionDRModal' + action.id_act + '"><i class="fa-solid fa-trash"></i></button>' +
                            '<button class="btn btn-warning updateRowDR" data-bs-toggle="modal" data-bs-target="#updateActionDRModal' + action.id_act + '"><i class="fa-solid fa-pen-to-square"></i></button>' +
                            '<div class="modal fade" id="deleteActionDRModal' + action.id_act + '" tabindex="-1" aria-labelledby="deleteActionDRModalLabel" aria-hidden="true">' +
                                '<div class="modal-dialog">' +
                                    '<div class="modal-content">' +
                                        '<div class="modal-header">' +
                                            '<h5 class="modal-title" id="deleteActionDRModalLabel">Supprimer Action</h5>' +
                                            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                            '<p>Êtes-vous sûr de bien vouloir supprimer cette action ?</p>' +
                                        '</div>' +
                                        '<form id="deleteActionDRForm' + action.id_act + '" action="{{ route("admin.delete_actionDR") }}" method="POST">' +
                                            '@csrf' +
                                            '<input type="hidden" name="id_act" value="' + action.id_act + '">' +
                                            '<div class="modal-footer">' +
                                                '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>'+
                                                '<button type="submit" class="btn btn-danger" id="confirmDeleteActionDR' + action.id_act + '">Supprimer</button>' +
                                            '</div>' +
                                        '</form>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +

                            '<div class="modal fade" id="updateActionDRModal' + action.id_act + '" tabindex="-1" aria-labelledby="updateActionDRModalLabel" aria-hidden="true">' +
                                '<div class="modal-dialog">' +
                                    '<div class="modal-content">' +
                                        '<div class="modal-header">' +
                                            '<h5 class="modal-title" id="updateActionDRModalLabel">Modifier Action</h5>' +
                                            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                        '<form id="updateActionDRForm' + action.id_act + '" action="{{ route("admin.update_actionDR") }}" method="POST">' +
                                            '@csrf' +
                                            ' <div class="row">'+
                                                '<input type="hidden" name="id_act" value="' + action.id_act + '">' +
                                                '<div class="input-group mb-3">'+
                                                ' <span class="input-group-text">Action</span>'+
                                                ' <textarea class="form-control" name="lib_act" id="lib_act"></textarea>'+
                                                '</div>'+
                                                '<div class="input-group mb-3">'+
                                                   '<span class="input-group-text">Date début</span>'+
                                                    '<input type="date" class="form-control" name="dd" id="dd">'+
                                                '</div>'+
                                                '<div class="input-group mb-3">'+
                                                    '<span class="input-group-text">Date fin</span>'+
                                                  '<input type="date" class="form-control" name="df" id="df">'+
                                               '</div>'+
                                                '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>'+
                                                    '<button type="submit" class="btn btn-warning" id="confirmUpdateActionDR' + action.id_act + '">Modifier</button>' +
                                                '</div>' +
                                            '</div>'+
                                        '</form>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>',
                    ]).draw(false).node();
                    newRow.id = action.id_act;

                    
                });
            
                // Show the modal after updating the input field
                //$('#addAction').modal('show');
            }
        });
    });
});



$(document).ready(function() {
    // Event listener for delete button click
    $('#zero_config_dr').on('click', '.deleteRowDR', function() {
        var row = $(this).closest('tr');
        var id_act = row.attr('id');

        $('#deleteActionDRModal').modal('show');
        $('#confirmDeleteActionDR').data('id_act', id_act);
    });
});



$(document).ready(function() {
    // Event listener for delete button click
    $('#zero_config_dr').on('click', '.updateRowDR', function() {
        var row = $(this).closest('tr');
        var id_act = row.attr('id');

        $('#updateActionDRModal').modal('show');
        $('#confirmUpdateActionDR').data('id_act', id_act);
    });
});
//############################################### END DR PART ##########################################################//
</script>
    
</body>
</html>