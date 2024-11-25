@extends('layouts.directeur.app')
<style>
    /* Style for valid and invalid inputs */
    .invalid {
        border: 1px solid red;
        background-color: #ffe6e6; /* Light red background for warning */
    }
</style>
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
        @if (session()->has('success'))
            <div class="container-fluid">
                <div class="alert alert-success">
                    <h4>{{session()->get('success')}}</h4>
                </div>
            </div>
        @endif


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
            <div class="ribbonC">C O P</div>
            <div class="card">
                <div class="card-body">

                @php
                    $found = false;
                @endphp

                @foreach ($NumDenom as $item)
                    
                    @if (auth()->user()->id_dir == $item->id_dc)
                        <div class="row">
                            <h4 class="card-title mb-3" style="padding-top: 80px;">LISTE DES INFORMATIONS (DENOMINATEUR/NUMERATEUR) A INTEGRER DANS LE SYSTEME COP</h4>

                            <form action="{{ route('directeur.CopAddStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-3 mt-4 mb-2" style="float: inline-end; padding: 8px;">
                                    <div class="input-group">
                                        
                                        <select class="form-select form-control formselect required custom-radius text-center" name="month" style="background-color: #49a4ff; color: #ffffff; text-transform: uppercase;" id="month">
                                            @for ($i = 3; $i < $currentMonthNumber; $i = $i+3)
                                                @php
                                                    $paddedValue = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                @endphp
                                                <option value="{{ $paddedValue }}" {{ $i == $currentMonthNumber ? 'selected' : '' }}>
                                                    {{ $months[$i] }}
                                                </option>
                                            @endfor
                                        </select>
                                        <label class="input-group-text font-weight-bold" for="month"><i class="fa-regular fa-calendar-days fa-xl"></i> </label>
                                    </div>
                                </div>





                                <table class="table table-bordered border-primary">
                                    <thead>
                                        <tr class="table-primary text-center">
                                            <th scope="col">N°</th>
                                            <th scope="col">CHAMPS A RENSEIGNER</th>
                                            <th scope="col" id="addMonth"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($NumDenom as $item)
                                            @if ($item->id_dc == auth()->user()->id_dir )
                                                @php
                                                    $val = '';
                                                @endphp

                                                @foreach($NumDenomVals as $ND)
                                                    @if($item->id_num_denom == $ND->id_num_denom)
                                                        <?php 
                                                            $val = trim($ND->val);                                                                            
                                                        ?>
                                                    @endif
                                                @endforeach

                                                <tr>
                                                    <th scope="row" class="text-center">{{$item->id_num_denom}}</th>
                                                    <td>{{$item->lib_num_denom}}</td>
                                                    <td class="p-1">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control py-2 px-1" id="chmp{{$item->id_num_denom}}" name="chmp{{$item->id_num_denom}}" aria-label="" style="outline: none; border: none; background-color: #cfe2ff4d;" placeholder="Écrire..." onkeypress="restrictCharacters(event)" onpaste="handlePaste(event)">



                                                            {{-- <div class="input-group has-validation">
                                                                <span class="input-group-text">@</span>
                                                                <div class="form-floating is-invalid">
                                                                <input type="text" class="form-control is-invalid" id="floatingInputGroup2" placeholder="Username" required>
                                                                <label for="floatingInputGroup2">Username</label>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Please choose a username.
                                                            </div>
                                                            </div> --}}



                                                            @switch($item->unite)
                                                                @case('DA')
                                                                    <span class="input-group-text">DA</span>
                                                                    @break

                                                                @case('NB')
                                                                    @break

                                                                @case('HJ')
                                                                    <span class="input-group-text">heures/ jours</span>
                                                                    @break

                                                                @case('H')
                                                                    <span class="input-group-text">heures/ heures disponibles</span>
                                                                    @break

                                                                @case('J')
                                                                    <span class="input-group-text">jours</span>
                                                                    @break

                                                                @default
                                                                
                                                            @endswitch
                                                                
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    
                                </table>

                                <button type="button" class="btn btn-success float-end font-weight-medium" id="addND_val" data-bs-toggle="modal" data-bs-target="#info-alert-modal">Ajouter</button>

                                <button type="button" class="btn btn-success" id="downloadPDF">Télécharger Pdf <i class="fa-solid fa-file-pdf fa-lg ms-2"></i></button>

                                <!-- Info Alert Modal -->
                                <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-body p-4">
                                                <div class="text-center">
                                                    <i class="dripicons-information h1 text-info"></i>
                                                    <h4 class="mt-2" id="addMonthModel" ></h4>
                                                    

                                                    <button type="submit" class="btn btn-success my-2" data-bs-dismiss="modal">
                                                        Ajouter
                                                    </button>
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                            </form>

                            <div class="col-6">
                            </div>
                            <div class="col-6 text-center mt-2">
                                
                                <div class="alert alert-danger d-flex align-items-center text-center" role="alert">
                                    {{-- <i class="fa-solid fa-circle-info me-2 fa-beat"></i> --}}
                                    <div id="formuleChiffre" class="font-weight-medium">
                                        </div><div class="ribbon2 text-center">Important</div>
                                        <span class="ms-3">Si vous cliquez sur <span class="font-weight-medium text-dark">Ajouter</span>, vous ne pourrez plus modifier</span>
                                        {{-- <span class="ms-3">L'informatios Ajouter ne pe pas étre modifier</span> --}}

                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        @php
                            $found = true;
                        @endphp

                    @endif

                    @if ($found)
                        @break
                    @endif
                
                @endforeach

                    <div class="col-12" style="padding-top: 85px;">
                        @if (auth()->user()->id_dir && auth()->user()->id_dir != 9)

                            <ul class="nav nav-pills bg-nav-pills nav-justified mb-2 border border-1 border-primary">
                                <li class="nav-item border border-1 border-primary">
                                    <a href="#t" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0 {{ $myPeriod == '03' ? 'show active ' : ' ' }} {{ $month < 4 ? 'disabled' : '' }}">
                                        <i class="mdi mdi-home-variant d-lg-none d-block me-1"></i>
                                        <span class="d-none font-weight-medium d-lg-block">Trimestre</span>
                                    </a>
                                </li>
                                <li class="nav-item border border-1 border-primary">
                                    <a href="#s" data-bs-toggle="tab" aria-expanded="true"
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

                                                    <th colspan="2" class="border font-18 border-5 border-bottom-0 border-warning font-16 font-weight-medium text-center bg-warning text-dark">
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
                                                    <th class="border-0 font-16 font-weight-medium border-5 border-warning border-end text-center text-dark " style="background-color: #48CFCB;">
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
                                                                            @foreach ($Objectif as $obj)
                                                                                @if ($copV->id_obj == $obj->id_obj)
                                                                                    {{$obj->lib_obj}}
                                                                                @endif
                                                                            @endforeach
                                                                            
                                                                        </h5>
                                                                        <span class="font-14" style="color: #595959;">
                                                                            @foreach ($SousObjectif as $sObj)
                                                                                @if ($copV->id_sous_obj == $sObj->id_sous_obj)
                                                                                    {{$sObj->lib_sous_obj}}
                                                                                @endif
                                                                            @endforeach
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="border-top-0 font-weight-medium text-center px-2 py-4 font-16" style="background-color: #3871ff87;">
                                                                @foreach ($Indicateur as $ind)
                                                                    @if ($copV->id_ind == $ind->id_ind)
                                                                        {{$ind->lib_ind}}
                                                                    @endif
                                                                @endforeach
                                                            
                                                            </td>

                                                            <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ffcb0061">
                                                                <div class="">
                                                                    <span class=" font-16">
                                                                        @foreach ($Indicateur as $ind)
                                                                            @if ($copV->id_ind == $ind->id_ind)
                                                                                {{$ind->formule}}
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                        {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                                </div>
                                                                
                                                            </td>

                                                            <td class="border-top-0 px-2 py-4 text-center" style="background-color: #f8eded82">
                                                                <div class="">
                                                                    <span class=" font-16">{{$copV->result}} 
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                        {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                                </div>
                                                                
                                                            </td>
                                                            
                                                            <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center text-dark" style="background-color: #48CFCB;">
                                                                <div class="">
                                                                    <h5 class="font-16 font-weight-medium">
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->cible}} {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
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
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->cibleTrimestre}} {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
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

                                                    <th colspan="2" class="border font-18 border-5 border-bottom-0 border-warning font-16 font-weight-medium text-center bg-warning text-dark">
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
                                                    <th class="border-0 font-16 font-weight-medium border-5 border-warning border-end text-center text-dark" style="background-color: #48CFCB;">
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
                                                                            @foreach ($Objectif as $obj)
                                                                                @if ($copV->id_obj == $obj->id_obj)
                                                                                    {{$obj->lib_obj}}
                                                                                @endif
                                                                            @endforeach
                                                                            
                                                                        </h5>
                                                                        <span class="font-14" style="color: #595959;">
                                                                            @foreach ($SousObjectif as $sObj)
                                                                                @if ($copV->id_sous_obj == $sObj->id_sous_obj)
                                                                                    {{$sObj->lib_sous_obj}}
                                                                                @endif
                                                                            @endforeach
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="border-top-0 font-weight-medium text-center px-2 py-4 font-16" style="background-color: #3871ff87;">
                                                                @foreach ($Indicateur as $ind)
                                                                    @if ($copV->id_ind == $ind->id_ind)
                                                                        {{$ind->lib_ind}}
                                                                    @endif
                                                                @endforeach
                                                            
                                                            </td>

                                                            <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ffcb0061">
                                                                <div class="">
                                                                    <span class=" font-16">
                                                                        @foreach ($Indicateur as $ind)
                                                                            @if ($copV->id_ind == $ind->id_ind)
                                                                                {{$ind->formule}}
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                        {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                                </div>
                                                                
                                                            </td>

                                                            <td class="border-top-0 px-2 py-4 text-center" style="background-color: #f8eded82">
                                                                <div class="">
                                                                    <span class=" font-16">{{$copV->result}} 
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                        {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                                </div>
                                                                
                                                            </td>
                                                            
                                                            <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center text-dark" style="background-color: #48CFCB;">
                                                                <div class="">
                                                                    <h5 class="font-16 font-weight-medium">
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->cible}} {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
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
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->cibleSemestre}} {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
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

                                                    <th colspan="2" class="border font-18 border-5 border-bottom-0 border-warning font-16 font-weight-medium text-center bg-warning text-dark">
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
                                                        <h2 class="m-0"><i class="fa-solid fa-crosshairs fa-fade text-info"></i></h2> Cible Neuf mois
                                                    </th>
                                                    <th class="border-0 font-16 font-weight-medium border-5 border-warning border-end text-center text-dark" style="background-color: #48CFCB;">
                                                        Ecart Neuf mois
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                @foreach ($CopValeurN as $copV)
                                                    
                                                

                                                        <tr class="text-center">
                                                            <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ff975d6b;">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="text-center">
                                                                        <h5 class="text-gray-800 mb-0 font-16 font-weight-medium">
                                                                            @foreach ($Objectif as $obj)
                                                                                @if ($copV->id_obj == $obj->id_obj)
                                                                                    {{$obj->lib_obj}}
                                                                                @endif
                                                                            @endforeach
                                                                            
                                                                        </h5>
                                                                        <span class="font-14" style="color: #595959;">
                                                                            @foreach ($SousObjectif as $sObj)
                                                                                @if ($copV->id_sous_obj == $sObj->id_sous_obj)
                                                                                    {{$sObj->lib_sous_obj}}
                                                                                @endif
                                                                            @endforeach
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="border-top-0 font-weight-medium text-center px-2 py-4 font-16" style="background-color: #3871ff87;">
                                                                @foreach ($Indicateur as $ind)
                                                                    @if ($copV->id_ind == $ind->id_ind)
                                                                        {{$ind->lib_ind}}
                                                                    @endif
                                                                @endforeach
                                                            
                                                            </td>

                                                            <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ffcb0061">
                                                                <div class="">
                                                                    <span class=" font-16">
                                                                        @foreach ($Indicateur as $ind)
                                                                            @if ($copV->id_ind == $ind->id_ind)
                                                                                {{$ind->formule}}
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                        {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                                </div>
                                                                
                                                            </td>

                                                            <td class="border-top-0 px-2 py-4 text-center" style="background-color: #f8eded82">
                                                                <div class="">
                                                                    <span class=" font-16">{{$copV->result}} 
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                        {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                                </div>
                                                                
                                                            </td>
                                                            
                                                            <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center text-dark" style="background-color: #48CFCB;">
                                                                <div class="">
                                                                    <h5 class="font-16 font-weight-medium">
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->cible}} {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
                                                                    </h5>
                                                                </div>
                                                            </td>
                                                            <td class="font-weight-medium  border-top-0 px-2 py-4 text-center {{$copV->ecartType == 'négatif'? 'text-danger' : 'text-white bg_succ'}}">
                                                                <div class="">
                                                                    <h5 class="font-18 font-weight-medium">{{$copV->ecart}} %</h5>
                                                                </div>
                                                            </td>

                                                            <td class="border-0 text-center px-2 py-4 border-4 border-warning border-start text-center text-dark" style="background-color: #48CFCB;">
                                                                <div class="">
                                                                    <h5 class="font-16 font-weight-medium">
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->cibleT_Trimestre}} {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
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
                                                                            @foreach ($Objectif as $obj)
                                                                                @if ($copV->id_obj == $obj->id_obj)
                                                                                    {{$obj->lib_obj}}
                                                                                @endif
                                                                            @endforeach
                                                                            
                                                                        </h5>
                                                                        <span class="font-14" style="color: #595959;">
                                                                            @foreach ($SousObjectif as $sObj)
                                                                                @if ($copV->id_sous_obj == $sObj->id_sous_obj)
                                                                                    {{$sObj->lib_sous_obj}}
                                                                                @endif
                                                                            @endforeach
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="border-top-0 font-weight-medium text-center px-2 py-4 font-16" style="background-color: #3871ff87;">
                                                                @foreach ($Indicateur as $ind)
                                                                    @if ($copV->id_ind == $ind->id_ind)
                                                                        {{$ind->lib_ind}}
                                                                    @endif
                                                                @endforeach
                                                            
                                                            </td>

                                                            <td class="border-top-0 px-2 py-4 text-center" style="background-color: #ffcb0061;">
                                                                <div class="">
                                                                    <span class=" font-16">
                                                                        @foreach ($Indicateur as $ind)
                                                                            @if ($copV->id_ind == $ind->id_ind)
                                                                                {{$ind->formule}}
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                        {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                                </div>
                                                                
                                                            </td>

                                                            <td class="border-top-0 px-2 py-4 text-center" style="background-color: #f8eded82">
                                                                <div class="">
                                                                    <span class=" font-16">{{$copV->result}} 
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
                                                                        
                                                                        {{-- {{ $copV->id_ind == 8 ? 'DA' : '%' }}</span> --}}
                                                                </div>
                                                                
                                                            </td>
                                                            
                                                            <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center text-dark" style="background-color: #48CFCB;">
                                                                <div class="">
                                                                    <h5 class="font-16 font-weight-medium">
                                                                        @foreach ($CopCible as $cC)
                                                                            @if ($copV->id_ind == $cC->id_ind)
                                                                                {{$cC->cible}} {{$cC->unite}}
                                                                            @endif
                                                                        @endforeach
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

                                </div>
                            </div>

                        @endif

                    </div>



                </div>
                
            
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
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

    {{-- <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="{{asset('dist/js/bootstrap.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            // Trigger AJAX request on page load
            fetchData();
            
            // Bind AJAX request to the change event of the select dropdown
            $('#month').on('change', function () {
                fetchData();
            });
        });
        
        function fetchData() {
            let month = $('#month').val();
            $('input[id^="chmp"]').val('');
            
            $.ajax({
                type: 'GET',
                url: '{{ url("addMonth") }}/' + month,
                success: function (response) {
                    $('#addMonth').html('VALEUR ' + '<span class="text-danger" style="text-transform: uppercase">' + response.month + '</span>' + ' ' + response.year);
                    $('#addMonthModel').html('Ajouter pour ' + '<span class="text-danger" style="text-transform: uppercase">' + response.month + '</span>' + ' ' + response.year);
                    
                    $.each(response.NumDenomVals, function(index, item) {
                        let value = item.val ? item.val : '';
                        $('#chmp' + item.id_num_denom).val(value);
                    });
                    // $('#addND_val').addClass('disabled');
                    $.each(response.NumDenomVals, function(index, item) {
                        let value = item.val ? item.val : '';

                        if (value === '') {
                            $('#addND_val').removeClass('disabled');
                            return false;
                        } else{
                            $('#addND_val').addClass('disabled');
                        }
                    });
                    if (response.NumDenomVals.length == 0 ) {
                        $('#addND_val').removeClass('disabled');
                    }
                },
                error: function (error) {
                    console.error('An error occurred:', error);
                }
            });
        }

        function restrictCharacters(event) {
            const allowedCharacters = /[0-9.]/;
            const key = String.fromCharCode(event.which);

            if (key === '.' && event.target.value.includes('.')) {
                event.preventDefault();
            } else if (!allowedCharacters.test(key)) {
                // Prevent any character that is not a digit or a period
                event.preventDefault();
            }
        }

        function handlePaste(event) {
            // Get the pasted data
            let pasteData = (event.clipboardData || window.clipboardData).getData('text');
            pasteData = pasteData.replace(/\s/g, '');
            pasteData = pasteData.replace(/,/g, '.');
            pasteData = pasteData.replace(/[^0-9.]/g, '');

            const firstPeriodIndex = pasteData.indexOf('.');
            if (firstPeriodIndex !== -1) {
                // Keep only the first period and remove additional ones
                pasteData = pasteData.slice(0, firstPeriodIndex + 1) + pasteData.slice(firstPeriodIndex + 1).replace(/\./g, '');
            }
            
            event.target.value = pasteData;

            // Prevent the default paste action
            event.preventDefault();
            
            // Validate the input after pasting
            validateInput(event.target);
        }

        document.getElementById('downloadPDF').addEventListener('click', function () {
            const selectedValue = document.getElementById('month').value;
            const url = `{{ route('directeur.downloadPDFCop') }}?selectedValue=${selectedValue}`;
            window.location.href = url; // Redirect with query parameter
        });
    </script>
@endsection