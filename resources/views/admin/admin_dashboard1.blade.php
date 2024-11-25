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
                        <li class="sidebar-item selected"> 
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

                        <li class="sidebar-item">
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
                            <li class="nav-item" role="presentation">
                                <a href="#Prioritaires" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0 active">
                                <i class="mdi mdi-home-variant d-block me-1"></i>
                                <span class="d-none d-lg-block">Actions Prioritaires</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation" >
                                <a href="#Centrale" name="zoomButton" data-bs-toggle="tab" aria-expanded="true"
                                class="nav-link rounded-0 ">
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
                            <li class="nav-item" role="presentation">
                                <a href="#cop" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0">
                                <i class="mdi mdi-settings-outline d-block me-1"></i>
                                <span class="d-none d-lg-block">COP</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#actAjust" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0">
                                <i class="mdi mdi-settings-outline d-block me-1"></i>
                                <span class="d-none d-lg-block">Actions ajustées</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
        {{--////////////////////////////////////////////////////////Div Prioritaires/////////////////////--}}
                            <div class="tab-pane mt-3 show active" id="Prioritaires">
                                <div class="row justify-content-between">
                                    <div class="col-7">
                                        <div class="row">
                                            {{-- Tous --}}
                                            <div class="col-sm-12 col-lg-10">
                                                <div class="card border border-info border-2">
                                                    <div class="card-body">
                                                        <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                            <div class="d-flex align-items-center justify-content-around">
                                                                <div id="buttonWrapper" class="clickable">
                                                                    <div class="d-inline-flex align-items-center">
                                                                        <h2 class="text-dark mb-1 font-weight-medium">{{$nmbr_act_p}}</h2>
                                                                    </div>
                                                                    <h4 class="font-weight-medium mb-0 w-100 text-dark mb-1"><span style="font-weight: bold;">Actions Prioritaires </span>: Macro-Actions</h4>
                                                                    <h4 class="font-weight-medium mb-0 w-100 text-dark">dont <span style="font-weight: bold;">{{$nmbr_act_p_}} / {{$numActDc}}</span> actions sous-jacentes</h4>
                                                                </div>
                                                                <div class="ms-3 mt-md-3 mt-lg-0">
                                                                    <span class="opacity-7 text-muted"><i data-feather="star" class="text-muted"></i></span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <h4 class="card-title text-muted fw-bold">Temps écoulé : <dive id="tmpPr" class="fw-bold"> {{$datePercentage}}% </dive></h4>
                                                        <div class="text-center mb-3">
                                                            <div  class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$datePercentage}}" aria-valuemin="0" aria-valuemax="100">
                                                                <div id="progres1Pr" class="progress-bar progress-bar-striped bg-danger progress-bar-animated" style="width: {{$datePercentage}}%"></div>
                                                            </div>
                                                        </div>

                                                        <h4 class="card-title text-muted fw-bold">Avancement : <dive id="avcPr" class="fw-bold"> {{$avncmt_act_p}}% </dive></h4>
                                                        <div class="text-center">
                                                            <div  class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$avncmt_act_p}}" aria-valuemin="0" aria-valuemax="100">
                                                                <div id="progres2Pr" class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: {{$avncmt_act_p}}%"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Toutes Les Actions</h4>
                                                <div id="morris-donut-chart-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-3">Les Actions Prioritaires</h4>
                                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                                @foreach($prioritaires as $prioritaire)
                                                    @php
                                                        $totalEtat = 0;
                                                        $etatCount = 0;
                                                        $etatP = 0;
                                                    @endphp

                                                    @foreach($act_p as $act)
                                                        @if ($act->id_p == $prioritaire->id_p)
                                                            @php
                                                                $totalEtat += $act->etat;
                                                                $etatCount++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    @if ($etatCount > 0)
                                                        @php
                                                            $etatP = $totalEtat / $etatCount ;
                                                            $etatP = number_format($etatP, 2);
                                                        @endphp
                                                    @endif

                                                    <div class="accordion-item mb-1">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button p-0" type="button" data-bs-toggle="collapse" data-bs-target="#a{{$prioritaire->id_p}}" aria-expanded="true" aria-controls="{{$prioritaire->id_p}}">
                                                                <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-info" style="z-index: 1">{{$prioritaire->id_p}}</span>
                                                                <ul class="list-group list-group-horizontal p-1" style="background-color: #dfe4fa; width: 100%;">
                                                                    <li class="list-group-item font-weight-medium text-dark" style="width: 75%; border: none;">{{$prioritaire->lib_p}}</li>
                                                                    <li class="list-group-item text-center" style="width: 25%;  border: none;">
                                                                        @if ($etatP != '')
                                                                            <div class="progress" role="progressbar" aria-label="animated striped example" aria-valuenow="{{$etatP}}" aria-valuemin="0" aria-valuemax="100">
                                                                                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" style="width: {{$etatP}}%">{{$etatP}}%</div>
                                                                            </div>
                                                                        @else
                                                                            <div class="progress" role="progressbar" aria-label="example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                                <div class="progress-bar" style="width: 0%"></div>
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                </ul>

                                                            </button>
                                                        </h2>

                                                        <div id="a{{$prioritaire->id_p}}" class="accordion-collapse collapse">
                                                            <div class="accordion-body">

                                                                <ul class="list-group list-group-horizontal text-center" style="background-color: rgba(44, 44, 44, 0.74);">
                                                                    <li class="list-group-item" style="width: 22%; color: #fff">Structure Centrale</li>
                                                                    <li class="list-group-item" style="width: 32%; color: #fff">Action</li>
                                                                    <li class="list-group-item" style="width: 12%; color: #fff">Date Debut</li>
                                                                    <li class="list-group-item" style="width: 12%; color: #fff">Date Fin</li>
                                                                    <li class="list-group-item" style="width: 9%;  color: #fff">Statut</li>
                                                                    <li class="list-group-item" style="width: 13%; color: #fff">Avancement (%)</li>
                                                                </ul>

                                                                <div class="accordion" id="accordion">
                                                                        @foreach($act_p as $act)
                                                                            @if ($act->id_p == $prioritaire->id_p)

                                                                                <ul class="list-group list-group-horizontal">


                                                                                    <div class="accordion-item " style="width: 100%;">
                                                                                        <h2 class="accordion-header">
                                                                                            <button class="accordion-button p-0" type="button" data-bs-toggle="collapse" data-bs-target="#b{{$act->id_act}}" aria-expanded="true" aria-controls="">
                                                                                                <ul class="list-group list-group-horizontal p-1" style="background-color: #ffffff; width: 100%;">




                                                                                                    <li class="list-group-item text-dark font-weight-medium" style="width: 22%; border: none;">

                                                                                                        @foreach ($directionsDc as $dir)

                                                                                                            @if ($dir->id_dir == $act->id_dir)
                                                                                                                {{$dir->lib_dir}}
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </li>
                                                                                                    <li class="list-group-item text-dark font-weight-medium" style="width: 32%; border: none;">{{$act->lib_act}}</li>
                                                                                                    <li class="list-group-item text-center" style="width: 12%; border: none;">{{date('d-m-Y', strtotime($act->dd))}}</li>
                                                                                                    <li class="list-group-item text-center" style="width: 12%; border: none;">{{date('d-m-Y', strtotime($act->df))}}</li>
                                                                                                    <li class="list-group-item text-center" style="width: 9%;  border: none;">
                                                                                                        @if ($act->etat == '100')
                                                                                                            <i data-feather="check-circle" class="feather-icon text-success"></i>
                                                                                                        @else
                                                                                                            @if($act->df >= $currentDate)
                                                                                                                <i data-feather="clock" class="feather-icon text-warning"></i>
                                                                                                            @else
                                                                                                                <i data-feather="pause-circle" class="feather-icon text-danger"></i>
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    </li>
                                                                                                    <li class="list-group-item text-center" style="width: 13%;  border: none;">
                                                                                                        @if ($act->etat  != '')

                                                                                                            <div class="d-flex" style="flex-direction: column">
                                                                                                                <div class="fs-6">{{$act->etat}}%</div>
                                                                                                                <div class="progress " role="progressbar" aria-label="example" aria-valuenow="{{$act->etat}}%" aria-valuemin="0" aria-valuemax="100">
                                                                                                                    <div class="progress-bar bg-success" style="width: {{$act->etat}}%"></div>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                        @else
                                                                                                            <div class="progress" role="progressbar" aria-label="example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                                                                <div class="progress-bar" style="width: 0%"></div>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    </li>

                                                                                                </ul>

                                                                                            </button>
                                                                                        </h2>



                                                                                            <div id="b{{$act->id_act}}" class="accordion-collapse collapse">
                                                                                                <div class="accordion-body" style="padding-top: 0;">

                                                                                                        <span class="badge text-dark p-0" style="z-index: 3; line-height: 33%;">
                                                                                                            . <br>.<br>.<br>.<br>.<br>.<br>.<br>.<br>.
                                                                                                        </span>

                                                                                                        <ul class="list-group list-group-horizontal text-center" style="background-color: #eeeeee71">
                                                                                                            <li class="list-group-item" style="width: 25%">Ce qui a été fait</li>
                                                                                                            <li class="list-group-item" style="width: 25%">Ce qui reste à faire</li>
                                                                                                            <li class="list-group-item" style="width: 25%">Contraintes</li>
                                                                                                            <li class="list-group-item" style="width: 13%">Date</li>
                                                                                                            <li class="list-group-item" style="width: 12%">Avancement (%)</li>
                                                                                                        </ul>
                                                                                                            @foreach($descriptions as $description)
                                                                                                                @if ($act->id_act == $description->id_act)
                                                                                                                    <ul class="list-group list-group-horizontal">
                                                                                                                        <li class="list-group-item text-dark" style="width: 25%">{{$description->faite}}</li>
                                                                                                                        <li class="list-group-item text-dark" style="width: 25%">{{$description->a_faire}}</li>
                                                                                                                        <li class="list-group-item text-dark" style="width: 25%">{{$description->probleme}}</li>
                                                                                                                        <li class="list-group-item" style="width: 13%">{{date('d-m-Y', strtotime($description->date))}}</li>
                                                                                                                        <li class="list-group-item" style="width: 12%">
                                                                                                                            <div class="d-flex" style="flex-direction: column">
                                                                                                                                <div class="fs-6">{{$description->etat}}%</div>
                                                                                                                                <div class="progress " role="progressbar" aria-label="example" aria-valuenow="{{$description->etat}}" aria-valuemin="0" aria-valuemax="100">
                                                                                                                                    <div class="progress-bar bg-success" style="width: {{$description->etat}}%"></div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                @endif
                                                                                                            @endforeach

                                                                                                </div>
                                                                                            </div>

                                                                                    </div>

                                                                                </ul>
                                                                            @endif
                                                                        @endforeach
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

        {{--////////////////////////////////////////////////////////Div Centrale/////////////////////////--}}
                            <div class="tab-pane  " id="Centrale">

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">

                                                {{-- Select DR --}}
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

                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="card border-end" style="background: linear-gradient(to right, #f0833ac7, #ffffff);">
                                                        <div class="card-body">
                                                            <a href="#" id="Encour" type="btn" style="text-decoration: none;" onclick="getdata('E')">
                                                                <div class="d-flex align-items-center">
                                                                    <div id="buttonWrapper" class="clickable">
                                                                        <div class="d-inline-flex align-items-center">
                                                                            <h2 class="text-dark mb-1 font-weight-medium" id="etatEncDc">{{$etatEncDC}}</h2>
                                                                        </div>
                                                                        <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions En Cours</h6>
                                                                    </div>

                                                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                                                        <span class="opacity-7 text-muted">
                                                                            <div class="balls">
                                                                                <div></div>
                                                                                <div></div>
                                                                                <div></div>
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="card border-end" style="background: linear-gradient(to right, #2bff3db9, #ffffff);">
                                                        <div class="card-body">
                                                            <a href="#" id="Terminer" type="btn" style="text-decoration: none;" onclick="getdata('T')">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatTermDc">{{$etatTermDC}}</h2>
                                                                        <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions Finalisées
                                                                        </h6>
                                                                    </div>
                                                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                                                        <span class="opacity-7 text-muted"><i data-feather="check-circle" class="text-dark"></i></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="card border-end " style="background: linear-gradient(to right, #f83832c7, #ffffff);">
                                                        <div class="card-body">
                                                            <a href="#" id="Retarder" type="btn" style="text-decoration: none;" onclick="getdata('R')">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatRetDc">{{$etatRetDC}}</h2>
                                                                        <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions Echues
                                                                        </h6>
                                                                    </div>
                                                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                                                        <span class="opacity-7 text-dark"><i class="fa-solid fa-hourglass-end fa-xl"></i></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="card border-end">
                                                        <div class="card-body border border-dark border-2">
                                                            <a href="#" id="Tout" type="btn" style="text-decoration: none;" onclick="getdata('Tous')">
                                                                <div class="d-flex align-items-center">
                                                                    <div id="buttonWrapper" class="clickable">
                                                                        <div class="d-inline-flex align-items-center">
                                                                            <h2 class="text-dark mb-1 font-weight-medium" id='ToutT'>{{$numActDc}}</h2>
                                                                        </div>
                                                                        <h6 class="font-weight-medium mb-0 w-100 text-dark">Toutes les actions</h6>
                                                                    </div>

                                                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                                                        <span class="opacity-7 text-muted"><i data-feather="layers" class="text-dark"></i></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="width: 65%"  >

                                                    <div class="row ">
                                                        <div class="col-md-6 ">
                                                            <h5>Temp Écoulé : <dive id="tmp" class="fw-bold"> {{$datePercentage}}% </dive> </h5>
                                                        </div>
                                                        
                                                        <div class="col-md-13">
                                                            <div class="progress">
                                                                <div id="progres1" class="progress-bar progress-bar-striped bg-warning " role="progressbar" style="width: {{$datePercentage}}%" aria-valuenow="{{$datePercentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <h5>Avancement : <dive id="avc" class="fw-bold"> {{$AvancementDc}}% </dive> </h5>
                                                        </div>
                                                        <div class="col-md-13">
                                                            <div class="progress">
                                                                <div id="progres2" class="progress-bar progress-bar-striped bg-danger" role="progressbar" style= "width: {{$AvancementDc}}%;" aria-valuenow="{{$AvancementDc}}%" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Toutes Les Actions</h4>
                                                <div id="morris-donut-chart"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="zero_config" class="table border">
                                                        <thead>
                                                            <tr class="font-weight-medium text-light bg-info">
                                                                <th>Structure Centrale</th>
                                                                <th>Action</th>
                                                                <th>Date début</th>
                                                                <th>Date fin</th>
                                                                <th>Etat (Temps ecoulé / Avancement %)</th>
                                                            </tr>
                                                        </thead>


                                                    </table>
                                                </div>
                                                <a id="downButtonDc" name = "DTous" type="button" class="btn btn-success" href="#">Télécharger</a>
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
                                                {{-- Select DR --}}
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

                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="card border-end" style="background: linear-gradient(to right, #f0833ac7, #ffffff);">
                                                        <div class="card-body">
                                                            <a href="#" id="EncourDr" type="btn" style="text-decoration: none;" onclick="getdataDr('E')">
                                                                <div class="d-flex align-items-center">
                                                                    <div id="buttonWrapper" class="clickable">
                                                                        <div class="d-inline-flex align-items-center">
                                                                            <h2 class="text-dark mb-1 font-weight-medium" id="etatEncDr">{{$etatEncDR}}</h2>
                                                                        </div>
                                                                        <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions En Cours</h6>
                                                                    </div>

                                                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                                                        <span class="opacity-7 text-muted">
                                                                            <div class="balls">
                                                                                <div></div>
                                                                                <div></div>
                                                                                <div></div>
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="card border-end " style="background: linear-gradient(to right, #2bff3db9, #ffffff);">
                                                        <div class="card-body">
                                                            <a href="#" id="TerminerDr" type="btn" style="text-decoration: none;" onclick="getdataDr('T')">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatTermDr">{{$etatTermDR}}</h2>
                                                                        <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions Finalisées
                                                                        </h6>
                                                                    </div>
                                                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                                                        <span class="opacity-7 text-muted"><i data-feather="check-circle" class="text-dark"></i></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="card border-end " style="background: linear-gradient(to right, #f83832c7, #ffffff);">
                                                        <div class="card-body">
                                                            <a href="#" id="RetarderDr" type="btn" style="text-decoration: none;" onclick="getdataDr('R')">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatRetDr">{{$etatRetDC}}</h2>
                                                                        <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions Echues
                                                                        </h6>
                                                                    </div>
                                                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                                                        <span class="opacity-7 text-dark"><i class="fa-solid fa-hourglass-end fa-xl"></i></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="card border border-dark border-2">
                                                        <div class="card-body">
                                                            <a href="#" id="ToutDr" type="btn" style="text-decoration: none;" onclick="getdataDr('Tous')">
                                                                <div class="d-flex align-items-center">
                                                                    <div id="buttonWrapper" class="clickable">
                                                                        <div class="d-inline-flex align-items-center">
                                                                            <h2 class="text-dark mb-1 font-weight-medium" id='ToutTDr'>{{$numActDr}}</h2>
                                                                        </div>
                                                                        <h6 class="font-weight-medium mb-0 w-100 text-dark">Toutes les actions</h6>
                                                                    </div>

                                                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                                                        <span class="opacity-7 text-muted"><i data-feather="layers" class="text-dark"></i></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="width: 65%"  >

                                                    <div class="row">
                                                        <div class="col-md-6 ">
                                                            <h5>Temp Écoulé : <dive id="tmpDr" class="fw-bold"> {{$datePercentage}}% </dive> </h5>
                                                        </div>
                                                        
                                                        <div class="col-md-13">
                                                            <div class="progress">
                                                                <div id="progres1Dr" class="progress-bar progress-bar-striped bg-warning " role="progressbar" style="width: {{$datePercentage}}%" aria-valuenow="{{$datePercentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <h5>Avancement : <dive id="avcDr" class="fw-bold"> {{$AvancementDr}}% </dive> </h5>
                                                        </div>
                                                        <div class="col-md-13">
                                                            <div class="progress">
                                                                <div id="progres2Dr" class="progress-bar progress-bar-striped bg-danger" role="progressbar" style= "width: {{$AvancementDr}}%;" aria-valuenow="{{$AvancementDr}}%" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Toutes Les Actions</h4>
                                                <div id="morris-donut-chart-2"></div>
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
                                                                <th>Action</th>
                                                                <th>Date début</th>
                                                                <th>Date fin</th>
                                                                <th>Etat (Temps ecoulé / Avancement %)</th>
                                                            </tr>
                                                        </thead>


                                                    </table>
                                                </div>
                                                <a id="downButtonDr" name = "DTous" type="button" class="btn btn-success" href="#">Télécharger</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
        {{-- ////////////////////////////////////////////////////////Div COP////////////////////////--}}
                            <div class="tab-pane" id="cop">
                                <div class="row">
                                    <a type="button" id="fixedButton" class="btn" href="{{ route('Model.Indicateur') }}">Modèle de fiche d'indicateur</a>
                                    <div class="col-8">
                                        <ul class="nav nav-pills mt-5">
                                            <li class="nav-item" role="presentation">
                                                <a href="#c" data-bs-toggle="tab" aria-expanded="false"
                                                class="nav-link rounded-0 active">
                                                <i class="mdi mdi-home-variant d-block me-1"></i>
                                                <span class="d-none d-lg-block">Structures Centrales</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#r" data-bs-toggle="tab" aria-expanded="true"
                                                class="nav-link rounded-0 ">
                                                <i class="mdi mdi-account-circle d-block me-1"></i>
                                                <span class="d-none d-lg-block">Directions Régionales</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>


                                        <div class="tab-content">

                                            <div class="tab-pane show active" id="c">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="card border-end ">
                                                            <div class="card-body">
                                                                <div class="col-lg-3">
                                                                    <div class="card border border-info border-2">
                                                                        <div class="card-body">
                                                                            <a href="#" id="myLinkC" type="btn" style="text-decoration: none;">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div id="buttonWrapper" class="clickable">
                                                                                        <div class="d-inline-flex align-items-center">
                                                                                            <h2 class="text-dark mb-1 font-weight-medium">{{$NbActCop}}</h2>
                                                                                        </div>
                                                                                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Toutes Les Actions</h6>
                                                                                    </div>
                                                                                    <div class="ms-auto mt-md-3 mt-lg-0">
                                                                                        <span class="opacity-7 text-muted"><i data-feather="home" class="text-muted"></i></span>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h5 class="card-title mb-3">Objectifs Stratégiques</h5>
                                                                    <div class="accordion" id="accordionExample">
                                                                        @foreach($objectifs as $obj)
                                                                            <div class="accordion-item mb-2">

                                                                                <h2 class="accordion-header">
                                                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{$obj->id_obj}}" aria-expanded="true" aria-controls="{{$obj->id_obj}}">
                                                                                        {{ $obj->lib_obj }}
                                                                                    </button>
                                                                                </h2>

                                                                                <div id="{{$obj->id_obj}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                                                    <div class="accordion-body details-content">

                                                                                        <table class="table border text-dark" id="zero_cop_{{$obj->id_obj}}">

                                                                                            <thead style="background-color: rgba(44, 44, 44, 0.74); color: #fff" class="text-center">
                                                                                                <tr>
                                                                                                    <th>Sous Objectif</th>
                                                                                                    <th>Action</th>
                                                                                                    <th>Indicateur de Performance</th>
                                                                                                    <th>Date début</th>
                                                                                                    <th>Date fin</th>
                                                                                                    <th>Structure Centrale</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach($obj->SousObjectif as $sousObj)
                                                                                                    @foreach($sousObj->ActionsCop as $action)
                                                                                                        <tr id="{{ $action->id_act}}" style="background-color: #f7f7f7">
                                                                                                            <td class="font-weight-medium">{{ $sousObj->lib_sous_obj }}</td>
                                                                                                            <td class="font-weight-medium" style="width: 30%;">{{ $action->lib_act_cop }}</td>
                                                                                                            <td class="font-weight-medium">
                                                                                                                @foreach($action->ActCopInd as $actCopInd)
                                                                                                                    <button type="button" class="" style="background-color: transparent; border: none; box-shadow: none;"
                                                                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                                                                        data-bs-custom-class="custom-tooltip"
                                                                                                                        data-bs-title="{{$actCopInd->Indicateur->formule}}.">
                                                                                                                        <span><a class="link-offset-2 link-underline">{{$actCopInd->Indicateur->lib_ind}}</a></span>
                                                                                                                    </button>
                                                                                                                @endforeach
                                                                                                            </td>
                                                                                                            <td>{{ date('d-m-Y', strtotime($action->dd)) }}</td>
                                                                                                            <td>{{ date('d-m-Y', strtotime($action->df)) }}</td>
                                                                                                            <td>{{$action->lib_dc}}</td>
                                                                                                        </tr>
                                                                                                    @endforeach
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="tab-pane" id="r">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row ">
                                                            <div class="col-lg-8 mt-2 ">
                                                                <div class="card border-end">
                                                                    <div class="customize-input float-start" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                                                                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" id="COPDRselect">
                                                                        <option value="all" selected> Directions Regionales</option>
                                                                            @foreach ($directionsDr as $direction)
                                                                                <option value="{{ $direction->id_dir }}">{{ $direction->code }} - {{ $direction->lib_dir }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table id="zero_cop_dr" class="table border">
                                                                                <thead style="background-color: rgba(44, 44, 44, 0.74); color: #fff" class="text-center">
                                                                                    <tr>
                                                                                        <th>Objectif Stratégique</th>
                                                                                        <th>Sous Objectif</th>
                                                                                        <th>Action</th>
                                                                                        <th>Indicateur</th>
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
                                                </div>
                                            </div>


                                        </div>


                                </div>


                            </div>


                            {{-- //////////////////////////////////////////////////////// START Div actPro////////////////////////--}}
                            <div class="tab-pane" id="actAjust">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="col-lg-12 mt-2 ">
                                                <div class="card border-end">
                                                    <div class="customize-input float-start">
                                                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" id="DRselectAjust">

                                                        <option value="all" selected> Directions Régionales</option>
                                                            @foreach ($directionsDr as $direction)
                                                                <option value="{{ $direction->id_dir }}">{{ $direction->code }} - {{ $direction->lib_dir }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="zero_act_pro" class="table border">
                                                        <thead>
                                                            <tr>
                                                                <th>Structure Centrale</th>
                                                                <th>Action Ajustée</th>
                                                                <th>Date Début</th>
                                                                <th>Date Fin</th>
                                                                <th>Direction Régionale</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($actpro as $act)
                                                                <tr>
                                                                    <td>{{ $act['structure'] }}</td>
                                                                    <td>{{ $act['action'] }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($act['dd'])) }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($act['df'])) }}</td>
                                                                    <td>{{ $act['dr'] }}</td>
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
                    
        {{-- //////////////////////////////////////////////////////// END Div actPro////////////////////////--}}







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

        $(document).ready(function(){
            $('#zero_act_pro').DataTable();
        });
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
    
                        ////////////////////////////////////////////////////////////////////////////////////////
    
                       
                    ////////////////////////////////////////////////////////////////////////////////////////////////// to copy 
    
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
    
    //////////////////////////////////////////////// get sub table DC //////////////////////////////////
        $(document).ready(function()
        {
            var dataTable = $('#zero_config').DataTable();
    
            // Function to create sub-table HTML for each row /////////////////////////////////////////
            function format(infos) {
                var html = '<table class="table subtable" style="background-color:#f0f3ff;">' +
                '<thead style="background-color:#d7ddf8">' +
                '<tr style="color:#6c6c6c;">' +
                '<th style="width: 25% !important;">Ce qui a été fait</th>' +
                '<th style="width: 25% !important;">Ce qui reste a faire</th>' +
                '<th style="width: 25% !important;">Contraintes</th>' +
                '<th style="width: 15% !important;">Date</th>' +
                '<th style="width: 10% !important;">Avancement(%)</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody >';
    
                infos.forEach(function(info)
                {
                    var date = new Date(info.date);
                    var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                    
    
                    html += '<tr>' +
                                '<td class="td1">' + info.faite + '</td>' +
                                '<td class="td2">' + info.a_faire + '</td>' +
                                '<td class="td3">' + info.probleme + '</td>' +
                                '<td class="td4">' + formattedDate + '</td>' +
                                '<td class="td5"> '+ '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                        '<div class="fs-6 text-success">' +info.etat.toFixed(2)+ '%</div>' +
                                                        '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                            '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                                        '</div>' +
                                                    '</div>' +
                                '</td>' +
                        '</tr>';
                });
    
                html += '</tbody>' + '</table>';
                return html;
            }
    
            // Event listener to toggle child rows //////////////////////////
            $('#zero_config tbody').on('click', 'td', function()
            {
                var tr = $(this).closest('tr');
                var row = dataTable.row(tr);
    
                var act = $(this).closest('tr').attr('id');
    
                if (row.child.isShown())
                {
    
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else
                {
                    // Close any open rows
                    dataTable.rows().every(function() {
                        if (this.child.isShown())
                        {
                            this.child.hide();
                            $(this.node()).removeClass('shown');
                        }
                    });
    
                    $.ajax({
                        type: 'GET',
                        url: '{{ url("/admin/ActionInfo") }}/' + act,
                        success: function(response)
                        {
    
                            var subtableHtml = format(response.infos);
                            row.child(subtableHtml).show();
                            tr.addClass('shown');
                        },
                        error: function(xhr, status, error)
                        {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
            });
        });
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //////////////////////////////////////////////// Ajax Button DC ////////////////////////////////////
        function getdata(btn)
        {
                var directionId = $('#DCselect').val();
                var dataTable = $('#zero_config').DataTable();
    
                 /////////////////////////// DC ////////////////////////////////////
                var downButton = document.getElementById("downButtonDc");
                downButton.setAttribute("name", 'D'+btn);
                ///////////////////////////////////////////////////////////////////
    
                $.ajax({
                    type: 'GET',
                    url: '{{ url("/admin/ActionBtn") }}/' + directionId + '/' + btn,
                    success: function(response)
                    {
    
                        dataTable.clear().draw();
    
                    response.actionsFiltre.forEach(function(action)
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
                }
                })
        }
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////// DownButtonDc ///////////////////////////////////////
        document.getElementById('downButtonDc').addEventListener('click', function()
        {
                var directionId = $('#DCselect').val();
                var downButtonDc = document.getElementById('downButtonDc')
                var downNameDc = downButtonDc.getAttribute("name");
    
                var downloadUrl = "{{ route('downloadDcAdmin', ['IdSelect' => ':IdSelect', 'Name' => ':Name']) }}";
                downloadUrl = downloadUrl.replace(':IdSelect', directionId).replace(':Name', downNameDc);
    
                window.location.href = downloadUrl;
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
    
                        ////////////////////////////////////////////////////////////////////////////////////////
    
                        
                        //////////////////////////////////////////////////////////////////////////////////////////////////// to copy
    
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
    
    //////////////////////////////////////////////// get sub table DR //////////////////////////////////
        $(document).ready(function()
        {
            var dataTable = $('#zero_config_dr').DataTable();
    
            // Function to create sub-table HTML for each row /////////////////////////////////////////
            function format(infos) {
                var html = '<table class="table subtable" style="background-color:#f0f3ff;">' +
                '<thead style="background-color:#d7ddf8">' +
                '<tr style="color:#6c6c6c;">' +
                '<th style="width: 25% !important;">Ce qui a été fait</th>' +
                '<th style="width: 25% !important;">Ce qui reste a faire</th>' +
                '<th style="width: 25% !important;">Contraintes</th>' +
                '<th style="width: 15% !important;">Date</th>' +
                '<th style="width: ;">Avancement(%)</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody style="width: 100px;">';
    
                infos.forEach(function(info)
                {
                    var date = new Date(info.date);
                    // Formatting the date to "d-m-Y" format
                    var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                    html += '<tr>' +
                                '<td class="td1dr">' + info.faite + '</td>' +
                                '<td class="td2dr">' + info.a_faire + '</td>' +
                                '<td class="td3dr">' + info.probleme + '</td>' +
                                '<td class="td4dr">' + formattedDate + '</td>' +
                                '<td class="td5"> '+ '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                        '<div class="fs-6 text-success">' +info.etat.toFixed(2)+ '%</div>' +
                                                        '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                            '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                                        '</div>' +
                                                    '</div>' +
                                '</td>' +
                            '</tr>';
                });
    
                html += '</tbody>' + '</table>';
                return html;
            }
    
            // Event listener to toggle child rows //////////////////////////
            $('#zero_config_dr tbody').on('click', 'td', function()
            {
                var tr = $(this).closest('tr');
                var row = dataTable.row(tr);
    
                var act = $(this).closest('tr').attr('id');
    
                if (row.child.isShown())
                {
    
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else
                {
                    // Close any open rows
                    dataTable.rows().every(function() {
                        if (this.child.isShown())
                        {
                            this.child.hide();
                            $(this.node()).removeClass('shown');
                        }
                    });
    
                    $.ajax({
                        type: 'GET',
                        url: '{{ url("/admin/ActionInfo") }}/' + act,
                        success: function(response)
                        {
    
                            var subtableHtml = format(response.infos);
                            row.child(subtableHtml).show();
                            tr.addClass('shown');
                        },
                        error: function(xhr, status, error)
                        {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
            });
        });
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //////////////////////////////////////////////// Ajax Button DR ////////////////////////////////////
        function getdataDr(btn)
        {
                var directionId = $('#DRselect').val();
                var dataTable = $('#zero_config_dr').DataTable();
    
                /////////////////////////// DR ////////////////////////////////////
                var downButton = document.getElementById("downButtonDr");
                downButton.setAttribute("name", 'D'+btn);
                ///////////////////////////////////////////////////////////////////
    
                $.ajax({
                    type: 'GET',
                    url: '{{ url("/admin/ActionBtnDr") }}/' + directionId + '/' + btn,
                    success: function(response)
                    {
    
                        dataTable.clear().draw();
    
                    response.actionsFiltre.forEach(function(action)
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
                                    feather.replace();
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
                }
                })
        }
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// DownButtonDr ///////////////////////////////////////
        document.getElementById('downButtonDr').addEventListener('click', function()
        {
                var directionId = $('#DRselect').val();
                var downButtonDr = document.getElementById('downButtonDr')
                var downNameDr = downButtonDr.getAttribute("name");
    
                console.log(downNameDr);
    
                var downloadUrl = "{{ route('downloadDrAdmin', ['IdSelect' => ':IdSelect', 'Name' => ':Name']) }}";
                downloadUrl = downloadUrl.replace(':IdSelect', directionId).replace(':Name', downNameDr);
    
                window.location.href = downloadUrl;
        });
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    //############################################### END DR PART ##########################################################//
    
    
    //################################################ START COP PART ######################################################//
    
    //////////////////////////////////////////////// get sub table COP //////////////////////////////////
        $(document).ready(function() {
            var obj = {!! json_encode($object) !!};
            var len = obj.length;
    
            $(function () {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });
    
            // Function to create sub-table HTML for each row
            function format(infos) {
                var html = '<table class="table subtable">' +
                    '<thead class="bg-info" style="color: #fff">' +
                    '<tr>' +
                    '<th scope="col">Ce qui a été fait</th>' +
                    '<th scope="col">Ce qui reste à faire</th>' +
                    '<th scope="col">Contraintes</th>' +
                    '<th scope="col">Date</th>' +
                    '<th scope="col" style="width:10%;">Etat</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
    
                infos.forEach(function(info) {
                    var date = new Date(info.date);
                    // Formatting the date to "d-m-Y" format
                    var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                    html += '<tr style="background-color:#d7ddf8">' +
                        '<td scope="col">' + info.faite + '</td>' +
                        '<td scope="col">' + info.a_faire + '</td>' +
                        '<td scope="col">' + info.probleme + '</td>' +
                        '<td scope="col">' + formattedDate + '</td>' +
                        '<td scope="col">' +
    
                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                    '<div class="fs-6 text-dark">' +info.etat.toFixed(0)+ '%</div>' +
                                    '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                        '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                    '</div>' +
                            '</div>' +
                            
    
    
    
                        '</td>' +
                        '</tr>';
                });
    
                html += '</tbody>' + '</table>';
                return html;
            }
    
            for (var i = 1; i <= len; i++) {
                (function(index) {
                    var dataTable = $('#zero_cop_' + index).DataTable();
    
                    // Event listener to toggle child rows
                    $('#zero_cop_' + index + ' tbody').on('click', 'tr', function() {
                        var tr = $(this);
                        var row = dataTable.row(tr);
                        var act = tr.attr('id');
    
                        if (row.child.isShown()) {
                            row.child.hide();
                            tr.removeClass('shown');
                        } else {
                            // Close any open rows
                            dataTable.rows().every(function() {
                                if (this.child.isShown()) {
                                    this.child.hide();
                                    $(this.node()).removeClass('shown');
                                }
                            });
    
                            $.ajax({
                                type: 'GET',
                                url: '{{ url("/admin/ActionInfo") }}/' + (act + 10000),
                                success: function(response) {
                                    var subtableHtml = format(response.infos);
                                    row.child(subtableHtml).show();
                                    tr.addClass('shown');
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error fetching data:', error);
                                }
                            });
                        }
                    });
                    dataTable.on('draw.dt', function () {
                        $('[data-bs-toggle="tooltip"]').tooltip();
                    });
                })(i);
            }
        });
    
    
    /////////////////////////////////////////////////// Ajax COP DR Selector //////////////////////////////
    $(document).ready(function() {
        var dataTable = $('#zero_cop_dr').DataTable({
            // Define DataTables configuration options here
        });
    
        // Event handler for hovering over an indicator
        $('#zero_cop_dr tbody').on('mouseover', 'td:nth-child(6) button', function () {
            var rowIndex = dataTable.cell(this).index().row;
            var rowData = dataTable.row(rowIndex).data();
            var formule = rowData[6]; // Assuming the formule is in the 7th column
    
            // Display formule in a tooltip
            $(this).attr('title', formule);
        });
    
        // Event handler for COPDRselect change
        $('#COPDRselect').on('change', function () {
            var directionDrId = $(this).val();
            dataTable.clear().draw();
    
            $.ajax({
                type: 'GET',
                url: '{{ url("/admin/directionCopDr") }}/' + directionDrId,
                success: function(response) {
                    response.data.forEach(function(rowcop) {
                        
                        var startDate = new Date(rowcop.date_debut);
    
                        var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                        var endDate = new Date(rowcop.date_fin);
    
                        var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
    
                        // Apply style to indicateursWithLineBreaks
                        var indicateursWithLineBreaks = '<span><button type="button" class="btn btn-link link-offset-2" style="text-decoration: none;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="' + rowcop.formules + '">' + rowcop.indicateurs.replace(/,/g, '<br>') + '</button></span>';
    
                        var newRow = dataTable.row.add([
                            rowcop.objectif,
                            rowcop.sous_objectif,
                            rowcop.action,
                            indicateursWithLineBreaks,
                            formattedStartDate,
                            formattedEndDate,
                        ]).draw(false).node();
                        newRow.id = rowcop.id_act;
                    });
    
                    // Initialize tooltips for newly added indicators
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        });
    });
    
    
    
    
    
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
    
     //////////////////////////////////////////////// get sub table COP DR //////////////////////////////////
     $(document).ready(function()
        {
            var dataTable = $('#zero_cop_dr').DataTable();
    
            // Function to create sub-table HTML for each row /////////////////////////////////////////
            function format(infos) {
                var html = '<table class="table subtable">' +
                '<thead style="background-color:#d7ddf8">' +
                '<tr>' +
                '<th style="width: 25% !important;">Ce qui a été fait</th>' +
                '<th style="width: 25% !important;">Ce qui reste a faire</th>' +
                '<th style="width: 25% !important;">Contraintes</th>' +
                '<th style="width: 15% !important;">Date</th>' +
                '<th style="width: 10% !important;">Avancement(%)</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody style="width: 100px;">';
    
                infos.forEach(function(info)
                {
                    var date = new Date(info.date);
                    // Formatting the date to "d-m-Y" format
                    var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                    html += '<tr  style="width: 100px;">' +
                        '<td class="td1dr">' + info.faite + '</td>' +
                        '<td class="td2dr">' + info.a_faire + '</td>' +
                        '<td class="td3dr">' + info.probleme + '</td>' +
                        '<td class="td4dr">' + formattedDate + '</td>' +
                        '<td class="td5dr"> '+' <div class="progress mt-6 pgbdr">' +
                                    '<div class="progress-bar bg-success" role="progressbar" style="width: ' + info.etat+ '%;" aria-valuenow="' + info.etat + '" aria-valuemin="0" aria-valuemax="' + 100 + '">' + info.etat + '</div>' +
                                    '</div>'+'</td>' +
                        '</tr>';
                });
    
                html += '</tbody>' + '</table>';
                return html;
            }
    
            // Event listener to toggle child rows //////////////////////////
            $('#zero_cop_dr tbody').on('click', 'td', function()
            {
                var tr = $(this).closest('tr');
                var row = dataTable.row(tr);
    
                var act = $(this).closest('tr').attr('id');
    
                if (row.child.isShown())
                {
    
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else
                {
                    // Close any open rows
                    dataTable.rows().every(function() {
                        if (this.child.isShown())
                        {
                            this.child.hide();
                            $(this.node()).removeClass('shown');
                        }
                    });
    
                    $.ajax({
                        type: 'GET',
                        ///////////////////////////////////////////////////////// WE NEED TO CHANGE THIS /////////////////////////////////////////
                        url: '{{ url("/admin/ActionInfo") }}/' + (act + 10000),
    
                        ///////////////////////////////////////////////////////// WE NEED TO CHANGE THIS /////////////////////////////////////////
                        success: function(response)
                        {
    
                            var subtableHtml = format(response.infos);
                            row.child(subtableHtml).show();
                            tr.addClass('shown');
                        },
                        error: function(xhr, status, error)
                        {
                            console.error('Error fetching data:', error);
                        }
                    });
                }
            });
        });
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //################################################ END COP PART ########################################################//
    
    //////////////////////////////////////////////////// load page pro /////////////////////////////////////////////////
    
            var datePercentage= {{ $datePercentage }};
            var avncmt_act_p= {{ $avncmt_act_p }};
    
            var progressOnePr = document.getElementById("progres1Pr");
            var progressTowPr = document.getElementById("progres2Pr");
    
            ColorTimPr = colorTime (datePercentage);
            ColorEtatPr = colorStat (avncmt_act_p);
    
            progressOnePr.style.width = ""+datePercentage+"%";
            progressTowPr.style.width = ""+avncmt_act_p+"%";
    
            progressOnePr.setAttribute("aria-valuenow", ""+datePercentage+"");
            progressTowPr.setAttribute("aria-valuenow", ""+avncmt_act_p+"");
    
            progressOnePr.classList.forEach(function(className)
            {
                if (className.startsWith("bg-")) {progressOnePr.classList.remove(className);}
            });
    
            progressTowPr.classList.forEach(function(className)
            {
                if (className.startsWith("bg-")) {progressTowPr.classList.remove(className);}
            });
    
            progressOnePr.classList.add(""+ColorTimPr+"");
            progressTowPr.classList.add(""+ColorEtatPr+"");
    
        ///////////////////////////////////// text color pro /////////////////////////////////////////
    
            var tmpPr = document.getElementById("tmpPr");
            var avcPr = document.getElementById("avcPr");
    
            ColorTmpPr = colorTimeText (datePercentage);
            ColorAvcPr = colorStatText (avncmt_act_p);
    
            tmpPr.classList.forEach(function(className)
            {
                if (className.startsWith("text-")) {tmpPr.classList.remove(className);}
            });
    
            avcPr.classList.forEach(function(className)
            {
                if (className.startsWith("text-")) {avcPr.classList.remove(className);}
            });
    
            tmpPr.classList.add(""+ColorTmpPr+"");
            avcPr.classList.add(""+ColorAvcPr+"");
    
        //////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    /////////////////////////////////////////////////// Ajax load page DC  /////////////////////////////////////////////
                var Time= {{ $datePercentage }};
                var Avencemt= {{ $AvancementDc }};
    
                var progressOne = document.getElementById("progres1");
                var progressTow = document.getElementById("progres2");
    
                ColorTim = colorTime (Time);
                ColorEtat = colorStat (Avencemt);
    
                progressOne.style.width = ""+Time+"%";
                progressTow.style.width = ""+Avencemt+"%";
    
                progressOne.setAttribute("aria-valuenow", ""+Time+"");
                progressTow.setAttribute("aria-valuenow", ""+Avencemt+"");
    
                progressOne.classList.forEach(function(className)
                {
                    if (className.startsWith("bg-")) {progressOne.classList.remove(className);}
                });
    
                progressTow.classList.forEach(function(className)
                {
                    if (className.startsWith("bg-")) {progressTow.classList.remove(className);}
                });
    
                progressOne.classList.add(""+ColorTim+"");
                progressTow.classList.add(""+ColorEtat+"");
    
    
                ///////////////////////////////////// text color /////////////////////////////////////////
    
                var tmp = document.getElementById("tmp");
                var avc = document.getElementById("avc");
    
                ColorTmp = colorTimeText (Time);
                ColorAvc = colorStatText (Avencemt);
    
                tmp.classList.forEach(function(className)
                {
                    if (className.startsWith("text-")) {tmp.classList.remove(className);}
                });
    
                avc.classList.forEach(function(className)
                {
                    if (className.startsWith("text-")) {avc.classList.remove(className);}
                });
    
                tmp.classList.add(""+ColorTmp+"");
                avc.classList.add(""+ColorAvc+"");
    
                //////////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /////////////////////////////////////////////////// Ajax load page DR  /////////////////////////////////////////////
                var TimeDr= {{ $datePercentage }};
                var AvencemtDr= {{ $AvancementDr }};
    
                var progressOneDr = document.getElementById("progres1Dr");
                var progressTowDr = document.getElementById("progres2Dr");
    
                ColorTimDr = colorTime (TimeDr);
                ColorEtatDr = colorStat (AvencemtDr);
    
                progressOneDr.style.width = ""+TimeDr+"%";
                progressTowDr.style.width = ""+AvencemtDr+"%";
    
                progressOneDr.setAttribute("aria-valuenow", ""+TimeDr+"");
                progressTowDr.setAttribute("aria-valuenow", ""+AvencemtDr+"");
    
                progressOneDr.classList.forEach(function(className)
                {
                    if (className.startsWith("bg-")) {progressOneDr.classList.remove(className);}
                });
    
                progressTowDr.classList.forEach(function(className)
                {
                    if (className.startsWith("bg-")) {progressTowDr.classList.remove(className);}
                });
    
                progressOneDr.classList.add(""+ColorTimDr+"");
                progressTowDr.classList.add(""+ColorEtatDr+"");
    
    
                ///////////////////////////////////// text color /////////////////////////////////////////
    
                var tmpDr = document.getElementById("tmpDr");
                var avcDr = document.getElementById("avcDr");
    
                ColorTmpDr = colorTimeText (TimeDr);
                ColorAvcDr = colorStatText (AvencemtDr);
    
                tmpDr.classList.forEach(function(className)
                {
                    if (className.startsWith("text-")) {tmpDr.classList.remove(className);}
                });
    
                avcDr.classList.forEach(function(className)
                {
                    if (className.startsWith("text-")) {avcDr.classList.remove(className);}
                });
    
                tmpDr.classList.add(""+ColorTmp+"");
                avcDr.classList.add(""+ColorAvc+"");
    
                //////////////////////////////////////////////////////////////////////////////////////////
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    /////////////////////////////////////////////////// AJAX ACT PRO /////////////////////////////////////////////////
    
    $(document).ready(function()
        {
            $('#DRselectAjust').on('change', function ()
            {
    
                    /////////////////////////////////declaration/////////////////////////////
                    var directionId = $(this).val(); // id seleted direction
                    var dataTable = $('#zero_act_pro').DataTable();  // data table
                    ////////////////////////////////////////////////////////////////////////
    
                    dataTable.clear().draw(); // vider le tableau
                    $.ajax({
                        type: 'GET',
                        url: '{{ url("/admin/directionDrAjust") }}/'+ directionId,
                        
                    
                        success: function(response)
                        {
                            response.actpro.forEach(function(action)
                            {
                                
                                var startDate = new Date(action.dd);
    
                                var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                                var endDate = new Date(action.df);
    
                                var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
                                var newRow = dataTable.row.add([
                                action.structure,
                                action.action,
                                formattedStartDate,
                                formattedEndDate,
                                action.dr,
                                ]).draw(false).node();
                                newRow.id = action.id_act;
                                
                            });
                        }
                    });
            });
        });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
    
    
        $(document).ready(function() {
        // Initially hide all sub-tables
        $('.sub-table').hide();
    
        // Add click event listener to each row with class 'expandable'
        $('.expandable').click(function() {
    
            $(this).next('.sub-table').toggle();
        });
    });
    
    </script>
    
    <script>
        $(document).ready(function() {
            $('.details-content').each(function() {
                $(this).find('table').DataTable();
            });
        });
    
    </script>
                                
    <script>
    
    //////////////////////////////// Morris donut chart START ////////////////////////////////
    
    var act_p_c= {{ $act_p_enc }};
        var act_p_t= {{ $act_p_term }};
        var act_p_r= {{ $act_p_ret }};
    
    
        var Cc= {{ $etatEncDC }};
        var Tc= {{ $etatTermDC }};
        var Rc= {{ $etatRetDC }};
    
        var Cr= {{ $etatEncDR }};
        var Tr= {{ $etatTermDR }};
        var Rr= {{ $etatRetDR }};
    
        var entrC = false;
        var entrR = false;
        var entrP = false;
    
        $(function ()
        {
        Morris.Donut({
                element: 'morris-donut-chart-3',
                data: [{
                    label: "Actions En Cours", value: act_p_c},
                    {label: "Actions Finalisées", value: act_p_t},
                    {label: "Actions Echues", value: act_p_r}],
                resize: false,
                colors:['#fb7a09', '#38ff00', '#fb0909']
            });
       
    
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) 
        {
            // Get the ID of the newly shown tab
            var targetTabId = $(e.target).attr('href');
    
            console.log(targetTabId);
            
    
        if (targetTabId === '#Centrale' && entrC == false) 
        {
            entrC = true;
            
                Morris.Donut({
                    element: 'morris-donut-chart',
                    data:  [{ label: "Actions En Cours", value: Cc },
                            { label: "Actions Finalisées", value: Tc },
                            { label: "Actions Echues",value: Rc }],
                    resize: false,
                    colors:['#fb7a09', '#38ff00', '#fb0909']
                });
        }
        else if (targetTabId === '#Regionale'  && entrR == false)
        {
            entrR = true;
            
            Morris.Donut({
                element: 'morris-donut-chart-2',
                data: [{
                    label: "Actions En Cours", value: Cr},
                    {label: "Actions Finalisées", value: Tr},
                    {label: "Actions Echues", value: Rr}],
                resize: false,
                colors:['#fb7a09', '#38ff00', '#fb0909']
    
            });
    
        }
    
            });
        });
    
    //////////////////////////////////// Morris donut chart END ////////////////////////////////////
    
        </script>
    
</body>
</html>