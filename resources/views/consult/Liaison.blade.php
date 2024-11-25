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
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Déclinaison de concepts</h4>

                    <table class="table table-bordered border-secondary">
                        <thead style="background-color: rgba(44, 44, 44, 0.74); color: #fff" class="text-center">
                            <tr>
                                <th>Direction centrale</th>
                                <th>Sous-direction régionale / service</th>
                                <th>Bureaux</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($directions as $direction)
                                @foreach($direction->DirSousDirBureaux as $dirSousDirBureau)
                                    <tr>
                                        @if($loop->first)
                                            <td rowspan="{{ count($direction->DirSousDirBureaux) }}">{{ $direction->code }} - {{ $direction->lib_dir }}</td>
                                        @endif
                                        <td>{{ $dirSousDirBureau->SousDirection->lib_sous_dir }}</td>
                                        <td class="
                                            @if($dirSousDirBureau->Bureau && $dirSousDirBureau->Bureau->lib_bureau)
                                                @if($direction->code === 'D01' && (
                                                    (trim($dirSousDirBureau->Bureau->lib_bureau) === 'Réglementation et fiscalité' ||
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Régime douaniers') ||
                                                    strpos($dirSousDirBureau->Bureau->lib_bureau, 'Réglementation') !== false
                                                ))
                                                    green-bureau
                                                @elseif($direction->code === 'D02' && (
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Contentieux et transactions' ||
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Poursuites judiciaires' ||
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Suivi de l’exécution des décisions de justice et des transactions'
                                                ))
                                                    blue-bureau
                                                @elseif($direction->code === 'D02' && trim($dirSousDirBureau->Bureau->lib_bureau) === 'Eléments de taxation et suivi des recettes')
                                                    green-bureau

                                                @elseif($direction->code === 'D04' && (
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Réglementation et fiscalité' ||
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Eléments de taxation et suivi des recettes'
                                                ))
                                                    green-bureau

                                                @elseif($direction->code === 'D05' && (
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Gestion des personnels' ||
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Formation'
                                                ))
                                                    v-bureau

                                                @elseif($direction->code === 'D06' && trim($dirSousDirBureau->Bureau->lib_bureau) === 'Budget et comptabilité')
                                                    v-bureau

                                                @elseif($direction->code === 'D06' && (
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Gestion des infrastructures' ||
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Equipements'
                                                ))
                                                    g-bureau

                                                @elseif($direction->code === 'D08' && (
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Prévention et sécurité' ||
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Programmation et coordination des brigades' ||
                                                    trim($dirSousDirBureau->Bureau->lib_bureau) === 'Suivi et exécution de l’activité opérationnelle'
                                                ))
                                                    o-bureau

                                                @elseif($direction->code === 'D09' && trim($dirSousDirBureau->Bureau->lib_bureau) === 'Performance et statistiques')
                                                    purple-bureau

                                                @elseif($direction->code === 'D10' && trim($dirSousDirBureau->Bureau->lib_bureau) === 'Communication')
                                                    purple-bureau

                                                @elseif($direction->code === 'CNFD' && trim($dirSousDirBureau->Bureau->lib_bureau) === 'Formation')
                                                    v-bureau

                                                @elseif($direction->code === 'CNTSID' && trim($dirSousDirBureau->Bureau->lib_bureau) === 'Informatique')
                                                    purple-bureau

                                                @else
                                                    text-muted
                                                @endif
                                            @endif
                                        ">
                                            @if($dirSousDirBureau->Bureau)
                                                {{ $dirSousDirBureau->Bureau->lib_bureau ?? '' }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>



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

    </script>
    <script>
        $(document).ready(function() {
            $('#zero_liaison').DataTable();
        });
    </script>
@endsection
    

