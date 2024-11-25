<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $direction->lib_dir }}</title>
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
            background-color: rgba(49, 110, 253, 0.56);
        }
    </style>
</head>
<body>
    <p> <span style="font-weight: bold">Direction :</span>  {{ $direction->lib_dir }}</p>
    @php
        $curDate = \Carbon\Carbon::now()->format('d-m-Y');
    @endphp
    <p> <span style="font-weight: bold">Date :</span> {{ $curDate }}</p>
    <p> <span style="font-weight: bold">Periode :</span> {{ $periodeText }}</p>

    
    <h3 class="text-center">LISTE DES INFORMATIONS (DENOMINATEUR/NUMERATEUR) A INTEGRER DANS LE SYSTEME COP</h3>
    <table class="table table-bordered border-primary" cellpadding="5" cellspacing="0">
        <thead>
            <tr class="table-primary text-center">
                <th>Structure Centrale</th>
                <th>CHAMPS A RENSEIGNER</th>
                <th>Valeur <span style="color: red;">{{ $periodeText }}</span> {{ $year }}</th>
                <th>Unité</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($numDenomVals as $val) 
                <tr>
                    <td>{{ $val->Direction->code }} - {{ $val->Direction->lib_dir }}</td>
                
                    <td>{{ $val->NumDenom->lib_num_denom }}</td>
                    
                    <td>{{ $val->val }}</td>
                    
                    <td>{{ $val->unite }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    

</body>
</html>