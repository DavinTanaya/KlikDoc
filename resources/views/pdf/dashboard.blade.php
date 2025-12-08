<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 4px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
            color: #666;
        }

        .box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background: #f4f4f4;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body>

    <h1>KLIKDOC ADMIN DASHBOARD</h1>
    <div class="subtitle">
        Laporan Ringkas • {{ now()->translatedFormat('d F Y') }}
    </div>

    <div class="box">
        <strong>Ringkasan Global</strong>
        <table>
            <tr>
                <td>Total Revenue</td>
                <td class="right">Rp {{ number_format($global['revenue'], 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Transaksi</td>
                <td class="right">{{ number_format($global['transactions']) }}</td>
            </tr>
            <tr>
                <td>Total Pengguna</td>
                <td class="right">{{ number_format($global['users']) }}</td>
            </tr>
        </table>
    </div>

    <div class="box">
        <strong>Revenue per Layanan</strong>
        <table>
            <tr>
                <th>Layanan</th>
                <th class="right">Revenue</th>
            </tr>
            @foreach ($services as $name => $value)
                <tr>
                    <td>{{ $name }}</td>
                    <td class="right">Rp {{ number_format($value, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="box">
        <strong>Performa 6 Bulan Terakhir</strong>
        <table>
            <tr>
                <th>Bulan</th>
                <th class="right">Revenue</th>
            </tr>
            @foreach ($monthly as $row)
                <tr>
                    <td>{{ $row['label'] }}</td>
                    <td class="right">Rp {{ number_format($row['revenue'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
    </div>

</body>

</html>
