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
    <link href="../dist/css/style.min.css" rel="stylesheet">

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
                                    class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <li class="list-divider"></li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.users') }}" 
                                aria-expanded="false"><i data-feather="users" class="feather-icon"></i>
                                <span class="hide-menu">Gestion des utilisateurs</span>
                            </a>
                        </li>

                        <li class="list-divider"></li>

                        <li class="sidebar-item  selected">
                            <a class="sidebar-link" href="{{ route('admin.actions') }}" 
                                aria-expanded="false"><i data-feather="settings" class="feather-icon"></i>
                                <span class="hide-menu">Gestion des actions</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </aside>
        
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                    </div>
                </div>
            </div>

            <div class="container">
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
                                                        <button type="button" class="btn btn-success mr-2" id="addActionDc">
                                                            <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
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
                                                <div class="table-responsive">
                                                    <table id="zero_config_dr" class="table border">
                                                        <thead>
                                                            <tr class="text-light bg-info">
                                                                <th>Direction Régionale</th>
                                                                <th>Code action</th>
                                                                <th>Action</th>
                                                                <th>Date début</th>
                                                                <th>Date fin</th>
                                                                <th>Etat (Temps ecoulé / Avancement %)</th>
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

       
    //############################################### START COLOR FUNCTION ##########################################################//
    
        function colorTime (val)
        {
            if(val< 99.99) {actColorTime = 'bg-warning';}
            else           {actColorTime = 'bg-danger'; }
    
            return actColorTime;
        }
    
        function colorStat (val)
        {
            // if(val< 50) {actColorEtat = 'bg-warning';}
            // else        {actColorEtat = 'bg-success';}
            actColorEtat = 'bg-success';
    
            return actColorEtat;
        }
    
        function colorTimeText (val)
        {
            if(val< 99.99) {actColorTime = 'text-warning';}
            else           {actColorTime = 'text-danger'; }
    
            return actColorTime;
        }
    
        function colorStatText (val)
        {
            // if(val< 50) {actColorEtat = 'bg-warning';}
            // else        {actColorEtat = 'bg-success';}
            actColorEtat = 'text-success';
    
            return actColorEtat;
        }
    
    //################################################ END COLOR FUNCTION ###########################################################//
    
    
    
    //############################################### START DC PART ##########################################################//
    /////////////////////////////////////////////////// Ajax Dc Selector //////////////////////////////
        $(document).ready(function()
        {
            $('#DCselect').on('change', function ()
            {
    
                    /////////////////////////////////declaration/////////////////////////////
                    var directionId = $(this).val(); // id seleted direction
                    var dataTable = $('#zero_config').DataTable();  // data table
                    var progressBarTemp = document.getElementById("progres1"); // temp ecouler
                    var progressBarEtat = document.getElementById("progres2"); // avancement
                    ////////////////////////////////////////////////////////////////////////
    
                    $.ajax({
                    type: 'GET',
                    url: '{{ url('/admin/directionDc') }}/' + directionId,
                    success: function(response)
                    {
                        $('#etatEncDc').text(45);
                            $('#etatTermDc').text(45);
                            $('#etatRetDc').text(45);
                            $('#ToutT').text(45);
    
                        ///////////le nombre dactions Enc, Term, Ret////////////
                            var EtatEncDc = response.etatEncDc;
                            var EtatTermDc = response.etatTermDc;
                            var EtatRetDc = response.etatRetDc;
                            var NumcAtionsDc = response.numActionsDc;
                            var datePercentageDc = response.datePercentageDc;
    
                            console.log(response.actionsDc);
    
                            $('#etatEncDc').text(EtatEncDc);
                            $('#etatTermDc').text(EtatTermDc);
                            $('#etatRetDc').text(EtatRetDc);
                            $('#ToutT').text(NumcAtionsDc);
                        /////////////////////////////////////////////////////////////////////////////////
    
                        ////////////////////// les action Dans le tableau ////////////////////////////////
                        dataTable.clear().draw(); // vider le tableau
    
                        dataTable.on("draw.dt",function()
                        {
                            feather.replace();
                        });
    
                        // Add the row to the data table///////////////////////////////////
                        response.actionsDc.forEach(function(action)
                        {
                                var startDate = new Date(action.dd);
                                var endDate = new Date(action.df);
                                var currentDate = new Date();
    
                                var totalDuration = endDate.getTime() - startDate.getTime();
                                var tempEcolAct;
    
                                if (currentDate < startDate) {
                                    tempEcolAct = 0;
                                } else if (currentDate <= endDate) {
                                    var currentDuration = currentDate.getTime() - startDate.getTime();
                                    tempEcolAct = ((currentDuration / totalDuration) * 100);
                                } else {
                                    tempEcolAct = 100;
                                }
    
                            // tester les coleurs de progress bar de chaque action ///////////////////////////
                            actColorTime = colorTime (tempEcolAct);
                            actColorEtat = colorStat (action.etat);
    
                            if(action.etat == null)
                            {
                                // Generate HTML for the progress bar /////////////////////////////////////////////
                                var progressBarHTML = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-danger">' +tempEcolAct.toFixed(2)+ '%</div>' +
                                                '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar' +actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
    
                                            '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+0+'" style="width: ' + 0 + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                                        
                            }
                            else
                            {
    
                                // Generate HTML for the progress bar /////////////////////////////////////////////
                                var progressBarHTML = '<div style="width: 90% ">' +
                                                        '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                            '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                            '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                                '<div class="progress-bar '+actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                            '</div>' +
                                                        '</div>' +
    
                                                        '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                            '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +action.etat.toFixed(2)+ '%</span></div>' +
                                                            '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +action.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                                '<div class="progress-bar '+actColorEtat+'" style="width: ' + action.etat + '%"></div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>';
                            }
    
                            
    
                            // add the element to the table ///////////////////////////////////////////////////
    
    
                            //  get directions name ////////////////////////////////////////
                            response.directionsDc.forEach(function(direction)
                            {
                                if(action.id_dir == direction.id_dir)
                                {
                                    var startDate = new Date(action.dd);
    
                                    var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                                    var endDate = new Date(action.df);
    
                                    var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
    
                                    var newRow = dataTable.row.add([
                                    direction.lib_dir,
                                    action.code_act,
                                    action.lib_act,
                                    formattedStartDate,
                                    formattedEndDate,
                                    ]).draw(false).node();
                                    newRow.id = action.id_act;
    
                                }
                            });
                            //////////////////////////////////////////////////////////////////
                        });
    
                       
                        // progress bar set values /////////////////////////////////////////////////////////
    
                        progColorEtat = colorStat (response.AvncmDc);
    
                        progressBarEtat.style.width = ""+response.AvncmDc+"%";
                        progressBarEtat.setAttribute("aria-valuenow", ""+response.AvncmDc+"");
    
                        progressBarEtat.classList.forEach(function(className)
                        {
                            if (className.startsWith("bg-")) {progressBarEtat.classList.remove(className);}
                        });
                        progressBarEtat.classList.add(""+progColorEtat+"");
    
                        ////////////////////////////////////set text content ///////////////////////////////
                        ColorAvc = colorStatText (response.AvncmDc);
                        var avc = document.getElementById("avc");
    
                        avc.classList.forEach(function(className)
                        {
                            if (className.startsWith("text-")) {avc.classList.remove(className);}
                        });
    
                        avc.classList.add(""+ColorAvc+"");
    
                        avc.textContent = response.AvncmDc.toFixed(2)+'%';
                    //////////////////////////////////////////////////////////////////////////////////////////////// to copy
                }
                });
            });
        });
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //############################################### END DC PART ###########################################################//
    
    
    
    
    
    
    
    
    
    
    
    //############################################### START DR PART ##########################################################//
    /////////////////////////////////////////////////// Ajax Dr Selector //////////////////////////////
        $(document).ready(function()
        {
    
            $('#DRselect').on('change', function ()
            {
    
    
                    /////////////////////////////////declaration/////////////////////////////
                    var directionId = $(this).val(); // id seleted direction
                    var dataTable = $('#zero_config_dr').DataTable();  // data table
                    var progressBarTemp = document.getElementById("progres1Dr"); // temp ecouler
                    var progressBarEtat = document.getElementById("progres2Dr"); // avancement
                    ////////////////////////////////////////////////////////////////////////
    
                    $.ajax({
                    type: 'GET',
                    url: '{{ url('/admin/directionDr') }}/' + directionId,
                    success: function(response)
                    {
                        ///////////le nombre dactions Enc, Term, Ret////////////
                            var EtatEncDr = response.etatEncDr;
                            var EtatTermDr = response.etatTermDr;
                            var EtatRetDr = response.etatRetDr;
                            var NumcAtionsDr = response.numActionsDr;
                            // var datePercentageDr = response.datePercentageDr;
                            
    
                            console.log(response.actionsDr)
    
                            $('#etatEncDr').text(EtatEncDr);
                            $('#etatTermDr').text(EtatTermDr);
                            $('#etatRetDr').text(EtatRetDr);
                            $('#ToutTDr').text(NumcAtionsDr);
                        /////////////////////////////////////////////////////////////////////////////////
    
                        ////////////////////// les action Dans le tableau ////////////////////////////////
                        dataTable.clear().draw(); // vider le tableau
    
                        dataTable.on("draw.dt",function()
                        {
                            feather.replace();
                        });
    
                        // Add the row to the data table///////////////////////////////////
                        response.actionsDr.forEach(function(action)
                        {
    
                            var startDate = new Date(action.dd);
                            var endDate = new Date(action.df);
                            var currentDate = new Date();
    
                            var totalDuration = endDate.getTime() - startDate.getTime();
                            var tempEcolAct;
    
                            if (currentDate < startDate) {
                                tempEcolAct = 0;
                            } else if (currentDate <= endDate) {
                                var currentDuration = currentDate.getTime() - startDate.getTime();
                                tempEcolAct = ((currentDuration / totalDuration) * 100);
                            } else {
                                tempEcolAct = 100;
                            }
    
                        // tester les coleurs de progress bar de chaque action ///////////////////////////
                        actColorTime = colorTime (tempEcolAct);
                        actColorEtat = colorStat (action.etat);
    
                        if(action.etat == null)
                        {
                            // Generate HTML for the progress bar /////////////////////////////////////////////
                            var progressBarHTML = '<div style="width: 90% ">' +
                                        '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                            '<div class="fs-6 text-danger">' +tempEcolAct.toFixed(2)+ '%</div>' +
                                            '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                '<div class="progress-bar '+actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                            '</div>' +
                                        '</div>' +
    
                                        '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                            '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                            '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                '<div class="progress-bar '+0+'" style="width: ' + 0 + '%"></div>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>';
                                    
                        }
                        else
                        {
    
                            // Generate HTML for the progress bar /////////////////////////////////////////////
                            var progressBarHTML = '<div style="width: 90% ">' +
                                                    '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                        '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                        '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                            '<div class="progress-bar '+actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                        '</div>' +
                                                    '</div>' +
    
                                                    '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                        '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +action.etat.toFixed(2)+ '%</span></div>' +
                                                        '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +action.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                            '<div class="progress-bar '+actColorEtat+'" style="width: ' + action.etat + '%"></div>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>';
                        }feather.replace();
    
                            // add the element to the table ///////////////////////////////////////////////////
    
    
                            //  get directions name ////////////////////////////////////////
                            response.directionsDr.forEach(function(direction)
                        {
                            if(action.id_dir == direction.id_dir)
                            {
                                var startDate = new Date(action.dd);
    
                                var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                                var endDate = new Date(action.df);
    
                                var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                                var newRow = dataTable.row.add([
                                direction.lib_dir,
                                action.code_act,
                                action.lib_act,
                                formattedStartDate,
                                formattedEndDate,
                                progressBarHTML,
                                ]).draw(false).node();
                                newRow.id = action.id_act;
    
                            }
                        });
                            //////////////////////////////////////////////////////////////////
                        });
    
                       
    
                        // progress bar set values ///////////////////////////////////////////////////////////
                        progColorEtat = colorStat (response.AvncmDr);
    
                        progressBarEtat.style.width = ""+response.AvncmDr+"%";
                        progressBarEtat.setAttribute("aria-valuenow", ""+response.AvncmDr+"");
    
                        progressBarEtat.classList.forEach(function(className)
                        {
                            if (className.startsWith("bg-")) {progressBarEtat.classList.remove(className);}
                        });
                        progressBarEtat.classList.add(""+progColorEtat+"");
    
                        ////////////////////////////////////set text content ///////////////////////////////
                        ColorAvcDr = colorStatText (response.AvncmDr);
                        var avcDr = document.getElementById("avcDr");
    
                        avcDr.classList.forEach(function(className)
                        {
                            if (className.startsWith("text-")) {avcDr.classList.remove(className);}
                        });
    
                        avcDr.classList.add(""+ColorAvcDr+"");
    
                        avcDr.textContent = response.AvncmDr.toFixed(2)+'%';
    
                    //////////////////////////////////////////////////////////////////////////////////////////////////// to copy
                    }
                });
            });
        });
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
  
    //############################################### END DR PART ##########################################################//
    
    
    
    function formatDate(dateString) {
        var date = new Date(dateString);
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
    
        if (day < 10) {
            day = '0' + day;
        }
        if (month < 10) {
            month = '0' + month;
        }
    
        return day + '-' + month + '-' + year;
    }
    
    
//////////////////////////////////////////////////////////////////////////////////////////
    
        </script>
    
</body>
</html>