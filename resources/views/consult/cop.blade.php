@extends('layouts.consult.app')

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
    <div class="row">
                    
        @php
            $months = [
                        3 => 'trimestre',
                        6 => 'semestre',
                        9 => 'neuf mois',
                        12 => 'annuel',
                    ];
            $currentMonthNumber = (int) $month;
        @endphp

        <div class="col-lg-12">
            <div class="ribbon">C O P</div>


            <div class="card">

                <div class="row text-center justify-content-center" style="padding-top: 35px;">
                    <div class="col-6" style="width: fit-content;">
                        <h2 class="text-dark"> <span class="font-weight-medium">Année</span> {{$year}}</h2>
                    </div>
                </div>

                <div class="card-body">


                    <div class="row mt-3" style="padding: 20px; background: linear-gradient(to right, #d5d5d5,#dadada, #f0f0f0, #fff);">                                        

                            <div class="col-7">
                                
                                <div class="col-lg-12 mt-4">
                                    <div class="input-group">

                                        <label class="input-group-text font-weight-bold" for="Objectif" style="background-color: #FFA500; color: #fff; font-weight: bolder;"> Objectif </label>
                                        <select class="form-select form-control formselect required" placeholder="" id="Objectif" name="Objectif" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;  color: #000000; background-color: #e8eaec;" >
                                            <option value="0" style="font-weight: bolder; color: rgb(169, 168, 168);" disabled selected> Selectionnez une Objectf * </option>
                                            @foreach ($Objectif as $item)
                                                <option value="{{ $item->id_obj }}">{{ $item->lib_obj }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-12 ms-0 mt-4">

                                    <div class="input-group">
                                        <label class="input-group-text font-weight-bold" for="SousObjectif" style="background-color: #FF5F00; color: #fff; font-weight: bolder;">Sous Objectif</label>
                                        <select class="form-select form-control formselect required" placeholder="" id="SousObjectif" name="SousObjectif" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;  color: #000000; background-color: #e8eaec;">
                                        </select>
                                    </div>

                                </div>


                                <div class="col-lg-12 mt-4">
                                    {{-- background-color: #002379ab; --}}
                                    <div class="input-group">
                                        <label class="input-group-text font-weight-bold" for="Indicateur" style="font-weight: bolder; color: #fff; background-color: #002379;"><i class="fa-solid fa-arrow-trend-up me-1"></i> Indicateur</label>
                                        <select class="form-select form-control formselect required" placeholder="" id="Indicateur" name="Indicateur" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;  color: #000000; background-color: #e8eaec;">
                                            {{-- <option value="0" style="font-weight: bolder; color:rgb(242, 242, 242)" disabled selected> Selectionnez un Indicateur * </option> --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6 mt-5">
                                    <div class="input-group">
                                        <label class="input-group-text font-weight-bold" for="month"><i class="fa-regular fa-calendar-days fa-xl"></i> </label>
                                        <select class="form-select form-control formselect required custom-radius" style="background-color: #e8eaec; color: #000; text-transform: uppercase;" id="month">
                                            @for ($i = 3; $i < $currentMonthNumber; $i = $i+3)
                                                @php
                                                    $paddedValue = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                @endphp
                                                <option value="{{ $paddedValue }}" {{ $i == $currentMonthNumber ? 'selected' : '' }}>
                                                    {{ $months[$i] }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="col-5">
                                <img src="{{asset('assets/cible7.png')}}" class="float-end" alt="" style="opacity: 70%; max-width: 67%;">
                            </div>

                        {{-- </div> --}}
                    </div>


                </div>
            </div>
        </div>

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" >

                    <div id="numDenom" class="col-lg-12 p-3 d-none" style="background-image: url('{{ asset('assets/calc6.jpg') }}'); background-size: cover; background-position: center;">
                        
                        <div class="row">
                            <div class="col-6 mt-1">
                                <div class="row">
                                    <label for="numVal" class="col-sm-6 col-form-label pe-0" style="font-weight: bold; font-size: 14px;" id="num"></label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-white rounded fs-4" id="numVal" placeholder="" readonly>
                                            <span class="input-group-text p-1" id="typeN"><h4 class="m-0"></h4></span>
                                        </div>
                                    </div>
                                </div>

                                <hr style="border-top: 2px solid #313131; width: 47%; margin-left: revert;">

                                <div class="row">
                                    <label for="denomVal" class="col-sm-6 col-form-label pe-0" style="font-weight: bold; font-size: 14px;" id="denom"></label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-white rounded fs-4" id="denomVal" placeholder="" readonly>
                                            <span class="input-group-text p-1" id="typeD"><h4 class="m-0"></h4></span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-6 " style="align-content: center; padding-left: 0;">
                                <div class="row" style="align-content: center;">   
                                    <div class="col-5 ps-0" style="align-content: center; margin-bottom: 22px;">
                                                                                    {{-- margin-top: 15px; --}}
                                        <div class="d-flex ribbon7" style="margin-left: 28px; color:#000000 !important;">
                                            <span class="h5 font-weight-medium mb-1 pt-1" id="performantN">Résultat :</span>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-text p-1" id="basic-addon1"><h2 class="m-0 p-0">=</h2></span>
                                            <input type="text" id="Result" class="form-control bg-white font-weight-medium fs-4" placeholder="Result" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                        </div>
                                        

                                    </div>   

                                    <div class="col-7 p-0">
                                        <div class="row" style="margin: auto;">
                                            <div class="col-5 ps-0" style="align-content: center;">


                                                {{-- <div class="d-flex ribbon7 ms-1" style="background-color: #6d98fe">
                                                    <span class="h6 font-weight-medium mb-1 pt-1" id="cibleName"></span>
                                                </div>

                                                <div class="input-group mb-3 border border-primary border-1 rounded rounded-4">
                                                    <span class="input-group-text rounded-end rounded-4 p-1" style="background-color: #6d98fe" id="basic-addon2"><h2 class="m-0 p-0"> <i class="fa-solid fa-chart-pie text-white"></i> </h2></span>
                                                    <input type="text" id="Cible2" class="form-control bg-white rounded-start rounded-4 fs-4" placeholder="Cible" aria-label="Username" aria-describedby="basic-addon2" readonly>
                                                </div> --}}


                                                {{-- <hr style="border-top: 2px solid #000000; width: 47%; margin-left: revert;"> --}}


                                                <div class="d-flex ribbon7 ms-1" style="background-color: #e7e7e7 !important;">
                                                    <span class="h6 font-weight-medium mb-1 pt-1">Cible Annuelle:</span>
                                                </div>

                                                <div class="input-group mb-3 border border-primary border-1 rounded rounded-4">
                                                    <span class="input-group-text rounded-end rounded-4 p-1" style="background-color: #fff;" id="basic-addon2"><h2 class="m-0 p-0"> <i class="fa-solid fa-crosshairs text-info"></i> </h2></span>
                                                    <input type="text" id="Cible1" class="form-control bg-info text-white font-weight-medium rounded-start rounded-4 fs-4" placeholder="Cible" aria-label="Username" aria-describedby="basic-addon2" readonly>
                                                </div>

                                            </div>

                                            <div class="col-7 ps-0" style="align-content: center;">



                                                {{-- <div class="d-flex ribbon7" style="background-color: #6d98fe;">
                                                    <span class="h6 font-weight-medium mb-1 pt-1" id="ecartName"></span>
                                                </div>

                                                <div class="input-group border border-warning border-2 rounded rounded-2 " >

                                                    <input type="text" id="ecartND2" class="form-control bg-white rounded-2 fs-4 text-center font-weight-bold" placeholder="Ecart" aria-label="Username" aria-describedby="basic-addon3" readonly>
                                                    <span class="input-group-text rounded-2 " style="background-color: #f0f0f0;">
                                                        <h3 id="performantIconP" style="margin-bottom: 0px; margin-top: 10px;">
                                                        </h3>
                                                    </span>
                                                </div>

                                                <div class="justify-content-center d-flex ribbon3">
                                                    <span class="h6 font-weight-medium text-dark" id="performantND2"></span>
                                                </div> --}}

                                            
                                                <div class="d-flex ribbon7 mt-1" style="background-color: #e7e7e7 !important;">
                                                    <span class="h6 font-weight-medium mb-1 pt-1" id="performantN">Ecart Annuel:</span>
                                                </div>

                                                <div class="input-group border border-warning border-2 rounded rounded-2 " >

                                                    <input type="text" id="ecartND" style="font-weight: bold;" class="form-control rounded-2 fs-4 text-center text-white" placeholder="Ecart" aria-label="Username" aria-describedby="basic-addon3" readonly>
                                                    <span class="input-group-text rounded-2 d-none" id="performant_ND_Icon_" style="background-color: #f0f0f0;">
                                                        <h3 id="performant_ND_Icon">
                                                        </h3>
                                                    </span>
                                                </div>

                                                <div class="justify-content-center d-flex ribbon3" id="performantND-BG">
                                                    <span class="h6 font-weight-medium text-white text-center" id="performantND"></span>
                                                </div>

                                            </div>




                                            {{-- ////////////////////// --}}






                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>





                        <div class="row mt-5">
                            <div class="col-5">
                                
                            </div>

                            <div class="col-7" style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;"                                      >

                                <div class="row p-3 bg-info bg-opacity-25 border border-info  border-end-0">

                                    <div class="col-4" style="align-content: center;">
                                        <h5 class="text-dark font-weight-medium text-center">
                                            <span id="simuND"></span>
                                        </h5>
                                    </div>

                                    <div class="col-4 ps-0" style="align-content: center;">


                                        <div class="d-flex ribbon7 ms-1" style="background-color: #e7e7e7">
                                            <span class="h6 font-weight-medium mb-1 pt-1" id="cibleName"></span>
                                        </div>

                                        <div class="input-group mb-3 border border-primary border-1 rounded rounded-4">
                                            <span class="input-group-text rounded-end rounded-4 p-1" style="background-color: #fff;" id="basic-addon2"><h2 class="m-0 p-0"> <i class="fa-solid fa-crosshairs text-info"></i> </h2></span>
                                            <input type="text" id="Cible2" class="form-control bg-info text-white font-weight-medium rounded-start rounded-4 fs-4" placeholder="Cible" aria-label="Username" aria-describedby="basic-addon2" readonly>
                                        </div>

                                    </div>

                                    <div class="col-4 ps-0" style="align-content: center;">



                                        <div class="d-flex ribbon7" style="background-color: #e7e7e7;">
                                            <span class="h6 font-weight-medium mb-1 pt-1" id="ecartName"></span>
                                        </div>

                                        <div class="input-group border border-warning border-2 rounded rounded-2">

                                            <input type="text" id="ecartND2" style="font-weight: bold;" class="form-control rounded-2 fs-4 text-center text-white" placeholder="Ecart" aria-label="Username" aria-describedby="basic-addon3" readonly>
                                            <span class="input-group-text rounded-2 d-none" id="performant_ND_Icon2_" style="background-color: #f0f0f0;">
                                                <h3 id="performant_ND_Icon2">
                                                </h3>
                                            </span>
                                        </div>

                                        <div class="justify-content-center d-flex ribbon3" id="performantND2-BG">
                                            <span class="h6 font-weight-medium text-white text-center" id="performantND2"></span>
                                        </div>
                                        


                            

                                    </div>
                                </div>


                            </div>
                        </div>













                        <div class="col-9">
                            <div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
                                <i class="fa-solid fa-circle-info me-2 fa-beat"></i>
                                <div id="formuleNumDenom" class="font-weight-medium">
                                    La formule de calcul:
                                </div>
                            </div>
                        </div>

                    </div>



                    <div id="chiffre" class="col-lg-12 p-4 d-none" style="background-color: rgba(232, 234, 236, 0.32); background-image: url('{{ asset('assets/calc6.jpg') }}'); background-size: cover; background-position: center; align-content: center;">
        
                        <div class="col-12" style="align-content: center; padding-left: 0;">
                            <div class="row">   
                                <div class="col-6">
                                    <div class="input-group" style="margin-top: 28px;">
                                        <span class="input-group-text border border-start font-weight-medium" style="font-size: large; color: #000000" id="chifr"></span>
                                        <span class="input-group-text" id="basic-addon1"><h1 class="m-0">=</h1></span>
                                        <input type="text" id="ResultChiffre" class="form-control bg-white fs-4" placeholder="Result" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                        <span class="input-group-text" id="typeC"><h4 class="m-0"></h4></span>
                                    </div>
                                </div>

                                <div class="col-4">

                                    <div class="d-flex ribbon7 ms-1" style="background-color: #e7e7e7 !important;">
                                        <span class="h5 font-weight-medium mb-1 pt-1" id="">Cible Annuelle:</span>
                                    </div>

                                    <div class="input-group border border-primary border-1 rounded rounded-4">
                                        <span class="input-group-text rounded-end rounded-4" style="background-color: #fff;" id="basic-addon2"><h2 class="m-0"><i class="fa-solid fa-crosshairs text-info"></i></h2></span>
                                        <input type="text" id="Cible2CH" class="form-control bg-info text-white rounded-start rounded-4" placeholder="Cible" aria-label="Username" aria-describedby="basic-addon2" readonly>
                                    </div>

                                </div>

                                <div class="col-2" style="align-content: center;">


                                    <div class="d-flex ribbon7 ms-1" style="background-color: #e7e7e7 !important;">
                                        <span class="h5 font-weight-medium mb-1 pt-1" id="">Ecart Annuel:</span>
                                    </div>

                                    <div class="input-group border border-warning border-2 rounded rounded-2" >
                                        <input type="text" id="ecartC" style="font-weight: bold;" class="form-control rounded-2 fs-4 text-center text-white" placeholder="Ecart" aria-label="Username" aria-describedby="basic-addon5" readonly>
                                        <span class="input-group-text rounded-2 d-none" id="performant_CH_Icon_" style="background-color: #f0f0f0;">
                                            <h3 id="performant_CH_Icon">
                                            </h3>
                                        </span>
                                    </div>

                                    <div class="justify-content-center d-flex ribbon3" id="performantC-BG">
                                        <span class="h5 font-weight-medium me-2 text-white text-center" id="performantC"></span>
                                    </div>

                                </div>

                            </div>
                        </div>






                        <div class="row mt-5">
                            <div class="col-4">
                                
                            </div>

                            <div class="col-8" style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;">

                                <div class="row p-3 bg-info bg-opacity-25 border border-info  border-end-0">

                                    <div class="col-4" style="align-content: center;">
                                        <h3 class="text-dark font-weight-medium text-center">
                                            <span id="simuCH"></span>
                                        </h3>
                                    </div>

                                    <div class="col-5 ps-0" style="align-content: center;">


                                        <div class="d-flex ribbon7 ms-1" style="background-color: #e7e7e7">
                                            <span class="h5 font-weight-medium mb-1 pt-1" id="cibleNameCH"></span>
                                        </div>

                                        <div class="input-group border border-primary border-1 rounded rounded-4 mb-2">
                                            <span class="input-group-text rounded-end rounded-4" style="background-color: #fff;" id="basic-addon2"><h2 class="m-0">  <i class="fa-solid fa-crosshairs text-info"></i> </h2></span>
                                            <input type="text" id="Cible2CH_P" class="form-control bg-info text-white font-weight-medium rounded-start rounded-4" placeholder="Cible" aria-label="Username" aria-describedby="basic-addon2" readonly>
                                        </div>

                                    </div>

                                    <div class="col-3 ps-0" style="align-content: center;">



                                        <div class="d-flex ribbon7 ms-1" style="background-color: #e7e7e7">
                                            <span class="h5 font-weight-medium mb-1 pt-1" id="ecartNameCH"></span>
                                        </div>

                                        <div class="input-group border border-warning border-2 rounded rounded-2" >
                                            <input type="text" id="ecartC2" style="font-weight: bold;" class="form-control rounded-2 fs-4 text-center text-white" placeholder="Ecart" aria-label="Username" aria-describedby="basic-addon5" readonly>
                                            <span class="input-group-text rounded-2 d-none" id="performant_CH_Icon2_" style="background-color: #f0f0f0;">
                                                <h3 id="performant_CH_Icon2">
                                                </h3>
                                            </span>
                                        </div>

                                        <div class="justify-content-center d-flex ribbon3" id="performantC2-BG">
                                            <span class="h5 font-weight-medium me-2 text-white text-center" id="performantC2"></span>
                                            
                                        </div>
                                            


                            

                                    </div>
                                </div>


                            </div>
                        </div>










                        <div class="col-9">
                            <div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
                                <i class="fa-solid fa-circle-info me-2 fa-beat"></i>
                                <div id="formuleChiffre" class="font-weight-medium">
                                    La formule de calcul:
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </div>

        {{-- START tabe SELECT DC DR --}}
        <div class="col-12">
            <ul class="nav nav-pills bg-nav-pills nav-justified">

                <li class="nav-item">
                    <a href="#DC" data-bs-toggle="tab" aria-expanded="false"
                        class="nav-link rounded-0 active">
                        <i class="mdi mdi-home-variant d-lg-none d-block me-1"></i>
                        <span class="d-none d-lg-block">Au niveau Centrale</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#DR" data-bs-toggle="tab" aria-expanded="true"
                        class="nav-link rounded-0 ">
                        <i class="mdi mdi-account-circle d-lg-none d-block me-1"></i>
                        <span class="d-none d-lg-block">Au niveau Régionale</span>
                    </a>
                </li>
                
            </ul>
        </div>
        {{-- END tabe SELECT DC DR --}}

        <div class="tab-content">

            {{-- Start DC PART --}}
            <div class="tab-pane show active" id="DC">

                {{-- Start Cause DC --}}
                <div class="col-lg-12" id="CDC" style="display: none">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-5 ps-0" style="align-content: center; margin-bottom: 15px;">
                                <div class="d-flex">
                                    <span class="h3 text-dark font-weight-medium mb-1 pt-1">Analyse causale</span>
                                </div>
                            </div>
                        
                            <div class="table-responsive">
                                <table id="causeDc" class="table border">
                                    <thead>
                                        <tr class="font-weight-medium text-light bg-info">
                                            <th style="width: 20%">Structure Centrale</th>
                                            <th style="width: 40%">Causes</th>
                                            <th style="width: 40%">Actions correctives</th>
                                        </tr>
                                    </thead>


                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{-- END Cause DC --}}

                {{-- start Action DC --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-5 ps-0" style="align-content: center; margin-bottom: 15px;">
                                <div class="d-flex">
                                    <span class="h3 text-dark font-weight-medium mb-1 pt-1">Actions</span>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="actCop" class="table border">
                                    <thead>
                                        <tr class="font-weight-medium text-light bg-info">
                                            <th style="width: 20%">Structure Centrale</th>
                                            <th style="width: 35%">Action</th>
                                            <th style="width: 12%">Date début</th>
                                            <th style="width: 12%">Date fin</th>
                                            <th style="width: 21%">Etat (Temps ecoulé / Avancement %)</th>
                                        </tr>
                                    </thead>


                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{-- END Action DC --}}

            </div>
            {{-- End DC PART --}}


            {{-- Start DC PART --}}
            <div class="tab-pane" id="DR">
                
                {{-- Start Cause DR --}}
                <div class="col-lg-12" id="CDR" style="display: none">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-5 ps-0" style="align-content: center; margin-bottom: 15px;">
                                <div class="d-flex">
                                    <span class="h3 font-weight-medium mb-1 pt-1">Analyse causale</span>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="causeDr" class="table border">
                                    <thead>
                                        <tr class="font-weight-medium text-light bg-info">
                                            <th style="width: 20%">Direction régionale</th>
                                            <th style="width: 40%">Causes</th>
                                            <th style="width: 40%">Actions correctives</th>
                                        </tr>
                                    </thead>


                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{-- End Cause DR --}}
                
                {{-- End Action DR --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-5 ps-0" style="align-content: center; margin-bottom: 15px;">
                                <div class="d-flex">
                                    <span class="h3 font-weight-medium text-dark mb-1 pt-1">Actions</span>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="actCopDr" class="table border">
                                    <thead>
                                        <tr class="font-weight-medium text-light bg-info">
                                            <th style="width: 20%">Direction régionale</th>
                                            <th style="width: 35%">Action</th>
                                            <th style="width: 12%">Date début</th>
                                            <th style="width: 12%">Date fin</th>
                                            <th style="width: 21%">Etat (Temps ecoulé / Avancement %)</th>
                                        </tr>
                                    </thead>


                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{-- End Action DR --}}

            </div>
            {{-- Start DC PART --}}
            
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-2 border border-1 border-primary">

                        <li class="nav-item border border-1 border-primary">
                            <a href="#t" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0 {{ $myPeriod == '03' ? 'show active ' : ' ' }} {{ $month < 4 ? 'disabled' : '' }}">
                                <i class="mdi mdi-home-variant d-lg-none d-block me-1"></i>
                                <span class="d-none font-weight-medium d-lg-block">Trimestre</span>
                            </a>
                        </li>
                        <li class="nav-item border border-1 border-primary">
                            <a href="#s" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0 {{ $myPeriod == '06' ? 'show active ' : ' ' }} {{ $month < 7 ? 'disabled' : '' }}">
                                <i class="mdi mdi-account-circle d-lg-none d-block me-1"></i>
                                <span class="d-none font-weight-medium d-lg-block">Semestre</span>
                            </a>
                        </li>
                        <li class="nav-item border border-1 border-primary">
                            <a href="#n" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0 {{ $myPeriod == '09' ? 'show active ' : ' ' }} {{ $month < 10 ? 'disabled' : '' }}">
                                <i class="mdi mdi-settings-outline d-lg-none d-block me-1"></i>
                                <span class="d-none font-weight-medium d-lg-block">Neuf mois</span>
                            </a>
                        </li>
                        <li class="nav-item border border-1 border-primary">
                            <a href="#a" data-bs-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0 {{ $myPeriod == '12' ? 'show active ' : ' ' }} {{ ($month > 3 || !$CopValeurA2) ? 'disabled' : '' }}">
                                <i class="mdi mdi-settings-outline d-lg-none d-block me-1"></i>
                                <span class="d-none font-weight-medium d-lg-block">Année</span>
                            </a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane {{ $myPeriod == '03' ? 'show active ' : ' ' }}" id="t">
                            



                            <div class="table-responsive">
                                <table class="table v-middle mb-0">
                                    <thead>
                                        <tr class="border-0 text-center">
                                            <th class="border-0 font-16 text-white font-weight-medium">
                                            </th>
                                            <th class="border-0 font-16 text-white font-weight-medium px-2">
                                            </th>
                                            <th class="border-0 font-16 text-dark-100 font-weight-medium"></th>
                                            
                                            <th class="border-0 font-14 font-weight-medium  text-white"></th>
                                            <th class="border-0 font-14 font-weight-medium"></th>
                                            <th class="border-0 font-14 font-weight-medium"></th>

                                            <th colspan="2" class="border font-18 border-5 border-bottom-0 border-warning font-16 font-weight-medium text-center text-dark bg-warning">
                                                Simulation
                                            </th>
                                        </tr>
                                        <tr class="border-0 text-center">
                                            <th class="border-0 font-16 text-white font-weight-medium" style="background-color: #FF5F00;">Objectif
                                            </th>
                                            <th class="border-0 font-16 text-white font-weight-medium px-2" style="background-color: #002379;">Indicateur
                                            </th>
                                            <th class="border-0 font-16 text-dark font-weight-medium" style="background-color: #ffcb00d4">Mode de calcul</th>
                                            <th class="border-0 font-16 text-dark font-weight-medium" style="background-color: #e2e2e2">Result</th>
                                            
                                            <th class="border-0 font-16 font-weight-medium text-dark" style="background-color: #48CFCB;"><h2 class="m-0"><i class="fa-solid fa-crosshairs fa-fade text-info"></i></h2> Cible Annuel</th>
                                            <th class="border-0 font-16 font-weight-medium text-dark" style="background-color: #48CFCB;">Ecart Annuel</th>

                                            <th class="border-0 font-16 font-weight-medium border-4 border-warning border-start text-center text-dark" style="background-color: #48CFCB;">
                                                <h2 class="m-0"><i class="fa-solid fa-crosshairs fa-fade text-info"></i></h2> Cible Trimestriel
                                            </th>
                                            <th class="border-0 font-16 font-weight-medium border-5 border-warning border-end text-center text-dark" style="background-color: #48CFCB;">
                                                Ecart Trimestriel
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($CopValeurT as $copV)
                                            
                                        

                                                <tr class="text-center">
                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ff975d6b;">
                                                        <div class="d-flex align-items-center">
                                                            <div class="text-center">
                                                                <h5 class="text-gray-800 mb-0 font-16 font-weight-medium">
                                                                    {{$copV->objectif->lib_obj}}
                                                                </h5>
                                                                <span class="font-14" style="color: #595959;">
                                                                    {{$copV->sousObjectif->lib_sous_obj}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="border-top-0 font-weight-medium text-center px-2 py-4 font-16" style="background-color: #3871ff87;">
                                                        {{$copV->indicateur->lib_ind}}
                                                    </td>

                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ffcb0061">
                                                        <div class="">
                                                            <span class=" font-16">
                                                                {{$copV->indicateur->formule}}
                                                                {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                        </div>
                                                        
                                                    </td>

                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #f8eded82">
                                                        <div class="">
                                                            <span class=" font-16">

                                                                {{$copV->result}} 

                                                                {{$copV->copCible->unite}}
                                                                
                                                                {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                        </div>
                                                        
                                                    </td>
                                                    
                                                    <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center text-dark" style="background-color: #48CFCB;">
                                                        <div class="">
                                                            <h5 class="font-16 font-weight-medium">

                                                                {{$copV->copCible->cible}} {{$copV->copCible->unite}}

                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-medium border-top-0 px-2 py-4 text-center {{$copV->ecartType == 'négatif'? 'text-danger' : 'text-white bg_succ'}}">
                                                        <div class="">
                                                            <h5 class="font-18 font-weight-medium">{{$copV->ecart}} %</h5>
                                                        </div>
                                                    </td>

                                                    <td class="border-0 text-center px-2 py-4 border-4 border-warning border-start text-center text-dark" style="background-color: #48CFCB;">
                                                        <div class="">
                                                            <h5 class="font-16 font-weight-medium">
                                                                {{$copV->copCible->cibleTrimestre}} {{$copV->copCible->unite}}
                                                            </h5>
                                                        </div>
                                                
                                                    </td>
                                                    <td class="border-0 text-center font-weight-medium px-2 py-4 border-5 border-warning border-end {{$copV->ecartTypeP == 'négatif'? 'text-danger' : 'text-white bg_succ'}}">
                                                        <div class="">
                                                            <h5 class="font-18 font-weight-medium">{{$copV->ecartP}} %</h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('export.copvaleur') }}" class="btn btn-success mt-3 float-end btn-lg">Télécharger Excel <i class="fa-solid fa-lg fa-download fa-bounce"></i> </a>



                        </div>
                        <div class="tab-pane {{ $myPeriod == '06' ? 'show active ' : ' ' }}" id="s">
                            




                            <div class="table-responsive">
                                <table class="table v-middle mb-0">
                                    <thead>
                                        <tr class="border-0 text-center">
                                            <th class="border-0 font-16 text-white font-weight-medium">
                                            </th>
                                            <th class="border-0 font-16 text-white font-weight-medium px-2">
                                            </th>
                                            <th class="border-0 font-16 text-dark-100 font-weight-medium"></th>
                                            
                                            <th class="border-0 font-14 font-weight-medium  text-white"></th>
                                            <th class="border-0 font-14 font-weight-medium"></th>
                                            <th class="border-0 font-14 font-weight-medium"></th>

                                            <th colspan="2" class="border font-18 border-5 border-bottom-0 border-warning font-16 font-weight-medium text-center text-dark bg-warning">
                                                Simulation
                                            </th>
                                        </tr>
                                        <tr class="border-0 text-center">
                                            <th class="border-0 font-16 text-white font-weight-medium" style="background-color: #FF5F00;">Objectif
                                            </th>
                                            <th class="border-0 font-16 text-white font-weight-medium px-2" style="background-color: #002379;">Indicateur
                                            </th>
                                            <th class="border-0 font-16 text-dark font-weight-medium" style="background-color: #ffcb00d4">Mode de calcul</th>
                                            <th class="border-0 font-16 text-dark font-weight-medium" style="background-color: #e2e2e2">Result</th>
                                            
                                            <th class="border-0 font-16 font-weight-medium text-dark" style="background-color: #48CFCB;"><h2 class="m-0"><i class="fa-solid fa-crosshairs fa-fade text-info"></i></h2> Cible Annuel</th>
                                            <th class="border-0 font-16 font-weight-medium text-dark" style="background-color: #48CFCB;">Ecart Annuel</th>

                                            <th class="border-0 font-16 font-weight-medium border-4 border-warning border-start text-center text-dark" style="background-color: #48CFCB;">
                                                <h2 class="m-0"><i class="fa-solid fa-crosshairs fa-fade text-info"></i></h2> Cible Semestriel
                                            </th>
                                            <th class="border-0 font-16 font-weight-medium border-5 border-warning border-end text-center text-dark " style="background-color: #48CFCB;">
                                                Ecart Semestriel
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">


                                        @foreach ($CopValeurS as $copV)
                                            
                                        

                                                <tr class="text-center">
                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ff975d6b;">
                                                        <div class="d-flex align-items-center">
                                                            <div class="text-center">
                                                                <h5 class="text-gray-800 mb-0 font-16 font-weight-medium">
                                                                    {{$copV->objectif->lib_obj}}
                                                                </h5>
                                                                <span class="font-14" style="color: #595959;">
                                                                    {{$copV->sousObjectif->lib_sous_obj}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="border-top-0 font-weight-medium text-center px-2 py-4 font-16" style="background-color: #3871ff87;">
                                                        {{$copV->indicateur->lib_ind}}
                                                    </td>

                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ffcb0061">
                                                        <div class="">
                                                            <span class=" font-16">
                                                                {{$copV->indicateur->formule}}
                                                        </div>
                                                        
                                                    </td>

                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #f8eded82">
                                                        <div class="">
                                                            <span class=" font-16">
                                                                {{$copV->result}} 

                                                                {{$copV->copCible->unite}}
                                                        </div>
                                                        
                                                    </td>
                                                    
                                                    <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center text-dark" style="background-color: #48CFCB;">
                                                        <div class="">
                                                            <h5 class="font-16 font-weight-medium">
                                                                {{$copV->copCible->cible}} {{$copV->copCible->unite}}
                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-medium border-top-0 px-2 py-4 text-center {{$copV->ecartType == 'négatif'? 'text-danger' : 'text-white bg_succ'}}">
                                                        <div class="">
                                                            <h5 class=" font-18 font-weight-medium">{{$copV->ecart}} %</h5>
                                                        </div>
                                                    </td>

                                                    <td class="border-0 text-center px-2 py-4 border-4 border-warning border-start text-center text-dark" style="background-color: #48CFCB;">
                                                        <div class="">
                                                            <h5 class="font-16 font-weight-medium">
                                                                {{$copV->copCible->cibleSemestre}} {{$copV->copCible->unite}}
                                                            </h5>
                                                        </div>
                                                
                                                    </td>
                                                    <td class="border-0 text-center font-weight-medium px-2 py-4 border-5 border-warning border-end {{$copV->ecartTypeP == 'négatif'? 'text-danger' : 'text-white bg_succ'}}">
                                                        <div class="">
                                                            <h5 class="font-18 font-weight-medium">{{$copV->ecartP}} %</h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <a href="{{ route('export.copvaleurS') }}" class="btn btn-lg btn-success mt-3 float-end">Télécharger Excel <i class="fa-solid fa-lg fa-download fa-bounce"></i> </a>




                        </div>
                        <div class="tab-pane {{ $myPeriod == '09' ? 'show active ' : ' ' }}" id="n">
                            



                            <div class="table-responsive">
                                <table class="table v-middle mb-0">
                                    <thead>
                                        <tr class="border-0 text-center">
                                            <th class="border-0 font-16 text-white font-weight-medium">
                                            </th>
                                            <th class="border-0 font-16 text-white font-weight-medium px-2">
                                            </th>
                                            <th class="border-0 font-16 text-dark-100 font-weight-medium"></th>
                                            
                                            <th class="border-0 font-14 font-weight-medium  text-white"></th>
                                            <th class="border-0 font-14 font-weight-medium"></th>
                                            <th class="border-0 font-14 font-weight-medium"></th>

                                            <th colspan="2" class="border font-18 border-5 border-bottom-0 border-warning font-16 font-weight-medium text-center text-dark bg-warning">
                                                Simulation
                                            </th>
                                        </tr>
                                        <tr class="border border-2 text-center">
                                            <th class="border-0 font-18 text-white font-weight-medium" style="background-color: #0A3990;">Objectif
                                            </th>
                                            <th class="border-0 font-18 text-white font-weight-medium px-2" style="background-color: #1F509A;">Indicateur
                                            </th>
                                            <th class="border-0 font-18 text-white font-weight-medium" style="background-color: #56a0d3">Mode de calcul</th>
                                            <th class="border-0 font-18 text-dark font-weight-medium" style="background-color: #e2e2e2">Result</th>
                                            
                                            <th class="border-0 font-16 font-weight-medium text-dark" style="background-color: #D8DBBD;"><h2 class="m-0"><i class="fa-solid fa-crosshairs fa-fade text-info"></i></h2> Cible Annuel</th>
                                            <th class="border-0 font-16 font-weight-medium text-dark" style="background-color: #D8DBBD;">Ecart Annuel</th>

                                            <th class="border-0 font-16 font-weight-medium border-4 border-warning border-start text-center text-dark" style="background-color: #D8DBBD;">
                                                <h2 class="m-0"><i class="fa-solid fa-crosshairs fa-fade text-info"></i></h2> Cible Neuf mois
                                            </th>
                                            <th class="border-0 font-16 font-weight-medium border-5 border-warning border-end text-center text-dark" style="background-color: #D8DBBD;">
                                                Ecart Neuf mois
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($CopValeurN as $copV)
                                            
                                        

                                                <tr class="text-center">
                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #0A3990;">
                                                        <div class="d-flex align-items-center">
                                                            <div class="text-center">
                                                                <h5 class="text-white mb-0 font-16 font-weight-medium">
                                                                    {{$copV->objectif->lib_obj}}
                                                                    
                                                                </h5>
                                                                <span class="font-14" style="color: #e1e1e1;">
                                                                    {{$copV->sousObjectif->lib_sous_obj}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="border-top-0 text-white font-weight-medium text-center px-2 py-4 font-16" style="background-color: #1F509A;">
                                                        {{$copV->indicateur->lib_ind}}
                                                    </td>

                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #56a0d3">
                                                        <div class="">
                                                            <span class="text-white font-16">
                                                                {{$copV->indicateur->formule}}
                                                                
                                                                {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                        </div>
                                                        
                                                    </td>

                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #f8eded82">
                                                        <div class="">
                                                            <span class=" font-16">
                                                                {{$copV->result}} 

                                                                {{$copV->copCible->unite}}
                                                                
                                                                {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                        </div>
                                                        
                                                    </td>
                                                    
                                                    <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center text-dark" style="background-color: #D8DBBD;">
                                                        <div class="">
                                                            <h5 class="font-16 font-weight-medium">
                                                                {{$copV->copCible->cible}} {{$copV->copCible->unite}}
                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-medium border-top-0 px-2 py-4 text-center {{$copV->ecartType == 'négatif'? 'text-danger' : 'text-white bg_succ'}}">
                                                        <div class="">
                                                            <h5 class="font-18 font-weight-medium">{{$copV->ecart}} %</h5>
                                                        </div>
                                                    </td>

                                                    <td class="border-0 text-center px-2 py-4 border-4 border-warning border-start text-center text-dark" style="background-color: #D8DBBD;">
                                                        <div class="">
                                                            <h5 class="font-16 font-weight-medium">
                                                                {{$copV->copCible->cibleT_Trimestre}} {{$copV->copCible->unite}}
                                                            </h5>
                                                        </div>
                                                
                                                    </td>
                                                    <td class="border-0 text-center font-weight-medium px-2 py-4 border-5 border-warning border-end {{$copV->ecartTypeP == 'négatif'? 'text-danger' : 'text-white bg_succ'}}">
                                                        <div class="">
                                                            <h5 class="font-18 font-weight-medium">{{$copV->ecartP}} %</h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('export.copvaleurN') }}" class="btn btn-success mt-3 float-end btn-lg">Télécharger Excel <i class="fa-solid fa-lg fa-download fa-bounce"></i> </a>



                        </div>
                        <div class="tab-pane {{ $myPeriod == '12' ? 'show active ' : ' ' }}" id="a">
                            


                            <div class="table-responsive">
                                <table class="table v-middle mb-0">
                                    <thead>
                                        <tr class="border-0 text-center">
                                            <th class="border-0 font-16 text-white font-weight-medium" style="background-color: #FF5F00;">Objectif
                                            </th>
                                            <th class="border-0 font-16 text-white font-weight-medium px-2" style="background-color: #002379;">Indicateur
                                            </th>
                                            <th class="border-0 font-16 text-dark font-weight-medium" style="background-color: #ffcb00d4">Mode de calcul</th>
                                            <th class="border-0 font-16 text-dark font-weight-medium" style="background-color: #e2e2e2">Result</th>
                                            
                                            <th class="border-0 font-16 font-weight-medium text-dark" style="background-color: #48CFCB;"><h2 class="m-0"><i class="fa-solid fa-crosshairs fa-fade text-info"></i></h2> Cible Annuel</th>
                                            <th class="border-0 font-16 font-weight-medium text-dark" style="background-color: #48CFCB;">Ecart Annuel</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($CopValeurA as $copV)
                                            
                                                <tr class="text-center">
                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ff975d6b;">
                                                        <div class="d-flex align-items-center">
                                                            <div class="text-center">
                                                                <h5 class="text-gray-800 mb-0 font-16 font-weight-medium">
                                                                    {{$copV->objectif->lib_obj}}
                                                                    
                                                                </h5>
                                                                <span class="font-14" style="color: #595959;">
                                                                    {{$copV->sousObjectif->lib_sous_obj}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="border-top-0 font-weight-medium text-center px-2 py-4 font-16" style="background-color: #3871ff87;">
                                                        {{$copV->indicateur->lib_ind}}
                                                    
                                                    </td>

                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ffcb0061;">
                                                        <div class="">
                                                            <span class=" font-16">
                                                                {{$copV->indicateur->formule}}
                                                                {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                        </div>
                                                        
                                                    </td>

                                                    <td class="border-top-0 px-2 py-4 text-center" style="background-color: #f8eded82">
                                                        <div class="">
                                                            <span class=" font-16">
                                                                {{$copV->result}} 

                                                                {{$copV->copCible->unite}}
                                                                {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                        </div>
                                                        
                                                    </td>
                                                    
                                                    <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center text-dark" style="background-color: #48CFCB;">
                                                        <div class="">
                                                            <h5 class="font-16 font-weight-medium">
                                                                {{$copV->copCible->cible}} {{$copV->copCible->unite}}
                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td class="font-weight-medium border-top-0 px-2 py-4 text-center {{$copV->ecartType == 'négatif'? 'text-danger' : 'text-white bg_succ'}}">
                                                        <div class="">
                                                            <h5 class="font-18 font-weight-medium">{{$copV->ecart}} %</h5>
                                                        </div>
                                                    </td>

                                                </tr>
                                                
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <a href="{{ route('export.copvaleurA') }}" class="btn btn-success mt-3 float-end btn-lg">Télécharger Excel <i class="fa-solid fa-lg fa-download fa-bounce"></i> </a>

                        </div>
                    </div>


                    {{-- <div class="row">
                        <div class="col-lg-10">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Etat de l'action</h4>
                                    <ul class="list-inline text-end">
                                        <li class="list-inline-item">
                                            <h5><i class="fa fa-circle me-1 text-info"></i>Structure Centrale</h5>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5><i class="fa fa-circle me-1 text-cyan"></i>Directions régionalle</h5>
                                        </li>
                                    </ul>
                                    <div id="morris-area-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
@endsection



@section('page-js')
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap tether Core JavaScript -->

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
    <script src="{{asset('dist/js/pages/morris/morris-data.js')}}"></script>

    {{-------------------------------------------------------------------------------------}}

    {{------------------------------------------DataTables-----------------------------------------------------}}
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>

    <script>

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
            if(val< 99.99) {actColorTimeText = 'text-warning';}
            else           {actColorTimeText = 'text-danger'; }

            return actColorTimeText;
        }

        function colorStatText (val)
        {
            // if(val< 50) {actColorEtat = 'bg-warning';}
            // else        {actColorEtat = 'bg-success';}
            actColorEtat = 'text-success';

            return actColorEtat;
        }


        $(document).ready(function() {
            $('#actCopDr').DataTable();
        });



        ///////////// COP ///////////////////////////////////////////////////////////////////////////////////////////////////////


        $(document).ready(function () 
        {
        ////////////////////START Objectif Selector ///////////////////////////////////////////////////////////////////
            $('#Objectif').on('change', function () 
            {
                    let id_obj = $(this).val();

                    $('#SousObjectif').empty();
                    $('#SousObjectif').append(`<option value="0" disabled selected>Traitement...</option>`);

                $.ajax({
                    type: 'GET',
                    url: '{{ url("/sObj") }}/' + id_obj,
                    success: function (response)
                    {
                        var response = JSON.parse(response);

                        $('#SousObjectif').empty();
                        $('#SousObjectif').append(`<option value="0" style="font-weight: bolder; color: rgb(169, 168, 168);" disabled selected>Selectionnez un Sous Objectif *</option>`);

                        response.forEach(element => { $('#SousObjectif').append(`<option value="${element['id_sous_obj']}">${element['lib_sous_obj']}</option>`); });
                    }
                });
            });
        //////////////////// END Objectif Selector ////////////////////////////////////////////////////////////////////

        ////////////////////START Sous Objectif Selector //////////////////////////////////////////////////////////////
        $('#SousObjectif').on('change', function () 
        {
                let id_sous_obj = $(this).val();

                $('#Indicateur').empty();
                $('#Indicateur').append(`<option value="0" disabled selected>Traitement...</option>`);

            $.ajax({

                type: 'GET',
                url: '{{ url("/ind") }}/' + id_sous_obj,
                success: function (response) 
                {
                    var response = JSON.parse(response);

                    $('#Indicateur').empty();
                    $('#Indicateur').append(`<option value="0" style="font-weight: bolder; color: rgb(169, 168, 168);" disabled selected>Selectionnez un Indicateur*</option>`);

                    response.forEach(element => { $('#Indicateur').append(`<option value="${element['id_ind']}">${element['lib_ind']}</option>`); });
                }
            });
        });
        ////////////////////END Sous Objectif Selector ////////////////////////////////////////////////////////////////

        ////////////////////START Indicateur Selector /////////////////////////////////////////////////////////////////
            $('#Indicateur').on('change', function () 
            {
                    let id_ind = $(this).val();
                    var dataTable = $('#actCop').DataTable();
                    var dataTableDr = $('#actCopDr').DataTable();
                    var dataTableCsDc = $('#causeDc').DataTable();
                    var dataTableCsDr = $('#causeDr').DataTable();

                    let month = $('#month').val();
                    let progressBarHTML;
                    let progressBarHTMLDr;


                $.ajax({

                    type: 'GET',
                    url: '{{ url("/res") }}/' + id_ind,
                    data: { month: month },

                    success: function (response) 
                    {
                        console.log(response.ecartType)

                        dataTable.clear().draw(); 
                        dataTableDr.clear().draw();
                        dataTableCsDc.clear().draw();
                        dataTableCsDr.clear().draw();
                        
                        ///////////// START test type /////////////////////////////////////

                        const unitMapping = {
                                'DA': 'DA',
                                'NB': ' ',
                                'J': 'Jours',
                                'HJ': 'Heures / Jours',
                                'H': 'Heures',
                            };

                            const pMapping = {
                                '03': 'Trimestriel',
                                '06': 'Semestriel',
                                '09': '3eme Trimestre',
                                '12': 'Annuel',    
                            };
                            const pMapping2 = {
                                '03': 'Trimestrielle',
                                '06': 'Semestrielle',
                                '09': '3eme Trimestre',
                                '12': 'Annuelle',    
                            };

                        if (response.type == 'nd') 
                        {

                            $('#numDenom').removeClass('d-none').addClass('d-block');
                            $('#chiffre').removeClass('d-block').addClass('d-none');

                            $('#typeN').text(unitMapping[response.uniteNum] || '/');
                            $('#typeD').text(unitMapping[response.uniteDenom] || '/');

                            $('#num').text((response.libNum || '/') + ' :');
                            $('#denom').text((response.libDenom || '/') + ' :');
                            $('#numVal').val(response.valNum || '/');
                            $('#denomVal').val(response.valDenom || '/');
                            $('#formuleNumDenom').text('La formule de calcul : ' + (response.formule || '/'));

                            if (id_ind != '8') {
                                $('#Result').val(response.R + ' %');
                            }else{
                                $('#Result').val(response.R + ' DA');
                            }


                            $('#cibleName').text('Cible ' + (pMapping2[month] + ' :' || '/'));
                            $('#simuND').text('La simulation ' + pMapping2[month] + ' :' || '/');
                            $('#Cible1').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                            $('#Cible2').val((response.cible2 || '') + ' ' + (response.cibleUnite || ''));

                            $('#ecartName').text('Ecart ' + (pMapping[month] + ' :' || '/'));
                            $('#ecartND').val(response.ecart + ' %' || '/');
                            $('#ecartND2').val(response.ecart2 + ' %' || '/');

                            if (response.ecartType =='positif') {
                                $('#performantND').text("Performant");
                                $('#ecartND').removeClass('bg-danger').addClass('bg-success');
                                $('#performantND-BG').removeClass('bg-danger').addClass('bg-success');
                                $('#performant_ND_Icon_').removeClass('d-none').addClass('d-block');
                                $('#performant_ND_Icon').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                            }if (response.ecartType =='négatif'){
                                $('#performantND').text("Non performant");
                                $('#ecartND').removeClass('bg-success').addClass('bg-danger');
                                $('#performantND-BG').removeClass('bg-success').addClass('bg-danger');
                                $('#performant_ND_Icon_').removeClass('d-block').addClass('d-none');
                            } 


                            if (response.ecartType2 =='positif') {
                                $('#performantND2').text("Performant");
                                $('#ecartND2').removeClass('bg-danger').addClass('bg-success');
                                $('#performantND2-BG').removeClass('bg-danger').addClass('bg-success');
                                $('#performant_ND_Icon2_').removeClass('d-none').addClass('d-block');
                                $('#performant_ND_Icon2').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                            }if (response.ecartType2 =='négatif'){
                                $('#performantND2').text("Non performant");
                                $('#ecartND2').removeClass('bg-success').addClass('bg-danger');
                                $('#performantND2-BG').removeClass('bg-success').addClass('bg-danger');
                                $('#performant_ND_Icon2_').removeClass('d-block').addClass('d-none');
                            } 
                            
                        }
                        else 
                        {
                            $('#numDenom').removeClass('d-block').addClass('d-none');
                            $('#chiffre').removeClass('d-none').addClass('d-block');
                            $('#typeC').text(unitMapping[response.uniteC] || '/');

                            $('#chifr').text(response.libChiffre || '/');
                            $('#ResultChiffre').val(response.valChiffre || '/');
                            $('#formuleChiffre').text('La formule de calcul: ' + (response.formule || '/'));
                            $('#cibleNameCH').text('Cible ' + (pMapping2[month] + ' :' || '/'));
                            $('#simuCH').text(('La simulation ' + pMapping2[month] + ' :' || '/'));
                            $('#Cible2CH').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                            $('#Cible2CH_P').val((response.cible2 || '') + ' ' + (response.cibleUnite || ''));

                            $('#ecartNameCH').text('Ecart ' + (pMapping[month] + ' :' || '/'));
                            $('#ecartC').val(response.ecart + ' %' || '/');
                            $('#ecartC2').val(response.ecart2 + ' %' || '/');


                            if (response.ecartType =='positif') {
                                $('#performantC').text("Performant");
                                $('#ecartC').removeClass('bg-danger').addClass('bg-success');
                                $('#performantC-BG').removeClass('bg-danger').addClass('bg-success');
                                $('#performant_CH_Icon_').removeClass('d-none ').addClass('d-block');
                                $('#performant_CH_Icon').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                            }
                            if(response.ecartType =='négatif'){
                                $('#performantC').text("Non performant");
                                $('#ecartC').removeClass('bg-success').addClass('bg-danger');
                                $('#performantC-BG').removeClass('bg-success').addClass('bg-danger');
                            }

                            if (response.ecartType2 =='positif') {
                                $('#performantC2').text("Performant");
                                $('#ecartC2').removeClass('bg-danger').addClass('bg-success');
                                $('#performantC2-BG').removeClass('bg-danger').addClass('bg-success');
                                $('#performant_CH_Icon2_').removeClass('d-none').addClass('d-block');
                                $('#performant_CH_Icon2').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');

                                
                            }
                            if(response.ecartType2 =='négatif') {
                                $('#performantC2').text("Non performant");
                                $('#ecartC2').removeClass('bg-success').addClass('bg-danger');
                                $('#performantC2-BG').removeClass('bg-success').addClass('bg-danger');
                                $('#performant_CH_Icon2_').removeClass('d-block').addClass('d-none');
                            }

                        }
                        ////////////// END test type ///////////////////////////////////

                        ////////////// START Ecart test /////////////////////////////////
                        if (response.ecartType === 'négatif---') 
                        {

                            document.getElementById('CDC').style.display = 'block';
                            document.getElementById('CDR').style.display = 'block';

                            if (response.causesDc.length > 0) 
                            {
                                for (let i = 0 ; i<response.causesDc.length ; i++)

                                {
                                    var newRow = dataTableCsDc.row.add([
                                        response.causesDc[i].lib_dir,    
                                        response.causesDc[i].lib_cause,
                                        response.causesDc[i].lib_correct,
                                        ]).draw(false).node();
                                        newRow.id = 'cause'+i;
                                }
                                    
                            }

                            if (response.causesDr.length > 0) 
                            {
                                for (let i = 0 ; i<response.causesDr.length ; i++)

                                {
                                    var newRow = dataTableCsDc.row.add([
                                        response.causesDr[i].lib_dir,    
                                        response.causesDr[i].lib_cause,
                                        response.causesDr[i].lib_correct,
                                        ]).draw(false).node();
                                        newRow.id = 'cause'+i;
                                }
                                    
                            }
                        } 
                        else
                        {
                        document.getElementById('CDC').style.display = 'none';
                        document.getElementById('CDR').style.display = 'none';
                        }
                        ////////////// END Ecart test /////////////////////////////////



                        ///////////// START ACTION DC  //////////////////////////////////
                        response.actionsDc.forEach(function(action)
                        {
                                var startDate = new Date(action.dd);
                                var endDate = new Date(action.df);

                                let JSdate = @json($JSdate);
                                var currentDate = new Date(JSdate);

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

                                actColorTime = colorTime (tempEcolAct);
                                actColorEtat = colorStat (action.etat);
                                
                                if(action.etat == null)
                                {
                                    var progressBarHTML = '<div style="width: 90% ">' +
                                                '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                    '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar ' +actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
        
                                                '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                    '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                    '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
                                            
                                }
                                else
                                {
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


                                response.act_cops.forEach(function(act_cop)
                                {
                                    if(action.id_act == act_cop.id_act)
                                    {
                                        var startDate = new Date(action.dd);
        
                                        var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });

                                        var endDate = new Date(action.df);
        
                                        var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
        
        
                                        var newRow = dataTable.row.add([
                                        act_cop.lib_dc,
                                        act_cop.lib_act_cop,
                                        formattedStartDate,
                                        formattedEndDate,
                                        progressBarHTML,
                                        ]).draw(false).node();
                                        newRow.id = action.id_act;
        
                                    }
                                });


                        });
                        //////////// END ACTION DC ///////////////////////////////////////

                        ///////////// START ACTION DR  //////////////////////////////////
                        response.actionsDr.forEach(function(actiondr)
                        {
                            var startDate = new Date(actiondr.dd);
                            var endDate = new Date(actiondr.df);

                            let JSdate = @json($JSdate);
                            var currentDate = new Date(JSdate);

                            var totalDuration = endDate.getTime() - startDate.getTime();
                            var tempEcolAct;

                            if (currentDate < startDate) {
                                tempEcolActDr = 0;
                            } else if (currentDate <= endDate) {
                                var currentDuration = currentDate.getTime() - startDate.getTime();
                                tempEcolActDr = ((currentDuration / totalDuration) * 100);
                            } else {
                                tempEcolActDr = 100;
                            }

                            actColorTimeDr = colorTime (tempEcolActDr);
                            actColorEtatDr = colorStat (actiondr.etat);
                        

                            if(actiondr.etat == null)
                                {
                                    var progressBarHTMLDr = '<div style="width: 90% ">' +
                                                '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                    '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar ' +actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
        
                                                '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                    '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                    '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
                                            
                                }
                                else
                                {
                                    var progressBarHTMLDr = '<div style="width: 90% ">' +
                                                '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                    '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar '+actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +

                                                '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +actiondr.etat.toFixed(2)+ '%</span></div>' +
                                                    '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +actiondr.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar '+actColorEtatDr+'" style="width: ' + actiondr.etat + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
                                }

                            
                            //  get directions name //////////////////////////////////////////////////////////////////////////
                            response.directionsDr.forEach(function(direction)
                            {
                                if(actiondr.id_dr == direction.id_dir)
                                {
                                    var ddDate = new Date(actiondr.dd);
                                    var formattedDD = ("0" + ddDate.getDate()).slice(-2) + "/" + ("0" + (ddDate.getMonth() + 1)).slice(-2) + "/" + ddDate.getFullYear();

                                    var dfDate = new Date(actiondr.df);
                                    var formattedDF = ("0" + dfDate.getDate()).slice(-2) + "/" + ("0" + (dfDate.getMonth() + 1)).slice(-2) + "/" + dfDate.getFullYear();

                                    var newRow = dataTableDr.row.add([
                                    direction.lib_dir,
                                    actiondr.lib_act_cop_dr,
                                    formattedDD,
                                    formattedDF,
                                    progressBarHTMLDr,
                                    ]).draw(false).node();
                                    newRow.id = actiondr.id_act_cop_dr;

                                }
                            });

                        });
                        ///////////// END ACTION DR  /////////////////////////////////////
                    }

                });
            });


        //////////////////// Month Selector ///////////////////
            $('#month').on('change', function () 
            {
                    let month = $(this).val();
                    var dataTable = $('#actCop').DataTable();
                    var dataTableDr = $('#actCopDr').DataTable();
                    var dataTableCsDc = $('#causeDc').DataTable();
                    var dataTableCsDr = $('#causeDr').DataTable();

                    let id_ind = $('#Indicateur').val();
                    let progressBarHTML;
                    let progressBarHTMLDr;


                $.ajax({

                    type: 'GET',
                    url: '{{ url("/res") }}/' + id_ind,
                    data: { month: month },

                    success: function (response) 
                    {
                        console.log(response.ecartType)

                        dataTable.clear().draw(); 
                        dataTableDr.clear().draw();
                        dataTableCsDc.clear().draw();
                        dataTableCsDr.clear().draw();

                        const unitMapping = {
                                'DA': 'DA',
                                'NB': ' ',
                                'J': 'Jours',
                                'HJ': 'Heures / Jours',
                                'H': 'Heures',
                            };

                            const pMapping = {
                                '03': 'Trimestriel',
                                '06': 'Semestriel',
                                '09': '3eme Trimestre',
                                '12': 'Annuel',    
                            };

                            const pMapping2 = {
                                '03': 'Trimestrielle',
                                '06': 'Semestrielle',
                                '09': '3eme Trimestre',
                                '12': 'Annuelle',    
                            };
                        
                        ///////////// START test type /////////////////////////////////////
                        if (response.type == 'nd') 
                        {

                            $('#numDenom').removeClass('d-none').addClass('d-block');
                            $('#chiffre').removeClass('d-block').addClass('d-none');

                            $('#typeN').text(unitMapping[response.uniteNum] || '/');
                            $('#typeD').text(unitMapping[response.uniteDenom] || '/');

                            $('#num').text((response.libNum || '/') + ' :');
                            $('#denom').text((response.libDenom || '/') + ' :');
                            $('#numVal').val(response.valNum || '/');
                            $('#denomVal').val(response.valDenom || '/');
                            $('#formuleNumDenom').text('La formule de calcul : ' + (response.formule || '/'));


                            if (id_ind != '8') {
                                $('#Result').val(response.R + ' %');
                            }else{
                                $('#Result').val(response.R + ' DA');
                            }

                        
                            $('#cibleName').text('Cible ' + (pMapping2[month] + ' :' || '/'));
                            $('#simuND').text('La simulation ' + pMapping2[month] + ' :' || '/');
                            $('#Cible1').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                            $('#Cible2').val((response.cible2 || '') + ' ' + (response.cibleUnite || ''));

                            $('#ecartName').text('Ecart ' + (pMapping[month] + ' :' || '/'));
                            $('#ecartND').val(response.ecart + ' %' || '/');
                            $('#ecartND2').val(response.ecart2 + ' %' || '/');

                            if (response.ecartType =='positif') {
                                $('#performantND').text("Performant");
                                $('#ecartND').removeClass('bg-danger').addClass('bg-success');
                                $('#performantND-BG').removeClass('bg-danger').addClass('bg-success');
                                $('#performant_ND_Icon_').removeClass('d-none').addClass('d-block');
                                $('#performant_ND_Icon').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                            }if (response.ecartType =='négatif'){
                                $('#performantND').text("Non performant");
                                $('#ecartND').removeClass('bg-success').addClass('bg-danger');
                                $('#performantND-BG').removeClass('bg-success').addClass('bg-danger');
                                $('#performant_ND_Icon_').removeClass('d-block').addClass('d-none');
                            } 


                            if (response.ecartType2 =='positif') {
                                $('#performantND2').text("Performant");
                                $('#ecartND2').removeClass('bg-danger').addClass('bg-success');
                                $('#performantND2-BG').removeClass('bg-danger').addClass('bg-success');
                                $('#performant_ND_Icon2_').removeClass('d-none').addClass('d-block');
                                $('#performant_ND_Icon2').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                            }if (response.ecartType2 =='négatif'){
                                $('#performantND2').text("Non performant");
                                $('#ecartND2').removeClass('bg-success').addClass('bg-danger');
                                $('#performantND2-BG').removeClass('bg-success').addClass('bg-danger');
                                $('#performant_ND_Icon2_').removeClass('d-block').addClass('d-none');
                            } 
                            
                        }
                        else 
                        {

                            $('#numDenom').removeClass('d-block').addClass('d-none');
                            $('#chiffre').removeClass('d-none').addClass('d-block');
                            $('#typeC').text(unitMapping[response.uniteC] || '/');

                            $('#chifr').text(response.libChiffre || '/');
                            $('#ResultChiffre').val(response.valChiffre || '/');
                            $('#formuleChiffre').text('La formule de calcul: ' + (response.formule || '/'));
                            $('#cibleNameCH').text('Cible ' + (pMapping2[month] + ' :' || '/'));
                            $('#simuCH').text(('La simulation ' + pMapping2[month] + ' :' || '/'));
                            $('#Cible2CH').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                            $('#Cible2CH_P').val((response.cible2 || '') + ' ' + (response.cibleUnite || ''));

                            $('#ecartNameCH').text('Ecart ' + (pMapping[month] + ' :' || '/'));
                            $('#ecartC').val(response.ecart + ' %' || '/');
                            $('#ecartC2').val(response.ecart2 + ' %' || '/');


                            if (response.ecartType =='positif') {
                                $('#performantC').text("Performant");
                                $('#ecartC').removeClass('bg-danger').addClass('bg-success');
                                $('#performantC-BG').removeClass('bg-danger').addClass('bg-success');
                                $('#performant_CH_Icon_').removeClass('d-none ').addClass('d-block');
                                $('#performant_CH_Icon').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                            }
                            if(response.ecartType =='négatif'){
                                $('#performantC').text("Non performant");
                                $('#ecartC').removeClass('bg-success').addClass('bg-danger');
                                $('#performantC-BG').removeClass('bg-success').addClass('bg-danger');
                            }

                            if (response.ecartType2 =='positif') {
                                $('#performantC2').text("Performant");
                                $('#ecartC2').removeClass('bg-danger').addClass('bg-success');
                                $('#performantC2-BG').removeClass('bg-danger').addClass('bg-success');
                                $('#performant_CH_Icon2_').removeClass('d-none').addClass('d-block');
                                $('#performant_CH_Icon2').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');

                                
                            }
                            if(response.ecartType2 =='négatif') {
                                $('#performantC2').text("Non performant");
                                $('#ecartC2').removeClass('bg-success').addClass('bg-danger');
                                $('#performantC2-BG').removeClass('bg-success').addClass('bg-danger');
                                $('#performant_CH_Icon2_').removeClass('d-block').addClass('d-none');
                            }

                        }
                        ////////////// END test type ///////////////////////////////////

                        ////////////// START Ecart test /////////////////////////////////
                        if (response.ecartType === 'négatif---' ) 
                        {

                            document.getElementById('CDC').style.display = 'block';
                            document.getElementById('CDR').style.display = 'block';

                            if (response.causesDc.length > 0) 
                            {
                                for (let i = 0 ; i<response.causesDc.length ; i++)

                                {
                                    var newRow = dataTableCsDc.row.add([
                                        response.causesDc[i].lib_dir,    
                                        response.causesDc[i].lib_cause,
                                        response.causesDc[i].lib_correct,
                                        ]).draw(false).node();
                                        newRow.id = 'cause'+i;
                                }
                                    
                            }

                            if (response.causesDr.length > 0) 
                            {
                                for (let i = 0 ; i<response.causesDr.length ; i++)

                                {
                                    var newRow = dataTableCsDc.row.add([
                                        response.causesDr[i].lib_dir,    
                                        response.causesDr[i].lib_cause,
                                        response.causesDr[i].lib_correct,
                                        ]).draw(false).node();
                                        newRow.id = 'cause'+i;
                                }
                                    
                            }
                        } 
                        else
                        {
                        document.getElementById('CDC').style.display = 'none';
                        document.getElementById('CDR').style.display = 'none';
                        }
                        ////////////// END Ecart test /////////////////////////////////



                        ///////////// START ACTION DC  //////////////////////////////////
                        response.actionsDc.forEach(function(action)
                        {
                                var startDate = new Date(action.dd);
                                var endDate = new Date(action.df);

                                let JSdate = @json($JSdate);
                                var currentDate = new Date(JSdate);

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

                                actColorTime = colorTime (tempEcolAct);
                                actColorEtat = colorStat (action.etat);
                                
                                if(action.etat == null)
                                {
                                    var progressBarHTML = '<div style="width: 90% ">' +
                                                '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                    '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar ' +actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
        
                                                '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                    '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                    '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
                                            
                                }
                                else
                                {
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


                                response.act_cops.forEach(function(act_cop)
                                {
                                    if(action.id_act == act_cop.id_act)
                                    {
                                        var startDate = new Date(action.dd);
        
                                        var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });

                                        var endDate = new Date(action.df);
        
                                        var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
        
        
                                        var newRow = dataTable.row.add([
                                        act_cop.lib_dc,
                                        act_cop.lib_act_cop,
                                        formattedStartDate,
                                        formattedEndDate,
                                        progressBarHTML,
                                        ]).draw(false).node();
                                        newRow.id = action.id_act;
        
                                    }
                                });


                        });
                        //////////// END ACTION DC ///////////////////////////////////////

                        ///////////// START ACTION DR  //////////////////////////////////
                        response.actionsDr.forEach(function(actiondr)
                        {
                            var startDate = new Date(actiondr.dd);
                            var endDate = new Date(actiondr.df);

                            let JSdate = @json($JSdate);
                            var currentDate = new Date(JSdate);

                            var totalDuration = endDate.getTime() - startDate.getTime();
                            var tempEcolAct;

                            if (currentDate < startDate) {
                                tempEcolActDr = 0;
                            } else if (currentDate <= endDate) {
                                var currentDuration = currentDate.getTime() - startDate.getTime();
                                tempEcolActDr = ((currentDuration / totalDuration) * 100);
                            } else {
                                tempEcolActDr = 100;
                            }

                            actColorTimeDr = colorTime (tempEcolActDr);
                            actColorEtatDr = colorStat (actiondr.etat);
                        

                            if(actiondr.etat == null)
                                {
                                    var progressBarHTMLDr = '<div style="width: 90% ">' +
                                                '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                    '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar ' +actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
        
                                                '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                    '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                    '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
                                            
                                }
                                else
                                {
                                    var progressBarHTMLDr = '<div style="width: 90% ">' +
                                                '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                    '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar '+actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +

                                                '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +actiondr.etat.toFixed(2)+ '%</span></div>' +
                                                    '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +actiondr.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar '+actColorEtatDr+'" style="width: ' + actiondr.etat + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';
                                }

                            
                            //  get directions name //////////////////////////////////////////////////////////////////////////
                            response.directionsDr.forEach(function(direction)
                            {
                                if(actiondr.id_dr == direction.id_dir)
                                {
                                    var ddDate = new Date(actiondr.dd);
                                    var formattedDD = ("0" + ddDate.getDate()).slice(-2) + "/" + ("0" + (ddDate.getMonth() + 1)).slice(-2) + "/" + ddDate.getFullYear();

                                    var dfDate = new Date(actiondr.df);
                                    var formattedDF = ("0" + dfDate.getDate()).slice(-2) + "/" + ("0" + (dfDate.getMonth() + 1)).slice(-2) + "/" + dfDate.getFullYear();

                                    var newRow = dataTableDr.row.add([
                                    direction.lib_dir,
                                    actiondr.lib_act_cop_dr,
                                    formattedDD,
                                    formattedDF,
                                    progressBarHTMLDr,
                                    ]).draw(false).node();
                                    newRow.id = actiondr.id_act_cop_dr;

                                }
                            });

                        });
                        ///////////// END ACTION DR  /////////////////////////////////////
                    }

                });
            });



        ////////////////////END Indicateur Selector ///////////////////////////////////////////////////////////////////

        });


        ///////////// Start get sub table Dc /////////////////////////////////////////////////////////////////////////////
        $(document).ready(function()
        {
            var dataTable = $('#actCop').DataTable();

            function getFrenchMonthName(monthNumber) {
                const months = [
                    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
                ];
                return months[monthNumber - 1];
            }
            function format(infos) {
                var html = '<table class="table subtable" style="background-color:#f0f3ff;">' +
                '<thead style="background-color:#d7ddf8">' +
                    '<tr style="color:#6c6c6c;">' +
                        '<th style="width: 25% !important;">Ce qui a été fait</th>' +
                        '<th style="width: 25% !important;">Ce qui reste a faire</th>' +
                        '<th style="width: 25% !important;">Contraintes</th>' +
                        '<th style="width: 15% !important;">Mois</th>' +
                        '<th style="width: 15% !important;">Date de remplissage</th>' +
                        '<th style="width: 10% !important;">Avancement(%)</th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody >';

                infos.forEach(function(info)
                {
                    var date = new Date(info.date);
                    var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false});

                    var updateDate = '';
                    if (info.date_update && !isNaN(new Date(info.date_update).getTime())) {
                        var update = new Date(info.date_update);
                        updateDate = '<br><span class="text-success me-1">' + update.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false}) + '</span><i class="fa-solid fa-pen fa-sm text-success"></i>';
                    }

                    var moisName = getFrenchMonthName(parseInt(info.mois, 10));

                    var descMonth = new Date(info.date).getMonth() -1;
                    // var mm1 = descMonth - 1;
                    // var mm2 = descMonth - 2;
                        console.log('descMonth:', descMonth, 'info.mois:', info.mois);
                    var moisHtml = '';
                    if (info.mois <= descMonth) {
                        moisHtml = '<span class="me-1">' + formattedDate + '</span> <span style="color: rgb(255, 96, 96);"><i class="fa-solid fa-stopwatch fa-lg"></i></span>';
                    } else {
                        moisHtml = '<span>' + formattedDate + '</span>';
                    }




                    if (info.faite == '/' && info.a_faire =='/' && info.probleme == '/') {
                        
                    }else{

                        var faite = info.faite ? info.faite : '';
                        var a_faire = info.a_faire ? info.a_faire : '';
                        var probleme = info.probleme ? info.probleme : '';

                        html += '<tr>' +
                                    '<td class="td1">' + faite + '</td>' +
                                    '<td class="td2">' + a_faire + '</td>' +
                                    '<td class="td3">' + probleme + '</td>' +
                                    '<td class="td4">' + moisName + '</td>' +
                                    '<td class="td4dr">' + moisHtml + (info.date_update !== '' ? updateDate : '') + '</td>' +
                                    '<td class="td5"> '+ '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                            '<div class="fs-6 text-success">' +info.etat.toFixed(2)+ '%</div>' +
                                                            '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                                '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                                            '</div>' +
                                                        '</div>' +
                                    '</td>' +
                            '</tr>';
                    }
                });

                html += '</tbody>' + '</table>';
                return html;
            }

            // Event listener to toggle child rows ///////////////////////////////////////////////////////
            $('#actCop tbody').on('click', 'td', function()
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
                        url: '{{ url("/subtable") }}/' + act,
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
        //////////// END get sub table Dc ///////////////////////////////////////////////////////////////////////////////


        ///////////// Start get sub table Dr ////////////////////////////////////////////////////////////////////////////
        $(document).ready(function()
        {
            var dataTableDr = $('#actCopDr').DataTable();

            function getFrenchMonthName(monthNumber) {
                const months = [
                    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
                ];
                return months[monthNumber - 1]; 
            }
            function format(infoss) {
                var html = '<table class="table subtable" style="background-color:#f0f3ff;">' +
                '<thead style="background-color:#d7ddf8">' +
                    '<tr style="color:#6c6c6c;">' +
                        '<th style="width: 25% !important;">Ce qui a été fait</th>' +
                        '<th style="width: 25% !important;">Ce qui reste a faire</th>' +
                        '<th style="width: 25% !important;">Contraintes</th>' +
                        '<th style="width: 15% !important;">Mois</th>' +
                        '<th style="width: 15% !important;">Date de remplissage</th>' +
                        '<th style="width: 10% !important;">Avancement(%)</th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody >';

                infoss.forEach(function(info)
                {
                    var date = new Date(info.date);
                    var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false});

                    var updateDate = '';
                    if (info.date_update && !isNaN(new Date(info.date_update).getTime())) {
                        var update = new Date(info.date_update);
                        updateDate = '<br><span class="text-success me-1">' + update.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false}) + '</span><i class="fa-solid fa-pen fa-sm text-success"></i>';
                    }

                    var moisName = getFrenchMonthName(parseInt(info.mois, 10));

                    var descMonth = new Date(info.date).getMonth() -1;
                    
                        console.log('descMonth:', descMonth, 'info.mois:', info.mois);
                    var moisHtml = '';
                    if (info.mois <= descMonth) {
                        moisHtml = '<span class="me-1">' + formattedDate + '</span> <span style="color: rgb(255, 96, 96);"><i class="fa-solid fa-stopwatch fa-lg"></i></span>';
                    } else {
                        moisHtml = '<span>' + formattedDate + '</span>';
                    }

                    if (info.faite == '/' && info.a_faire =='/' && info.probleme == '/') {
                        
                    }else{

                        var faite = info.faite ? info.faite : '';
                        var a_faire = info.a_faire ? info.a_faire : '';
                        var probleme = info.probleme ? info.probleme : '';

                        html += '<tr>' +
                                '<td class="td1">' + faite + '</td>' +
                                '<td class="td2">' + a_faire + '</td>' +
                                '<td class="td3">' + probleme + '</td>' +
                                '<td class="td4">' + moisName + '</td>' +
                                '<td class="td4dr">' + moisHtml + (info.date_update !== '' ? updateDate : '') + '</td>' +
                                '<td class="td5"> '+ '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                        '<div class="fs-6 text-success">' +info.etat.toFixed(2)+ '%</div>' +
                                                        '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                            '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                                        '</div>' +
                                                    '</div>' +
                                '</td>' +
                        '</tr>';
                    }
                    
                });

                html += '</tbody>' + '</table>';
                return html;
            }

            // Event listener to toggle child rows //////////////////////////
            $('#actCopDr tbody').on('click', 'td', function()
            {
                var tr = $(this).closest('tr');
                var row = dataTableDr.row(tr);

                var act = $(this).closest('tr').attr('id');

                if (row.child.isShown())
                {

                    row.child.hide();
                    tr.removeClass('shown');
                }
                else
                {
                    // Close any open rows
                    dataTableDr.rows().every(function() {
                        if (this.child.isShown())
                        {
                            this.child.hide();
                            $(this.node()).removeClass('shown');
                        }
                    });

                    $.ajax({
                        type: 'GET',
                        url: '{{ url("/subtableDr") }}/' + act,
                        success: function(response)
                        {
                            console.log(response.infoss)


                            var subtableHtml = format(response.infoss);
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
        ///////////// END get sub table dr //////////////////////////////////////////////////////////////////////////////

        window.onload = function() {
            document.getElementById('Objectif').selectedIndex = 0;
        };

        // the Morris


        // $(function () {
// "use strict";
// Morris.Area({
//     element: 'morris-area-chart',
//     data: [{
//         period: '2010',
//         Structure_Centrale: 50,
//         Directions_régionalle: 80,
//         itouch: 20
//     },
//     {
//         period: '2011',
//         Structure_Centrale: 60,
//         Directions_régionalle: 90,
//         itouch: 20
//     },
//     {
//         period: '2012',
//         Structure_Centrale: 30,
//         Directions_régionalle: 60,
//         itouch: 20
//     },
//     {
//         period: '2013',
//         Structure_Centrale: 50,
//         Directions_régionalle: 80,
//         itouch: 20
//     }],
//     xkey: 'period',
//     ykeys: ['Structure_Centrale', 'Directions_régionalle'],
//     labels: ['Structure Centrale', 'Directions Régionales'],
//     pointSize: 3,
//     fillOpacity: 0,
//     pointStrokeColors: ['#5f76e8', '#01caf1'],
//     behaveLikeLine: true,
//     gridLineColor: '#e0e0e0',
//     lineWidth: 3,
//     hideHover: 'auto',
//     lineColors: ['#5f76e8', '#01caf1'],
//     resize: true
// });


//     Morris.Area({
//         element: 'morris-area-chart2',
//         data: [{
//             period: '2010',
//             SiteA: 0,
//             SiteB: 0,
            
//         }, {
//             period: '2011',
//             SiteA: 130,
//             SiteB: 100,
            
//         }, {
//             period: '2012',
//             SiteA: 80,
//             SiteB: 60,
            
//         }, {
//             period: '2013',
//             SiteA: 70,
//             SiteB: 200,
            
//         }, {
//             period: '2014',
//             SiteA: 180,
//             SiteB: 150,
            
//         }, {
//             period: '2015',
//             SiteA: 105,
//             SiteB: 90,
            
//         },
//          {
//             period: '2016',
//             SiteA: 250,
//             SiteB: 150,
           
//         }],
//         xkey: 'period',
//         ykeys: ['SiteA', 'SiteB'],
//         labels: ['Site A', 'Site B'],
//         pointSize: 0,
//         fillOpacity: 0.6,
//         pointStrokeColors:['#5f76e8', '#01caf1'],
//         behaveLikeLine: true,
//         gridLineColor: '#e0e0e0',
//         lineWidth: 0,
//         smooth: false,
//         hideHover: 'auto',
//         lineColors: ['#5f76e8', '#01caf1'],
//         resize: true
        
//     });

    </script>
    
@endsection