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
        </div>
    </div>
    @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
        <div class="row">
            <div class="col-12">

                <div class="card border-end ">
                    <div class="card-body">
                    <div class="card-header mb-1  text-dark">
                        <h3 class="font-weight-medium">Proposer des actions aux Directions Régionales</h3>
                    </div>

                    <form action="{{ Route('directeur-proposition.add_act_pro') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                            <label for="act_pro" class="form-label p-2">Proposez une action</label>
                            <textarea class="form-control" id="act_pro" name="act_pro"></textarea>
                        </div>

                        <div class="row ms-1 me-1 mb-4" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">

                            <div class="col-5">
                                <div class="mb-4 col-6 mt-3" >
                                    <label for="dd" class="form-label font-weight-medium">Choisissez la date de début</label>
                                    <input type="date" class="form-control" style="box-shadow: rgba(255, 255, 255, 0.17) 0px -23px 25px 0px inset, rgba(255, 255, 255, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;" id="dd" name="dd">
                                </div>

                                <div class="mb-4 col-6">
                                    <label for="df" class="form-label font-weight-medium">Choisissez la date de fin</label>
                                    <input type="date" class="form-control" id="df" name="df" style="box-shadow: rgba(255, 255, 255, 0.17) 0px -23px 25px 0px inset, rgba(255, 255, 255, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;">
                                </div>
                            </div>
                            
                            <div class="col-7 p-3" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                                <h3 class="text-dark font-weight-medium">Directions Régionales</h3>
                                @foreach ($directionsDr as $dr)
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" role="switch" name="selected_dr[]" value="{{ $dr->id_dir }}">
                                        <label class="form-check-label">{{ $dr->lib_dir }}</label>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <div class="row ms-1 me-1 justify-content-between">
                            <div class=" float-end">
                                <button type="submit" class="btn btn-lg rounded-pill btn-success ps-3 pe-3 font-weight-medium align-text-bottom" style="float: inline-end;">Valider</button>
                            </div>
                        </div>

                        
                    </form>





                    </div>
                </div>

            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_act_pro" class="table border">

                        @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)

                            <thead>
                                <tr class="table-primary">
                                    <th>Action Proposée</th>
                                    <th>Date Début</th>
                                    <th>Date Fin</th>
                                    <th>Directions Régionales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $uniqueRows = [];
                                @endphp
                                @foreach ($actions as $action)
                                        @php
                                            $row = $action->lib_act_pro . '_' . $action->dd . '_' . $action->df . '_' . $dr->lib_dir;
                                        @endphp
                                        @if (!in_array($row, $uniqueRows))
                                            <tr>
                                                <td>{{ $action->lib_act_pro }}</td>
                                                <td>{{ date('d/m/Y', strtotime($action->dd)) }}</td>
                                                <td>{{ date('d/m/Y', strtotime($action->df)) }}</td>
                                                <td>
                                                    @foreach($directionsDr as $dr) 
                                                        @foreach($action->actionsProDrs as $p)
                                                            @if($dr->id_dir == $p->id_dir)
                                                                {{$dr->lib_dir}}
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @php
                                                $uniqueRows[] = $row;
                                            @endphp
                                        @endif
                                @endforeach

                        @else
                        <thead>
                            <tr class="table-primary">
                                <th>Action Proposée</th>
                                <th>Date Début</th>
                                <th>Date Fin</th>
                                <th>Structure Centrale</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                    $uniqueRows = [];
                                @endphp
                                @foreach ($actions as $action)
                                    @php
                                        $row = $action->lib_act_pro . '_' . $action->dd . '_' . $action->df;
                                    @endphp
                                    <tr>
                                        <td>{{ $action->lib_act_pro }}</td>
                                        <td>{{ date('d/m/Y', strtotime($action->dd)) }}</td>
                                        <td>{{ date('d/m/Y', strtotime($action->df)) }}</td>
                                        <td>
                                            @foreach ($action->actionsProDrs as $a)
                                                @if (!in_array($row, $uniqueRows))
                                                    {{$a->lib_created_by}}
                                                    @php
                                                        $uniqueRows[] = $row;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
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

    {{------------------------------------------DataTables-----------------------------------------------------}}
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>

    {{-- <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="{{asset('dist/js/bootstrap.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.details-content').each(function() {
                $(this).find('table').DataTable();
            });
        });

        $(document).ready(function() {
            $('#zero_act_pro').DataTable();
        });

        // sub_table
        $(document).ready(function() {
            // Add click event listener to each row with class 'expandable'
            $('.expandable').click(function() {
                // Toggle visibility of the sub-table
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

        // Iterate over each range input and set up event listeners
        rangeInputs.forEach(function(rangeInput, index) {
            var rangeValueSpan = rangeValueSpans[index];

            rangeInput.addEventListener('input', function() {
                rangeValueSpan.textContent = rangeInput.value;
            });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#obj').change(function () {
                var objId = $(this).val();

                    $.ajax({
                        type: "GET",
                        url: '{{ url("/directeur/proposition/getSousObjs") }}/' + objId,
                        success: function (response) {


                            var response = JSON.parse(response);

                            $('#sousObjList').empty();
                            $('#sousObjList').append(`<option value="0" disabled selected>Selectionner un sous objectif *</option>`);

                            response.forEach(element => { $('#sousObjList').append(`<option value="${element['id_sous_obj']}">${element['lib_sous_obj']}</option>`); });

                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                    });
            });
        });
    </script>
@endsection