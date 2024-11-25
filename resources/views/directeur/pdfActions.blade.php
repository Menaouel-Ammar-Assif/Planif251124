<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $etat }} - {{ $direction->lib_dir }}</title>
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
    <h2>{{ $etat }}</h2>
    <p> <span style="font-weight: bold">Direction :</span>  {{ $direction->lib_dir }}</p>
    <p> <span style="font-weight: bold">Date :</span> {{ $curDate }}</p>

    <table>
        <thead>
            <tr style="text-align: center; font-size: 14px;">
                <th>Code Action</th>
                <th>Action</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actions as $action)
                @if ($action->etat =='100')
                    <tr style="background-color: #9fffa7b9;">
                        <td style="text-align: left; font-size: 14px;width: 13%">{{ $action->code_act }}</td>
                        <td style="text-align: left; font-size: 15px; ;font-weight: bold; width: 52%">{{ $action->lib_act }}</td>
                        <td style="text-align: center; font-size: 14px;width: 13%">{{ $action->dd }}</td>
                        <td style="text-align: center; font-size: 14px; width: 13%">{{ $action->df }}</td>
                        <td style="text-align: center; font-weight: bold; font-size: 14px; width: 9%">{{ $action->etat}} %</td>
                    </tr>
                @else
                    <tr>
                        <td style="text-align: left; font-size: 14px;width: 13%">{{ $action->code_act }}</td>
                        <td style="text-align: left; font-size: 15px; ;font-weight: bold; width: 52%">{{ $action->lib_act }}</td>
                        <td style="text-align: center; font-size: 14px;width: 13%">{{ $action->dd }}</td>
                        <td style="text-align: center; font-size: 14px; width: 13%">{{ $action->df }}</td>
                        <td style="text-align: center; font-weight: bold; font-size: 14px; width: 9%">{{ $action->etat}} %</td>
                    </tr>
                @endif
                {{-- @foreach ($action->Description as $d)
                    <tr style="background-color: blue; margin-left: 15px;">
                        <td style="text-align: left; font-size: 14px;width: 13%">{{ $d->mois }}</td>
                        <td style="text-align: left; font-size: 15px; ;font-weight: bold; width: 52%">{{ $d->faite }}</td>
                        <td style="text-align: center; font-size: 14px;width: 13%">{{ $d->a_faire }}</td>
                        <td style="text-align: center; font-size: 14px; width: 13%">{{ $d->probleme }}</td>
                        <td style="text-align: center; font-weight: bold; font-size: 14px; width: 9%">{{ $action->date}}</td>
                    </tr>
                @endforeach --}}

            @endforeach
        </tbody>
    </table>
</body>
</html>