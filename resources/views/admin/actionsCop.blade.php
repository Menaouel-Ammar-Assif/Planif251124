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

        .ribbon 
        {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
        }
        .ribbon 
        {
            --f: .5em; 
            position: absolute;
            /* top: 0; */
            /* left: 0; */
            line-height: 1.8;
            padding-inline: 1lh;
            padding-bottom: var(--f);
            border-image: conic-gradient(#0008 0 0) 51%/var(--f);
            clip-path: polygon(
                100% calc(100% - var(--f)),100% 100%,calc(100% - var(--f)) calc(100% - var(--f)),var(--f) calc(100% - var(--f)), 0 100%,0 calc(100% - var(--f)),999px calc(100% - var(--f) - 999px),calc(100% - 999px) calc(100% - var(--f) - 999px));
            transform: translate(calc((cos(45deg) - 1)*100%), -100%) rotate(-45deg);
            transform-origin: 100% 100%;
            /* background-color: #F07818; */
            background: linear-gradient(to right, #f12711, #f5af19);
            z-index: +1;
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
            <nav class="navbar top-navbar navbar-expand-lg" style="background-color: rgba(0, 76, 255, 0.56); max-height:5px;">
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

        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color: rgba(0, 76, 255, 0.56);">
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

                @if (session()->has('error-msg'))
                    <div class="alert alert-danger text-center" role="alert" style="padding: 15px;">
                        <h4 class="alert-heading mb-0">{{session()->get('error-msg')}}</h4>
                    </div>
                @endif


                <div class="row">
                    <div class="col-12">
                        <div class="ribbon">C O P</div>
                        <div class="card">
                            <div class="card-body" style="padding-top: 90px;">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title font-weight-bold text-dark">
                                        Gestion des objectifs stratégiques
                                    </h4>
                                    <div>
                                        <button type="button" class="btn btn-success mr-2" id="addObjectif">
                                            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="objectif" class="table border">
                                        <thead>
                                            <tr class="font-weight-medium text-light bg-info">
                                                <th>Objectif Stratégique</th>
                                                <th>CRUD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($objectifs as $obj)
                                                <tr>
                                                    <td>{{ $obj->lib_obj }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-between">
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#resetObjectifModal{{$obj->id_obj}}">
                                                                <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                                            </button>

                                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteObjectifModal{{$obj->id_obj}}">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </div>

                                                        <div class="modal fade" id="resetObjectifModal{{$obj->id_obj}}" tabindex="-1" role="dialog" aria-labelledby="resetObjectifModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="resetObjectifModalLabel">Modifier l'objectif stratégique</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route("admin.update_objectif") }}" method="POST">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <input type="hidden" name="id_obj" value="{{ $obj->id_obj }}">
                                                                                <div class="input-group mb-3">
                                                                                <span class="input-group-text">Objectif</span>
                                                                                <textarea class="form-control" name="lib_obj" id="lib_obj"></textarea>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                                                    <button type="submit" class="btn btn-warning">Modifier</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="deleteObjectifModal{{$obj->id_obj}}" tabindex="-1" role="dialog" aria-labelledby="deleteObjectifModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteObjectifModalLabel">Supprimer Objectif</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Êtes-vous sûr de bien vouloir supprimer cet objectif ?</p>
                                                                        <form action="{{ route('admin.delete_objectif') }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="objId" value="{{$obj->id_obj}}">
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                                                <button type="submit" class="btn btn-danger">Supprimer</button>
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


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title font-weight-bold text-dark">
                                        Gestion des sous objectifs
                                    </h4>
                                    <div>
                                        <button type="button" class="btn btn-success mr-2" id="addSousObjectif">
                                            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="objectif" class="table border">
                                        <thead>
                                            <tr class="font-weight-medium text-light bg-info">
                                                <th>Objectif Stratégique</th>
                                                <th>Sous Objectif</th>
                                                <th>CRUD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($objectifs as $objectif)
                                                <tr>
                                                    <td>{{ $objectif->lib_obj }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach($objectif->SousObjectif as $sousObjectif)
                                                                <li>-{{ $sousObjectif->lib_sous_obj }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        @foreach($objectif->SousObjectif as $sousObjectif)
                                                            <div class="d-flex justify-content-between">
                                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                                data-bs-target="#resetSousObjectifModal{{$sousObjectif->id_sous_obj }}">
                                                                    <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                                                </button>

                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                data-bs-target="#deleteSousObjectifModal{{$sousObjectif->id_sous_obj }}">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </div>
                                                            <br>
                                                            <div class="modal fade" id="resetSousObjectifModal{{$sousObjectif->id_sous_obj}}" tabindex="-1" role="dialog" aria-labelledby="resetSousObjectifModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="resetSousObjectifModalLabel">Modifier le sous objectif</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route("admin.update_sous_objectif") }}" method="POST">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <input type="hidden" name="id_sous_obj" value="{{ $sousObjectif->id_sous_obj }}">
                                                                                    <div class="input-group mb-3">
                                                                                    <span class="input-group-text">Sous Objectif</span>
                                                                                    <textarea class="form-control" name="lib_sous_obj" id="lib_sous_obj"></textarea>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                                                        <button type="submit" class="btn btn-warning">Modifier</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal fade" id="deleteSousObjectifModal{{$sousObjectif->id_sous_obj}}" tabindex="-1" role="dialog" aria-labelledby="deleteSousObjectifModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="deleteSousObjectifModalLabel">Supprimer le sous Objectif</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Êtes-vous sûr de bien vouloir supprimer ce sous objectif ?</p>
                                                                            <form action="{{ route('admin.delete_sous_objectif') }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="sousobjId" value="{{$sousObjectif->id_sous_obj}}">
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
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


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title font-weight-bold text-dark">
                                        Gestion des actions COP / Structures Centrales
                                    </h4>
                                    <div>
                                        <button type="button" class="btn btn-success mr-2" id="addActCopDc">
                                            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                                        </button>
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
                </div>
            </div>
        </div>
    </div>

    <!------------------------------ Start Modal Add Objectif ----------------------------------------------------->
      <div class="modal fade" id="addObjectifModal" tabindex="-1" aria-labelledby="addObjectifModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addObjectifModalLabel">Ajouter Objectif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.add_objectif') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Objectif</span>
                                    <textarea class="form-control" name="lib_obj" id="lib_obj"></textarea>
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
    <!------------------------------ End Modal Add Objectif ----------------------------------------------------->


      <!------------------------------ Start Modal Add Sous Objectif ----------------------------------------------------->
      <div class="modal fade" id="addSousObjectifModal" tabindex="-1" aria-labelledby="addSousObjectifModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSousObjectifModalLabel">Ajouter Sous Objectif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.add_sous_objectif') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="input-group mb-3" id="ObjectifSelection">
                                    <div class="input-group">
                                        <label class="input-group-text" for="selectedObjectif">Objectif</label>
                                        <select class="form-select" name="objectif" id="objectif">
                                            <option disabled selected>Choisissez l'objectif </option>
                                            @foreach ($objectifs as $obj)
                                                <option value="{{$obj->id_obj}}">{{$obj->lib_obj}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text">Sous Objectif</span>
                                    <textarea class="form-control" name="lib_sous_obj" id="lib_sous_obj"></textarea>
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
    <!------------------------------ End Modal Add Sous Objectif ----------------------------------------------------->

      <!------------------------------ Start Modal Add Action Cop DC ----------------------------------------------------->
      <div class="modal fade" id="addActCopDcModal" tabindex="-1" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addActCopDcModalLabel">Ajouter Action COP / DC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.add_action_copDC') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="input-group mb-3" id="ObjectifSelection">
                                    <div class="input-group">
                                        <label class="input-group-text" for="selectedObjectif">Objectif</label>
                                        <select class="form-select" name="selectedObjectif" id="selectedObjectif">
                                            <option disabled selected>Choisissez l'objectif </option>
                                            @foreach ($objectifs as $obj)
                                                <option value="{{$obj->id_obj}}">{{$obj->lib_obj}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group mb-3" id="ObjectifSelection">
                                    <div class="input-group">
                                        <label class="input-group-text" for="selectedSousObjectif">Sous Objectif</label>
                                        <select class="form-select" name="sousObjectif" id="sousObjectif">
                                            <option disabled selected>Choisissez le sous objectif </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group mb-3" id="DCSelection">
                                    <div class="input-group">
                                        <label class="input-group-text" for="selectedDC">Structure Centrale</label>
                                        <select class="form-select" name="dc" id="dc">
                                            <option disabled selected>Choisissez la structure centrale </option>
                                            @foreach ($directionsDc as $dc)
                                                <option value="{{$dc->id_dir}}">{{$dc->lib_dir}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group">
                                        <label class="input-group-text" for="ActionDCSelection">Action</label>
                                        <select class="form-select" name="ActionDCSelection" id="ActionDCSelection">
                                            <option disabled selected>Choisissez l'action</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group">
                                        <label class="input-group-text" for="selectedInd">Indicateur de performance</label>
                                        <select class="form-select" name="ind" id="ind">
                                            <option disabled selected>Choisissez l'indicateur de performance</option>
                                            @foreach ($indicateurs as $ind)
                                                <option value="{{$ind->id_ind}}">{{$ind->lib_ind}}</option>
                                            @endforeach
                                        </select>
                                        <select class="form-select" name="ind" id="ind">
                                            <option disabled selected>Choisissez la formule</option>
                                            @foreach ($indicateurs as $ind)
                                                <option value="{{$ind->id_ind}}">{{$ind->formule}}</option>
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
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------ End Modal Add Action Cop DC ----------------------------------------------------->









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

    document.addEventListener("DOMContentLoaded", function() {
        const addActionButton = document.getElementById('addObjectif');
        addActionButton.addEventListener('click', function() {
        $('#addObjectifModal').modal('show');
        });
    });


    $(document).ready(function(){
        $('#objectif').DataTable();
    });


    document.addEventListener("DOMContentLoaded", function() {
        const addActionButton = document.getElementById('addSousObjectif');
        addActionButton.addEventListener('click', function() {
        $('#addSousObjectifModal').modal('show');
        });
    });

  document.addEventListener("DOMContentLoaded", function() {
        const addActionButton = document.getElementById('addActCopDc');
        addActionButton.addEventListener('click', function() {
        $('#addActCopDcModal').modal('show');
        });
    });


   ////////////////////////////////get sous objectif of selected objectif /////////////////////////////////////////
    document.addEventListener('DOMContentLoaded', function() {
        var objectifSelect = document.getElementById('selectedObjectif');
        var sousObjectifSelect = document.getElementById('sousObjectif');

        objectifSelect.addEventListener('change', function() {
            var selectedObjectId = this.value;
            fetch(`/admin/getSousObj/${selectedObjectId}`)
                .then(response => response.json())
                .then(data => {
                    sousObjectifSelect.innerHTML = '<option disabled selected>Choisissez le sous objectif</option>';
                    data.forEach(function(sousObj) {
                        var option = document.createElement('option');
                        option.value = sousObj.id_sous_obj;
                        option.text = sousObj.lib_sous_obj;
                        sousObjectifSelect.appendChild(option);
                    });
                });
        });
    });

////////////////////////////////////get action of selected DC ////////////////////////////////////////////////////////////////////////////////////

    document.addEventListener('DOMContentLoaded', function() {
    var directionSelect = document.getElementById('dc');
    var actionSelect = document.getElementById('ActionDCSelection');

    directionSelect.addEventListener('change', function() {
        var selectedDirectionId = this.value;

        fetch(`/admin/getActionsDC/${selectedDirectionId}`)
            .then(response => response.json())
            .then(data => {
                actionSelect.innerHTML = '<option disabled selected>Choisissez l\'action</option>';
                data.forEach(function(action) {
                    var optionn = document.createElement('option');
                    optionn.value = action.id_act;
                    optionn.text = action.lib_act;
                    actionSelect.appendChild(optionn);
                });
            });
    });
});



    </script>

</body>
</html>
