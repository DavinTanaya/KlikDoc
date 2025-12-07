<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Surat Rujukan</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      line-height: 1.6;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .section {
      margin-bottom: 15px;
    }

    .title {
      font-size: 16px;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      padding: 6px 0;
      vertical-align: top;
    }

    .footer {
      margin-top: 40px;
      text-align: right;
    }
  </style>
</head>

<body>

  <div class="header">
    <div class="title">SURAT RUJUKAN PASIEN</div>
    <p>{{ $date }}</p>
  </div>

  <div class="section">
    <strong>DATA PASIEN</strong>
    <table>
      <tr>
        <td width="30%">Nama</td>
        <td>: {{ $patient->name }}</td>
      </tr>
      <tr>
        <td>Jenis Kelamin</td>
        <td>: {{ ucfirst($patient->gender ?? '-') }}</td>
      </tr>
    </table>
  </div>

  <div class="section">
    <strong>DATA RUJUKAN</strong>
    <table>
      <tr>
        <td width="30%">Rumah Sakit Tujuan</td>
        <td>: {{ $referral->destination }}</td>
      </tr>
      <tr>
        <td>Poli Spesialis</td>
        <td>: {{ $referral->department }}</td>
      </tr>
      <tr>
        <td>Alasan Rujukan</td>
        <td>: {{ $referral->reason }}</td>
      </tr>
      @if ($referral->notes)
        <tr>
          <td>Catatan Tambahan</td>
          <td>: {{ $referral->notes }}</td>
        </tr>
      @endif
    </table>
  </div>

  <div class="section">
    <strong>DOKTER PENGIRIM</strong>
    <table>
      <tr>
        <td width="30%">Nama</td>
        <td>: {{ $doctorProfile->full_name ?? $doctor->name }}</td>
      </tr>
      <tr>
        <td>Tanggal Konsultasi</td>
        <td>: {{ $consultation->created_at->format('d F Y') }}</td>
      </tr>
    </table>
  </div>

  <div class="footer">
    <p>
      Dokter Pemeriksa<br><br><br>
      <strong>{{ $doctorProfile->full_name ?? $doctor->name }}</strong>
    </p>
  </div>

</body>

</html>
