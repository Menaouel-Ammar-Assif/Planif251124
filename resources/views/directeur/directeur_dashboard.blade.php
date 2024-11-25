@extends('layouts.directeur.app')

@section('page-css')
    {{------------------------------------------DataTables-----------------------------------------------------}}
    <link rel="stylesheet" href="{{asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    {{------------------------------------------DataTables-----------------------------------------------------}}

    <!-- This page css -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/all.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-breadcrumb">
        <div class="row">

            @if (session()->has('success'))
                <div class="container-fluid">
                    <div class="alert alert-success">
                        <h4>{{session()->get('success')}}</h4>
                    </div>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="container-fluid">
                    <div class="alert alert-danger">
                        <h4>{{session()->get('error')}}</h4>
                    </div>
                </div>
            @endif

            @if (session()->has('complet-success'))
                <div class="container-fluid">
                    <div class="alert alert-success">
                        <h4>{{session()->get('complet-success')}} <i data-feather="check-square" class="text-dark float-end"></i></h4>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <div class="row">
        <div class="col-12">
        
                    <div class="row">

                        <div class="col-8">
                            <div class="row">

                                <div class="col-sm-12 col-lg-4">
                                    <div class="card border-end" style="background: linear-gradient(to right, #f0833ac7, #ffffff);">
                                        <div class="card-body">
                                            <a href="#" id="Encour" type="btn" style="text-decoration: none;" onclick="getdata('E')">
                                                <div class="d-flex align-items-center">
                                                        <div id="buttonWrapper" class="clickable">
                                                            <div class="d-inline-flex align-items-center">
                                                                <h2 class="text-dark mb-1 font-weight-medium" id="etatEnC">
                                                                    @if ($actions)
                                                                        {{$etatEnC}}
                                                                    @endif
                                                                </h2>
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
                                                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatTerm">{{$etatTerm}}</h2>
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
                                                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium" id="etatRet">{{$etatRet}}</h2>
                                                        <h6 class="font-weight-medium mb-0 w-100 text-dark" >Actions Echues</h6>
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
                                                            <h2 class="text-dark mb-1 font-weight-medium" id='ToutT'>
                                                                @if ($actions)
                                                                    {{count($actions)}}
                                                                @endif
                                                            </h2>
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
                                            <h5>Temp Écoulé : <dive id="tmpDr" class="fw-bold text-dark"> {{$percentageElapsed}}% </dive> </h5>
                                        </div>
                                        
                                        <div class="col-md-13">
                                            <div class="progress">
                                                <div id="progres1Dr" class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: {{$percentageElapsed}}%" aria-valuenow="{{$percentageElapsed}}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <h5>Avancement : <dive id="avcDr" class="fw-bold text-dark"> {{$averageEtat}}% </dive> </h5>
                                        </div>
                                        <div class="col-md-13">
                                            <div class="progress">
                                                <div id="progres2Dr" class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style= "width: {{$averageEtat}}%;" aria-valuenow="{{$averageEtat}}%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <div class="col-4">
                            <div class="card border-warning p-0" style="height: 87%">
                                <div class="card-header bg-warning text-center font-weight-medium text-dark">Les actions dont leur délai sera atteint dans 10 jours
                                </div>
                                <a id="aDanger" href="#" type="btn" style="text-decoration: none; margin-top: 10%;" onclick="getdata('D')">
                                    <div class=" justify-content-center-alert">
                                        <div class="triangle-alert">
                                            <div class="triangle-alert-text">
                                                <h2 class="text-dark font-weight-medium">{{ $actionsInDanger }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                        

                <div class="card mt-3">
                    <div class="card-body">
                        <table class="table border" id="dir_planif">
                            <thead style="background-color: rgba(0, 133, 198, 0.74); color: #fff;">
                                <tr>
                                    <th class="text-center h4" style="width: 10% !important;">Code Action</th> 
                                    <th class="text-center h4" style="width: 35% !important;">Action</th>
                                    <th class="text-center h4" style="width: 5% !important;">Date début</th>
                                    <th class="text-center h4" style="width: 5% !important;">Date fin</th>
                                    <th class="text-center h4" style="width: 5% !important;">Statut</th> 
                                    <th class="text-center h4" style="width: 10% !important;">Etat (Temps écoulé/Avancement)</th> 
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <a id="downButton" name="DTous" type="button" class="btn btn-success ms-2 float-end btn-lg">Télécharger Excel <i class="fa-solid fa-file-excel fa-lg ms-2"></i></a>
                <a id="downButtonPdf" name="PTous" type="button" class="btn btn-success float-end btn-lg">Télécharger Pdf <i class="fa-solid fa-file-pdf fa-lg ms-2"></i></a>

                <!-- Modal Ajouter Description -->
                @foreach($actions as $action)
                    @php
                        $months = [
                                    1 => 'Janvier',
                                    2 => 'Février',
                                    3 => 'Mars',
                                    4 => 'Avril',
                                    5 => 'Mai',
                                    6 => 'Juin',
                                    7 => 'Juillet',
                                    8 => 'Août',
                                    9 => 'Septembre',
                                    10 => 'Octobre',
                                    11 => 'Novembre',
                                    12 => 'Décembre'
                        ];

                        $currentMonthNumber = (int) $month;
                        $actionMonthNumber = \Carbon\Carbon::parse($action->dd)->month;
                    @endphp
                    <!-- Ajouter Description Mois Actuel -->
                    <div class="modal fade" id="actionModal-{{$action->id_act}}" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full-width">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-hidden="true"></button>
                                </div>
                            <div class="modal-body">
                                <form method="POST" action="{{Route('directeur.dashboard.add_desc')}}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="justify-content-center">
                                                
                                                    <div style="text-align: center">
                                                        <h3><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium">{{$months[$currentMonthNumber]}}</span></h3>
                                                    </div>
                                                
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px"></textarea>
                                            <label for="Input1">Ce qui a été fait</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px"></textarea>
                                            <label for="Input2">Ce qui reste à faire</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px"></textarea>
                                            <label for="Input3">Contraintes</label>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action </div>
                                            </div>
                                        
                                            <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                @if ($action->etat == '')
                                                    <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                    <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                @else
                                                    <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                    <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                @endif
                                            </div>
                                        </div>

                                        <input type="hidden" name="id_act" value="{{$action->id_act}}">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
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


                    <!--  Ajouter description_pre -->
                    <div class="modal fade" id="actionModalPre-{{$action->id_act}}" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full-width">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-hidden="true"></button>
                                </div>

                                <form method="POST" action="{{Route('directeur.dashboard.add_desc_pre')}}">
                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="justify-content-center">

                                                    <div style="text-align: center;">
                                                        <h3 class=""><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium ">{{$months[$currentMonthNumber -1]}}</span></h3>
                                                    </div>
                                                
                                            </div>
                                        </div>

                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px"></textarea>
                                                <label for="Input1">Ce qui a été fait</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px"></textarea>
                                                <label for="Input2">Ce qui reste à faire</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px"></textarea>
                                                <label for="Input3">Contraintes</label>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                    <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action </div>
                                                </div>
                                            
                                                <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                    @if ($action->etat == '')
                                                        <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                        <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                    @else
                                                        <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                        <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <input type="hidden" name="id_act" value="{{$action->id_act}}">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
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

                
                    <!--  Ajouter description_pre2 -->
                    <div class="modal fade" id="actionModalPre2-{{$action->id_act}}" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full-width">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-hidden="true"></button>
                                </div>

                                <form method="POST" action="{{Route('directeur.dashboard.add_desc_pre2')}}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="justify-content-center">
                                                    <div style="text-align: center;">
                                                        <h3><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium">{{$months[$currentMonthNumber -2]}}</span></h3>
                                                    </div>
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px"></textarea>
                                            <label for="Input1">Ce qui a été fait</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px"></textarea>
                                            <label for="Input2">Ce qui reste à faire</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px"></textarea>
                                            <label for="Input3">Contraintes</label>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action </div>
                                            </div>
                                        
                                            <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                @if ($action->etat == '')
                                                    <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                    <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                @else
                                                    <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                    <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                @endif
                                            </div>
                                        </div>

                                        <input type="hidden" name="id_act" value="{{$action->id_act}}">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
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

                    
                    @foreach($action->Description as $desc)
                            {{-- Update description  --}}
                            <div class="modal fade" id="updateDescription{{$desc->id_desc}}" tabindex="-1" role="dialog"
                                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-full-width">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-hidden="true"></button>
                                        </div>

                                        <form method="POST" action="{{Route('directeur.dashboard.update_desc')}}">
                                            @csrf

                                            <div class="modal-body">
                                                    {{-- Le modification est une (1) fois par mois --}}
                                                    <div class="col-12 alert alert-success d-flex align-items-center justify-content-center" role="alert">
                                                        <i class="fa-solid fa-triangle-exclamation fa-beat"></i><div class="ms-2">Si vous modifiez, vous ne pourrez plus changer</div>
                                                    </div>

                                                    <div class="justify-content-center">
                                                        <div style="text-align: center">
                                                            <h3><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium">{{$months[$currentMonthNumber]}}</span></h3>
                                                        </div>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px">{{$desc->faite}}</textarea>
                                                        <label for="Input1">Ce qui a été fait</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px">{{$desc->a_faire}}</textarea>
                                                        <label for="Input2">Ce qui reste à faire</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px">{{$desc->probleme}}</textarea>
                                                        <label for="Input3">Contraintes</label>
                                                    </div>

                                                    <div class="row justify-content-center">
                                                        <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                            <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action</div>
                                                        </div>
                                                    
                                                        <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                            @if ($action->etat == '')
                                                                <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                                <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                            @else
                                                                <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                                <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="id_act" value="{{$action->id_act}}">
                                                    <input type="hidden" name="id_desc" value="{{$desc->id_desc}}">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                    Fermer
                                                </button>
                                                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                                                    Modifier
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                            {{-- Update description2  --}}
                            <div class="modal fade" id="updateDescriptionPre{{$desc->id_desc}}" tabindex="-1" role="dialog"
                                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-full-width">
                                        <div class="modal-content">
                                                <div class="modal-header bg-success">
                                                    <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act}}</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                </div>

                                            <form method="POST" action="{{Route('directeur.dashboard.update_desc2')}}">
                                                @csrf

                                                <div class="modal-body">
                                                        {{-- Le modification est une (1) fois par mois --}}
                                                        <div class="col-12 alert alert-success d-flex align-items-center justify-content-center" role="alert">
                                                            <i class="fa-solid fa-triangle-exclamation fa-beat"></i><div class="ms-2">Si vous modifiez, vous ne pourrez plus changer</div>
                                                        </div>

                                                        <div class="justify-content-center">
                                                            <div style="text-align: center">
                                                                <h3><i class="fa-solid fa-calendar-days text-muted"></i> <span class="font-weight-medium">{{$months[$month-1]}}</span></h3>
                                                            </div>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input1" placeholder="" id="Input1" style="height: 130px">{{$desc->faite}}</textarea>
                                                            <label for="Input1">Ce qui a été fait</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input2" placeholder="" id="Input2" style="height: 130px">{{$desc->a_faire}}</textarea>
                                                            <label for="Input2">Ce qui reste à faire</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" style="background-color: #f8f8f8;" name="Input3" placeholder="" id="Input3" style="height: 130px">{{$desc->probleme}}</textarea>
                                                            <label for="Input3">Contraintes</label>
                                                        </div>

                                                        <div class="row justify-content-center">
                                                            <div class="col-3 alert alert-primary d-flex align-items-center text-center" role="alert">
                                                                <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action</div>
                                                            </div>
                                                        
                                                            <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                                @if ($action->etat == '')
                                                                    <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act}}" value="0">
                                                                    <span name="rangeValue" id="rangeValue{{$action->id_act}}">0%</span>
                                                                @else
                                                                    <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act}}" value="{{$action->etat}}">
                                                                    <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act}}">{{$action->etat}}%</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="id_act" value="{{$action->id_act}}">
                                                        <input type="hidden" name="id_desc" value="{{$desc->id_desc}}">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                        Fermer
                                                    </button>
                                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                                                        Modifier
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                </div>
                            </div>
                    @endforeach
                    {{---------------------------------------------------------------------------------------------}}

                @endforeach

        </div>

    </div>
