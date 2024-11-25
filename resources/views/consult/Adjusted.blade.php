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
    <div class="">
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
                                    <tr class="table-primary">
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
                                            <td>{{ date('d/m/Y', strtotime($act['dd'])) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($act['df'])) }}</td>
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
@endsection



@section('page-js')
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('dist/js/feather.min.js')}}"></script>
    <script src="{{asset('assets/all.min.js')}}"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>

    <script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <!-- This Page JS -->
    <!--Morris JavaScript -->
    {{-------------------------------------------------------------------------------------}}

    {{------------------------------------------DataTables-----------------------------------------------------}}
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="{{asset('dist/js/bootstrap.min.js')}}"></script>
    <script>
        $(function () {
            $('[data-plugin="knob"]').knob();
        });

        $(document).ready(function(){
            $('#zero_act_pro').DataTable();
        });

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
                    url: '{{ url("consult/directionDrAjust") }}/'+ directionId,
                    
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

    </script>
@endsection
    

