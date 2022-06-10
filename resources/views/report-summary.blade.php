<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html">
    <title></title>
    <style>
        html,
        body {
            font-family: sans-serif;
            margin: 2px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 2px 2px;
        }

        th {
            font-size: 0.9em;
        }

        tr {
            font-size: 00.85em;
            border-bottom: 1px solid grey;
        }

        .cellWidth {
            width: 10%;
        }
    </style>
</head>

<body class="font-sans">
    <table width="100%">
        <thead class="bg-gray-50">
            <tr>
                <th class="cellWidth">Date</th>
                <th class="cellWidth">USD P</th>
                <th class="cellWidth">USD S</th>
                <th class="cellWidth">GBP P</th>
                <th class="cellWidth">GBP S</th>
                <th class="cellWidth">EUR P</th>
                <th class="cellWidth">EUR S</th>
                <th class="cellWidth">AED P</th>
                <th class="cellWidth">AED S</th>
                <th class="cellWidth">NGN P</th>
                <th class="cellWidth">NGN S</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 bg-white">
            @foreach ($reports as $report)
                <tr style="font-size: 0.7em">
                    <td>
                        {{ $report->date }}
                    </td>
                    <td>
                        {{ $report->usd_purchased }}
                    </td>
                    <td>
                        {{ $report->usd_sold }}
                    </td>
                    <td>
                        {{ $report->gbp_purchased }}
                    </td>
                    <td>
                        {{ $report->gbp_sold }}
                    </td>
                    <td>
                        {{ $report->eur_purchased }}
                    </td>
                    <td>
                        {{ $report->eur_sold }}
                    </td>
                    <td>
                        {{ $report->aed_purchased }}
                    </td>
                    <td>
                        {{ $report->aed_sold }}
                    </td>
                    <td>
                        {{ $report->naira_purchase_value }}
                    </td>
                    <td>
                        {{ $report->naira_sold_value }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
