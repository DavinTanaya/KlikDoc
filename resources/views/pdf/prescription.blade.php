<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Resep Digital</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      color: #111;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .box {
      border: 1px solid #000;
      padding: 10px;
      margin-bottom: 15px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 6px;
    }

    th {
      background: #f3f4f6;
    }

    .footer {
      margin-top: 40px;
      text-align: right;
    }
  </style>
</head>

<body>

  <div class="header">
    <h2>RESEP DIGITAL</h2>
    <p>KlikDoc</p>
  </div>

  <div class="box">
    <strong>Dokter:</strong> {{ $doctor->full_name }} <br>
    <strong>Pasien:</strong> {{ $patient->name }} <br>
    <strong>Tanggal:</strong> {{ $prescription->created_at->format('d M Y') }}
  </div>

  <table>
    <thead>
      <tr>
        <th>Obat</th>
        <th>Dosis</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{ $item->drug->name }}</td>
          <td>{{ $item->drug->dosis }}</td>
          <td>{{ $item->drug->short_description }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="footer">
    <p>{{ $doctor->full_name }}</p>
    <p><em>Tanda tangan digital</em></p>
  </div>

</body>

</html>
