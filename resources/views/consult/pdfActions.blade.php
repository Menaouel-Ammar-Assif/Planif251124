<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $etat }} - {{ $array ? $typeDir : $directionName->pluck('lib_dir')->first()}}</title>
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
            font-size: 14px;
        }
        th {
            background-color: rgba(49, 110, 253, 0.56);
            text-align: center;
        }
        .completed {
            background-color: #9fffa7b9;
        }
        .table-header {
            font-size: 16px;
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>{{ $etat }}</h2>
    <p><span class="table-header">Direction:</span> {{ $array ? $typeDir : $directionName->pluck('lib_dir')->first()}}</p>
    <p><span class="table-header">Date:</span> {{ $curDate }}</p>

    <table>
        <thead>
            <tr>
                <th>Code Action</th>
                <th>Action</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actions as $action)
                <tr class="{{ $action->etat == '100' ? 'completed' : '' }}">
                    <td style="width: 13%; text-align: left;">{{ $action->code_act }}</td>
                    <td style="width: 52%; text-align: left; font-weight: bold;">{{ $action->lib_act }}</td>
                    <td style="width: 13%; text-align: center;">{{ $action->dd }}</td>
                    <td style="width: 13%; text-align: center;">{{ $action->df }}</td>
                    <td style="width: 9%; text-align: center; font-weight: bold;">{{ $action->etat }} %</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