@endsection

@section('page-js')

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
    {{------------------------------------------DataTables-----------------------------------------------------}}
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
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
    
        //################################################ END COLOR FUNCTION ###########################################################//
    
            /////////////////////////////////////////////////// Ajax load page Dir /////////////////////////////////////////////
                    var Time= {{ $percentageElapsed }};
                    var Avencemt= {{ $averageEtat }};
    
                    var progressOne = document.getElementById("progres1Dr");
                    var progressTow = document.getElementById("progres2Dr");
    
                    ColorTim = colorTime (Time);
                    ColorEtat = colorStat (Avencemt);
    
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
    
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    </script>
    
    <script>
    
            getdata('Tous');
    
            function getdata(btn) 
            {
                // Check if DataTable is already initialized
                if ($.fn.DataTable.isDataTable('#dir_planif')) 
                {
                    // Destroy existing DataTable
                    $('#dir_planif').DataTable().clear().destroy();
                }
    
                var dataTable = $('#dir_planif').DataTable({
                    "processing": true,
                    "serverSide": false,
                    "ordering": false, // Disable client-side sorting
                    "drawCallback": function(settings) {
                        feather.replace();
                    }
                });

                var downButton = document.getElementById("downButton");
                downButton.setAttribute("name", 'D'+btn);
    
                var downButtonPdF = document.getElementById("downButtonPdf");
                downButtonPdf.setAttribute("name", 'P'+btn);

                // Fetch actions via AJAX
                $.ajax({
                    type: 'GET',
                    url: '{{ url("ActionBtn") }}/'+ btn,
                    success: function(response) {
                        
                        dataTable.clear().draw();
                        var currentDate = new Date(response.date);
    
                        response.actionsFiltre.forEach(function(action) {
                            var prioritaires = action.prioritaires;
                            var actionContent = '';
                            var codeActContent = action.code_act;
                            var startDate = new Date(action.dd);
                            var endDate = new Date(action.df);
                            var totalDuration = (endDate - startDate) / (1000 * 60 * 60 * 24);
                            var tempEcolAct;
    
                            if (action.id_cop !== null) {
                                codeActContent = `
                                    <div class="">
                                        <div class="ribbon">C O P</div>
                                        <div class="code-act mt-3">${action.code_act}</div>
                                    </div>`;
                            } else {
                                codeActContent = `<div>${action.code_act}</div>`;
                            }
    
                            if (action.id_p !== null) {
                                actionContent = `
                                    <div class="row">
                                        <div class="col-md-8 col-lg-12">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <span class="fs-4">${action.lib_act}</span>
                                                    <i class="fa-solid fa-star fa-beat ms-2" style="color: #FFD43B;" data-bs-toggle="tooltip" data-bs-placement="top" title="${prioritaires ? prioritaires.lib_p : ''}"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            } else {
                                actionContent = `<span class="fs-4">${action.lib_act}</span>`;
                            }
    
                            if (currentDate < startDate) {
                                tempEcolAct = 0;
                            } else if (currentDate <= endDate) {
                                var currentDuration = (currentDate - startDate) / (1000 * 60 * 60 * 24);
                                tempEcolAct = (currentDuration / totalDuration) * 100;
                            } else {
                                tempEcolAct = 100;
                            }
    
                            var progressColorClass = tempEcolAct < 99.99 ? 'bg-warning' : 'bg-danger';
                            var statusIcon;
                            if (action.etat == '100') {
                                statusIcon = '<i data-feather="check-circle" class="feather-icon text-success"></i>';
                            } else if (endDate >= currentDate) {
                                statusIcon = '<i data-feather="clock" class="feather-icon text-warning"></i>';
                            } else {
                                statusIcon = '<i data-feather="pause-circle" class="feather-icon text-danger"></i>';
                            }
    
                            var newRow = dataTable.row.add([
                                codeActContent,  
                                actionContent, 
                                formatDate(startDate), 
                                formatDate(endDate), 
                                statusIcon, 
                                `<div class="d-flex justify-content-center" style="flex-direction: column">
                                    <div class="fs-6">Temps écoulé : ${tempEcolAct.toFixed(2)}%</div>
                                    <div class="progress border-success border-1" role="progressbar">
                                        <div class="progress-bar ${progressColorClass} progress-bar-striped" style="width: ${tempEcolAct.toFixed(2)}%"></div>
                                    </div>
                                    <div class="fs-6 text-dark">Avancement : ${action.etat || '0'}%</div>
                                    <div class="progress border-success border-1" role="progressbar">
                                        <div class="progress-bar bg-success progress-bar-striped" style="width: ${action.etat || '0'}%"></div>
                                    </div>
                                </div>`
                            ]).draw(false);
    
                            $(newRow.node()).attr('data-id', action.id_act);
                        });
    
                        feather.replace();
                    }
                });
            }
    
            document.getElementById('downButton').addEventListener('click', function()
            {
                var downButton = document.getElementById('downButton')
                var downName = downButton.getAttribute("name");

                var downloadUrl = "{{ route('downloadExcel', ['Name' => ':Name']) }}";
                downloadUrl = downloadUrl.replace(':Name', downName);

                window.location.href = downloadUrl;
            });

            document.getElementById('downButtonPdf').addEventListener('click', function() {
                var downButtonPdf = document.getElementById('downButtonPdf');
                var downName = downButtonPdf.getAttribute("name");

                var downloadUrl = "{{ route('downloadPdf', ['Name' => ':Name']) }}";
                var pdfUrl = downloadUrl.replace(':Name', downName);
                window.location.href = pdfUrl;
            });
            // Add event listener to rows
            $('#dir_planif tbody').on('click', 'tr', function() {
                var actionId = $(this).data('id');

                // Remove subtable if already present
                if ($(this).next('tr.subtable').length) {
                    $('tr.subtable').remove();
                } else {
                
                // Fetch subtable details via AJAX
                $.ajax({
                    type: 'GET',
                    url: '{{ url("/directeur/subtable") }}/' + actionId,
                    success: function(response) {
                        var subtableRows = '';
                        var currentDate = {{$date}};
                        var currentMonth = {{$month}}; // Current month (1-12)
                        var currentYear = {{$year}}; // Current year
                        var currentDateD = {{ $day }};
                        var btnDisplayed = '0'; // Flag to ensure buttons are added only once
                        var btnDisplayed1 = '0';
    
                        // Loop through actions first
                        response.actions.forEach(function(action) 
                        {
                                // Convert action.dd (start date) to a Date object
                                var dateFull = @json($date);
                                var dateMonth_ = @json($month);
                                var dateMonth = parseInt(dateMonth_, 10);
                                // var dateMonth = dateM.getMonth();
    
                                var actionStartDate = new Date(action.dd);
                                var actionEndDate = new Date(action.df);
                                var actionStartMonth = actionStartDate.getMonth() + 1; // Month of the action's start date
                                var actionEndMonth = actionEndDate.getMonth() + 1; // Month of the action's end date
                                var actionStartYear = actionStartDate.getFullYear(); // Year of the action's start date
                                var currentMonthNumber = parseInt(currentMonth, 10);
    
                                // Initialize button HTML
                                var buttonHtml = '';
    
                                // Button logic
    
                                var found = '0';
                                var found1 = '0';
                                var found2 = '0';
                                var found3 = '1';
                                
                                    // 
                                    response.descriptions.forEach(function(desc) {
                                        if (desc.id_act == action.id_act && desc.mois == parseInt(currentMonth, 10) ){    
                                                found = '1';
                                            }
                                        });
                                        
                                    // 
                                    response.descriptions.forEach(function(desc) {
                                        if (desc.id_act == action.id_act && desc.mois == parseInt((currentMonth - 1), 10)){    
                                            found1 = '1';
                                        }
                                    });

                                    // 
                                    response.descriptions.forEach(function(desc) {
                                        if (desc.id_act == action.id_act && desc.mois == parseInt((currentMonth - 2), 10)){    
                                            found2 = '1';
                                        }
                                    });

                                    // 
                                    response.descriptions.forEach(function(desc) {
                                        if (currentMonthNumber >= 4) {  
                                            if (desc.id_act == action.id_act && desc.mois == parseInt((currentMonth - 3), 10) && currentMonthNumber >= actionStartMonth) {
                                                found3 = '0';  
                                            }
                                        }
                                });
    
                                
                                if ( found3 == '0'){
                                    if(found2 =='0' && action.etat <100){
                                        buttonHtml = `
                                            <div class="d-flex justify-content-end mb-2">
                                                <button type="button" class="btn btn-danger my-3 fs-4" style="float: right;" data-bs-toggle="modal" data-bs-target="#actionModalPre2-${action.id_act}">
                                                    Mois de ${getFrenchMonthName(currentMonth -2)} <i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                </button>
                                            </div>`;
                                    }
                                    else if(found1 =='0' && action.etat <100){
                                        buttonHtml = `
                                            <div class="d-flex justify-content-end mb-2">
                                                <button type="button" class="btn btn-outline-warning my-3 fs-4" style="float: right;" data-bs-toggle="modal" data-bs-target="#actionModalPre-${action.id_act}">
                                                    Mois Precedent <i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                </button>
                                            </div>`;
                                    }
                                    else if(found == '0' && action.etat <100){
                                        buttonHtml = `
                                            <div class="d-flex justify-content-end mb-2">
                                                <button type="button" class="btn btn-outline-success my-3 fs-4" style="float: right;" data-bs-toggle="modal" data-bs-target="#actionModal-${action.id_act}">
                                                    Mois Actuel <i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                </button>
                                            </div>`;
                                    }
                                    else {
                                        // Optional: Handle the case where none of the above conditions are met
                                        buttonHtml = ''; 
                                    }
                                }
    
                                // Loop through the descriptions and generate table rows
                                response.descriptions.forEach(function(description) {
                                    var descDate = new Date(description.date);
                                    var descMonth = descDate.getMonth() + 1;
                                    var formattedDate = ("0" + descDate.getDate()).slice(-2) + "/" + ("0" + descMonth).slice(-2) + "/" + descDate.getFullYear();
                                    var moisName = getFrenchMonthName(parseInt(description.mois, 10));
    
                                    var lateHtml = ''; 
                                    if (description.mois <= (new Date(description.date).getMonth() - 1)) {
                                        lateHtml = `
                                                <br>
                                                <i class=" text-danger fa-solid fa-stopwatch fa-lg"></i>`;
                                    } 
    
                                    var etatHtml = `
                                        <div class="d-flex justify-content-center" style="flex-direction: column">
                                            <div class="fs-6 text-success">${description.etat.toFixed(2)}%</div>
                                            <div class="progress border border-success border-1" role="progressbar" aria-valuenow="${description.etat}" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success" style="width: ${description.etat}%"></div>
                                            </div>
                                        </div>`;
    
                                        var updateHtml = ''; 
                                        if (description.date_update != null) {
                                            var updateDate = new Date(description.date_update);
                                            var formattedUpdateDate = ("0" + updateDate.getDate()).slice(-2) + "/" + ("0" + (updateDate.getMonth() + 1)).slice(-2) + "/" + updateDate.getFullYear();
                                            updateHtml = `
                                                <br>
                                                <span class="text-success text-center me-1">${formattedUpdateDate} <br> <i class="fa-solid fa-pen fa-sm text-success"></i></span>
                                                `;
                                        }
    
                                    subtableRows += `
                                        <tr class="subtable">
                                            <td>${description.faite ?? ''}</td>
                                            <td>${description.a_faire ?? ''}</td>
                                            <td>${description.probleme ?? ''}</td>
                                            <td>${moisName}</td>
                                            <td>
                                                ${formattedDate}
                                                ${updateHtml}
                                                ${lateHtml}
    
                                            </td>
                                            <td>${etatHtml}</td>
                                        </tr>`;
    
                                        
    
                    
                                    // Logic for "Modifier Mois Actuel" button
                                
                                    if ( description.date_update == null && action.df > dateFull && description.mois == dateMonth)
                                    {
                                        subtableRows += `
                                            <tr>
                                                <td colspan="6" class="text-end">
                                                    <button type="button" class="btn btn-outline-success px-3 me-1" data-bs-toggle="modal" data-bs-target="#updateDescription${description.id_desc}">
                                                        Modifier Mois Actuel <i class="fa-solid fa-pen-to-square ms-1"></i>
                                                    </button>
                                                </td>
                                            </tr>`;
                                        btnDisplayed = '1'; 
                                    }
                                    
                                    // Check if the button for the previous month should be displayed
                                    if (btnDisplayed1 == '0' && description.id_act == action.id_act && description.date_update == null && action.df > dateFull && ((description.mois) == (dateMonth - 1))) {
                                        subtableRows += `
                                            <tr>
                                                <td colspan="6" class="text-end">
                                                    <button type="button" class="btn btn-outline-warning px-3 me-1" data-bs-toggle="modal" data-bs-target="#updateDescriptionPre${description.id_desc}">
                                                        Modifier Mois Précédent <i class="fa-solid fa-pen-to-square ms-1"></i>
                                                    </button>
                                                </td>
                                            </tr>`;
                                            btnDisplayed1 = '1'; 
                                    }
                                    
                                });
    
                                
                                    // Subtable HTML for each action
                                    var subtableRow = `
                                        <tr class="subtable">
                                            <td colspan="6">
                                                ${buttonHtml}
                                                <table class="table table-bordered subtable-details" style="background-color:#f0f3ff;">
                                                    <thead style="background-color:#d7ddf8">
                                                        <tr style="color:#6c6c6c;">
                                                            <th>Ce qui a été fait</th>
                                                            <th>Ce qui reste à faire</th>
                                                            <th>Contraintes</th>
                                                            <th>Mois</th>
                                                            <th>Date de remplissage</th>
                                                            <th>Avancement (%)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>${subtableRows}</tbody>
                                                </table>
                                            </td>
                                        </tr>`;
    
                                            $(subtableRow).insertAfter($(this)); 
                        }.bind(this)); 
    
                        feather.replace(); 
                    }.bind(this) 
                });      
            }
        });
    
    
    
    
        // Function to format date
        function formatDate(date) {
            return ("0" + date.getDate()).slice(-2) + "/" + ("0" + (date.getMonth() + 1)).slice(-2) + "/" + date.getFullYear();
        }
    
        // Function to get French month names
        function getFrenchMonthName(monthNumber) {
            const months = [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ];
            return months[monthNumber - 1];
        }
        
        document.addEventListener('DOMContentLoaded', function() {
    
        var rangeInputs = document.querySelectorAll('[id^="customRange"]');
        var rangeValueSpans = document.querySelectorAll('[id^="rangeValue"]');
    
        // Iterate over each range input and set up event listeners
        rangeInputs.forEach(function(rangeInput, index) {
            var rangeValueSpan = rangeValueSpans[index];
            rangeValueSpan.textContent = rangeInput.value + '%';
            rangeInput.addEventListener('input', function() {
                rangeValueSpan.textContent = rangeInput.value + '%';
            });
            });
        });
    
    </script>

@endsection