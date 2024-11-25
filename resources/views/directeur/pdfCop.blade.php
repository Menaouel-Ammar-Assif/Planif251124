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
                <th>N°</th>
                <th>CHAMPS A RENSEIGNER</th>
                <th>Valeur <span style="color: red;">{{ $periodeText }}</span> {{ $Year }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($NumDenom as $item)
                <tr>
                    <th scope="row" class="text-center">{{ $item->id_num_denom }}</th>
                    <td>{{ $item->lib_num_denom }}</td>
                    <td class="p-1">
                        <div class="input-group">
                            <input type="text" class="form-control py-2 px-1" id="chmp{{ $item->id_num_denom }}" name="chmp{{ $item->id_num_denom }}" aria-label="" style="outline: none; border: none; background-color: #cfe2ff4d;" placeholder="Écrire..." value="{{ $NumDenomVals->firstWhere('id_num_denom', $item->id_num_denom)->val ?? '' }}">
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
                                    <!-- Optional: handle any other units or defaults here -->
                            @endswitch
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

</body>
</html>