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
            <div class="col-5 align-self-center">

                </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table border text-dark" id="cop_dr">
                    <thead style="background-color: rgba(25, 151, 235, 0.74); color: #fff" class="text-center">
                        <tr>
                            <th>Code Action</th>
                            <th>Action</th>
                            <th>Indicateur de Performance</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Etat</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                                    @foreach($ActionsCopDr as $action)
                                        {{-- @if ($action->id_dr == auth()->user()->id_dir) --}}
                                            <tr class="expandable" style="background-color: #f7f7f7">
                                                <td>{{ $action->code_act }}</td>
                                                <td>{{ $action->lib_act_cop_dr }}</td>
                                                <td class="font-weight-medium">
                                                    @foreach($action->actCopDrInds as $actCopDrInd)
                                                        <button type="button" class="" style="background-color: transparent; border: none; box-shadow: none;"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="{{$actCopDrInd->indicateur->formule}}.">
                                                            <span><a class="link-offset-2 link-underline">{{$actCopDrInd->indicateur->lib_ind}}</a></span>
                                                        </button>
                                                    @endforeach
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($action->dd)) }}</td>
                                                <td>{{ date('d/m/Y', strtotime($action->df)) }}</td>
                                                <td class="text-center">
                                                
                                                @php
                                                    $startDate = \Carbon\Carbon::parse($action->dd);
                                                    $endDate =  \Carbon\Carbon::parse($action->df);
                                                    $currentDate = \Carbon\Carbon::now();
                                                    $totalDuration = $startDate->diffInDays($endDate);
                                                    $tempEcolAct;
                                                
                                                    if ($currentDate < $startDate) {
                                                        $tempEcolAct = 0;
                                                    } else if ($currentDate <= $endDate) {
                                                        $currentDuration = $startDate->diffInDays($currentDate);
                                                        $tempEcolAct = (($currentDuration / $totalDuration) * 100);
                                                    } else {
                                                        $tempEcolAct = 100;
                                                    }
                                                    $progressColorClass = $tempEcolAct < 99.99 ? 'bg-warning' : 'bg-danger';
                                                @endphp
                                                
                                                <div class="d-flex justify-content-center" style="flex-direction: column">
                                                    <div class="fs-6"> Temps écoulé :{{ number_format($tempEcolAct, 2) }}%</div>
                                                    <div class="progress border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar {{ $progressColorClass }} progress-bar-striped progress-bar-animated" style="width: {{ number_format($tempEcolAct, 2) }}%"></div>
                                                    </div>
                                                </div>





                                                @if ($action->etat == '')
                                                    <div class="d-flex justify-content-center" style="flex-direction: column">
                                                        <div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>
                                                        <div class="progress border border-danger border-2" role="progressbar" aria-label="Animated striped example" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                                                        </div>
                                                    </div>

                                                @else
                                                    <div class="d-flex justify-content-center" style="flex-direction: column">

                                                        <div class="fs-6 text-dark">Avancement :{{$action->etat}}%</div>

                                                        <div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: {{$action->etat}}%"></div>
                                                        </div>

                                                    </div>
                                                @endif
                                                </td>
                                            </tr>
                                            <tr  class="sub-table">
                                                <td colspan="6">
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
                                                        $found = '0';
                                                        $found1 = '0';
                                                        $found2 = '0';
                                                        $found3 = '1';

                                                        foreach ($desc_idAct_date as $desc) {
                                                            if ($desc->id_act_cop_dr == $action->id_act_cop_dr && $desc->mois == $currentMonthNumber) {    
                                                                $found = '1';
                                                            }
                                                        }

                                                        foreach ($desc_idAct_date as $desc) {
                                                            if ($desc->id_act_cop_dr == $action->id_act_cop_dr && $desc->mois == ($currentMonthNumber - 1)) {    
                                                                $found1 = '1';
                                                            }
                                                        }

                                                        foreach ($desc_idAct_date as $desc) {
                                                            if ($desc->id_act_cop_dr == $action->id_act_cop_dr && $desc->mois == ($currentMonthNumber - 2)) {    
                                                                $found2 = '1';
                                                            }
                                                        }

                                                        foreach ($desc_idAct_date as $desc) {
                                                            if ($currentMonthNumber >= 4) {  
                                                                    $actionStartDate = \Carbon\Carbon::parse($action->dd);
                                                                    $actionStartMonth = $actionStartDate->month;

                                                                if ($desc->id_act_cop_dr == $action->id_act_cop_dr && $desc->mois == ($currentMonthNumber - 3) && $currentMonthNumber >= $actionStartMonth) {
                                                                    $found3 = '0';
                                                                }
                                                            }
                                                        }
                                                    @endphp

                                                    {{-- Generate the button HTML based on the logic --}}
                                                    @if ($found3 == '0')
                                                        @if ($found2 == '0' && $action->etat < 100)
                                                            <div class="d-flex justify-content-end mb-2">
                                                                <button type="button" class="btn btn-danger my-3 fs-4" style="float: right;" data-bs-toggle="modal" data-bs-target="#pr2{{$action->id_act_cop_dr}}">
                                                                    Mois de {{ $months[$currentMonthNumber - 2] }} <i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                                </button>
                                                            </div>
                                                        @elseif ($found1 == '0' && $action->etat < 100)
                                                            <div class="d-flex justify-content-end mb-2">
                                                                <button type="button" class="btn btn-outline-warning my-3 fs-4" style="float: right;" data-bs-toggle="modal" data-bs-target="#pr{{$action->id_act_cop_dr}}">
                                                                    Mois Précédent <i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                                </button>
                                                            </div>
                                                        @else ($found == '0' && $action->etat < 100)
                                                            <div class="d-flex justify-content-end mb-2">
                                                                <button type="button" class="btn btn-outline-success my-3 fs-4" style="float: right;" data-bs-toggle="modal" data-bs-target="#{{$action->id_act_cop_dr}}">
                                                                    Mois Actuel <i class="fa-solid fa-circle-plus fa-lg ms-1"></i>
                                                                </button>
                                                            </div>
                                                            
                                                        @endif
                                                    @endif

                                                    {{-- Ajouter description --}}
                                                    <div class="modal fade" id="{{$action->id_act_cop_dr}}" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-full-width">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-info">
                                                                    <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act_cop_dr}}</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                </div>

                                                                <form method="POST" action="{{Route('directeur.dashboard.add_desc_cop')}}">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="justify-content-center">
                                                                                        <div style="text-align: center">
                                                                                            <h3><i class="fa-solid fa-calendar-days text-muted"></i> 
                                                                                                <span class="font-weight-medium">{{$months[$currentMonthNumber]}}</span></h3>
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
                                                                                        <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="0">
                                                                                        <span name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">0%</span>
                                                                                    @else
                                                                                        <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="{{$action->etat}}">
                                                                                        <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">{{$action->etat}}%</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <input type="hidden" name="id_act_cop_dr" value="{{$action->id_act_cop_dr}}">
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

                                                    {{-- Ajouter description_pre --}}
                                                    <div class="modal fade" id="pr{{$action->id_act_cop_dr}}" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-full-width">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-info">
                                                                    <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act_cop_dr}}</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                </div>

                                                                <form method="POST" action="{{Route('directeur.dashboard.add_desc_pre_cop')}}">
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
                                                                                        <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="0">
                                                                                        <span name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">0%</span>
                                                                                    @else
                                                                                        <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="{{$action->etat}}">
                                                                                        <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">{{$action->etat}}%</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <input type="hidden" name="id_act_cop_dr" value="{{$action->id_act_cop_dr}}">
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

                                                    {{-- Ajouter description_pre2 -2 mois --}}
                                                    <div class="modal fade" id="pr2{{$action->id_act_cop_dr}}" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-full-width">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-info">
                                                                    <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act_cop_dr}}</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-hidden="true"></button>
                                                                </div>

                                                                <form method="POST" action="{{Route('directeur.dashboard.add_desc_pre2_cop')}}">
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
                                                                                        <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="0">
                                                                                        <span name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">0%</span>
                                                                                    @else
                                                                                        <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="{{$action->etat}}">
                                                                                        <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">{{$action->etat}}%</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <input type="hidden" name="id_act_cop_dr" value="{{$action->id_act_cop_dr}}">
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

                                                    <div class="ms-1 ps-2">
                                                        <table class="table">
                                                            <thead style="background-color: #6a75e9; color: #fff">
                                                                <tr>
                                                                    <th style="width: 25%;">Ce qui a été fait</th>
                                                                    <th style="width: 25%;">Ce qui reste à faire</th>
                                                                    <th style="width: 16%;">Date de remplissage</th>
                                                                    <th>Mois</th>
                                                                    <th style="width: 19%;" class="text-center">Contraintes</th>
                                                                    <th style="width: 15%;" class="text-center">Avancement (%)</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody class="table-group-divider" style="width: 100px">
                                                                @foreach ($descriptions as $desc)
                                                                    @if ($desc->id_act_cop_dr == $action->id_act_cop_dr)

                                                                    @php
                                                                        $descMonth = \Carbon\Carbon::parse($desc->date)->month;
                                                                        $mm1 = $descMonth - 1;
                                                                        $mm2 = $descMonth - 2;

                                                                        $moiss = (int) $desc->mois;
                                                                    @endphp

                                                                        {{-- @if($day<=26)
                                                                            @if($desc->date_update == '' && $action->df > $currentDateD  && $action->etat < '100' && $descMonth == $month)
                                                                                <button type="button" class="btn btn-outline-success px-3 float-end me-1" data-bs-toggle="modal"
                                                                                    data-bs-target="#d{{$desc->id_desc}}">
                                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                                </button>
                                                                            @endif
                                                                        @endif --}}

                                                                        {{-- Update description  --}}
                                                                        <div class="modal fade" id="d{{$desc->id_desc}}" tabindex="-1" role="dialog"
                                                                                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-full-width">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-success">
                                                                                        <h4 class="modal-title text-light font-weight-medium" id="myLargeModalLabel">{{$action->lib_act_cop_dr}}</h4>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                                                    </div>

                                                                                    <form method="POST" action="{{Route('directeur.dashboard.update_desc_cop')}}">
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
                                                                                                        <i class="fa-solid fa-circle-info"></i><div class="ms-2">Etat d'avancement de l'action </div>
                                                                                                    </div>
                                                                                                
                                                                                                    <div class="col-8 mb-3 border border-1 border-primary border-start-0 p1">
                                                                                                        @if ($action->etat == '')
                                                                                                            <input type="range" class="form-range" name="customRange" min="0" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="0">
                                                                                                            <span name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">0%</span>
                                                                                                        @else
                                                                                                            <input type="range" class="form-range" name="customRange" min="{{$action->etat}}" max="100" step="1" id="customRange{{$action->id_act_cop_dr}}" value="{{$action->etat}}">
                                                                                                            <span style="font-size: large" name="rangeValue" id="rangeValue{{$action->id_act_cop_dr}}">{{$action->etat}}%</span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>

                                                                                                <input type="hidden" name="id_act_cop_dr" value="{{$action->id_act_cop_dr}}">
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

                                                                        <tr style="background-color:#d7ddf8">
                                                                            <td class="td1">{{$desc->faite}}</td>
                                                                            <td class="td2">{{$desc->a_faire}}</td>
                                                                            <td class="td3">
                                                                            
                                                                                @if ($desc->mois == $mm2 || $desc->mois == $mm1)
                                                                                    <span class="me-1">{{ date('d-m-Y H:i', strtotime($desc->date))}}</span> <span style="color: rgb(255, 96, 96);"><i class="fa-solid fa-stopwatch fa-lg"></i></span>
                                                                                @else
                                                                                    <span>{{ date('d-m-Y H:i', strtotime($desc->date))}}</span>
                                                                                @endif


                                                                                @if ($desc->date_update !='')
                                                                                    <br>
                                                                                    <span class="text-success me-1">{{ date('d-m-Y H:i', strtotime($desc->date_update))}}</span><i class="fa-solid fa-pen fa-sm text-success"></i>
                                                                                @endif

                                                                            </td>
                                                                            <td>{{$months[$moiss]}}</td>
                                                                            <td class="td4 text-center">{{$desc->probleme}}</td>
                                                                            <td class="text-center" style="width: 150px;">

                                                                                <div class="d-flex justify-content-center" style="flex-direction: column">
                                                                                    <div class="fs-6 text-dark">{{$desc->etat}}%</div>
                                                                                    <div class="progress " role="progressbar" aria-label="example" aria-valuenow="{{$desc->etat}}" aria-valuemin="0" aria-valuemax="100">
                                                                                        <div class="progress-bar bg-success" style="width: {{$desc->etat}}%"></div>
                                                                                    </div>
                                                                                </div>

                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            {{-- @if($day<=26) --}}
                                                                                @if($desc->date_update == '' && $action->df > $currentDateD  && $action->etat < '100' && $desc->mois == $month)
                                                                                    <td colspan="6" class="text-end">
                                                                                        <button type="button" class="btn btn-outline-success px-3 me-1" data-bs-toggle="modal" data-bs-target="#d{{$desc->id_desc}}">
                                                                                            Modifier <i class="fa-solid fa-pen-to-square ms-1"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                @endif
                                                                            {{-- @endif --}}
                                                                        </tr>

                                                                        
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                </td>
                                            </tr>
                                        {{-- @endif --}}
                                    @endforeach

                    </tbody>
                </table>
            </div>
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


    {{-------------------------------------------------------------------------------------}}

    {{------------------------------------------DataTables-----------------------------------------------------}}
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>

    {{-- <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="{{asset('dist/js/bootstrap.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#cop_dr').DataTable();
        });
    </script>

    <script>
        function colorTime (val)
        {
        if(val< 99.99) {actColorTime = 'bg-warning';}
        else           {actColorTime = 'bg-danger'; }

        return actColorTime;
        }
        function colorStat (val)
        {
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
        actColorEtat = 'text-success';
        return actColorEtat;
        }

        $(document).ready(function() {

        $('.expandable').click(function() {

        $(this).next('.sub-table').toggle();
        });
        });


        $(document).ready(function(){
        $('#toggleForm').click(function(){
        $('#myModal').modal('show');
        });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

        var rangeInputs = document.querySelectorAll('[id^="customRange"]');
        var rangeValueSpans = document.querySelectorAll('[id^="rangeValue"]');

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