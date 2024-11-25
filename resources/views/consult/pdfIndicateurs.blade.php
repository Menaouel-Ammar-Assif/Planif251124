<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE DES INFORMATIONS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 0.5px solid black;
        }
        th, td {
            padding: 8px;
        }
        th {
            background-color: rgba(131, 168, 255, 0.56);
        }
    </style>
</head>
<body>
    {{-- <p> <span style="font-weight: bold">Direction :</span>  {{ $direction->lib_dir }}</p> --}}
    @php
        $curDate = \Carbon\Carbon::now()->format('d-m-Y');
    @endphp
    <p> <span style="font-weight: bold">Date :</span> {{ $curDate }}</p>
    <p> <span style="font-weight: bold">Periode :</span> {{ $periodeText }}</p>

    
    <h3 class="text-center">LISTE DES INFORMATIONS (DENOMINATEUR/NUMERATEUR) A INTEGRER DANS LE SYSTEME COP</h3>
    <table class="table table-bordered border-primary" cellpadding="5" cellspacing="0">
        <thead>
            <tr class="table-primary text-center">
                <th style="width: 5%">N°</th>
                <th style="width: 37%">Structure Centrale</th>
                <th style="width: 34%">CHAMPS A RENSEIGNER</th>
                <th style="width: 22%">Valeur {{ $periodeText }} {{ $year }}</th>
            </tr>
        </thead>
        <tbody>

            @php
                $unitMapping = [
                    'DA' => 'DA',
                    'NB' => '',
                    'J' => 'Jours',
                    'HJ' => 'Heures / Jours',
                    'H' => 'Heures',
                ];
            @endphp

            @foreach ($numDenomVals as $val) 
                <tr>
                    <td style="font-size: 15px; font-weight: bold; align-content: center;">{{ $val->id_num_denom }}</td>
                    <td style="font-size: 13px; font-weight: bold">{{ $val->Direction->code }} - {{ $val->Direction->lib_dir }}</td>
                    <td style="font-size: 14px; font-weight: bold">{{ $val->NumDenom->lib_num_denom }}</td>
                    <td style="font-size: 15px; font-weight: bold; text-align: center;">{{ number_format($val->val, 0, '.', ' ') }} {{ $unitMapping[$val->unite] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>