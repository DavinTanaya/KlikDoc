@php
  use Carbon\Carbon;

  $time = Carbon::createFromTimeString($schedule->schedule_time)->format('H:i');
  $date = Carbon::parse($schedule->schedule_date)->translatedFormat('d M Y');
  $note = $reminder->note ?: '-';
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Pengingat Obat - {{ $reminder->medicine_name }}</title>
</head>

<body
  style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background:#f3f4f6; padding:24px;">

  <table width="100%" cellspacing="0" cellpadding="0"
    style="max-width:600px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;">
    <tr>
      <td style="background:#2563eb;color:#ffffff;padding:16px 24px;">
        <h1 style="margin:0;font-size:20px;">Pengingat Obat</h1>
        <p style="margin:4px 0 0 0;font-size:14px;opacity:0.9;">
          Saatnya minum obat sesuai jadwal, {{ $user->name ?? 'Pengguna' }}.
        </p>
      </td>
    </tr>

    <tr>
      <td style="padding:20px 24px 8px 24px;">
        <p style="font-size:14px;margin:0 0 12px 0;">
          Halo <strong>{{ $user->name ?? 'Pengguna' }}</strong>,
        </p>
        <p style="font-size:14px;margin:0 0 16px 0;line-height:1.5;">
          Ini adalah pengingat otomatis dari <strong>KlikDoc</strong> untuk jadwal minum obat Anda.
        </p>

        <table width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;border-collapse:collapse;">
          <tr>
            <td style="padding:6px 0;color:#6b7280;width:130px;">Nama Obat</td>
            <td style="padding:6px 0;font-weight:600;color:#111827;">
              {{ $reminder->medicine_name }}
            </td>
          </tr>
          <tr>
            <td style="padding:6px 0;color:#6b7280;">Jadwal</td>
            <td style="padding:6px 0;">
              <strong>{{ $date }}</strong> pukul
              <strong>{{ $time }} WIB</strong>
            </td>
          </tr>
          <tr>
            <td style="padding:6px 0;color:#6b7280;">Frekuensi</td>
            <td style="padding:6px 0;">
              {{ $reminder->frequency }}x sehari
            </td>
          </tr>
          <tr>
            <td style="padding:6px 0;color:#6b7280;">Catatan</td>
            <td style="padding:6px 0;">
              {{ $note }}
            </td>
          </tr>
        </table>

        <div
          style="margin-top:18px;padding:12px 14px;border-radius:8px;background:#fef3c7;color:#92400e;font-size:13px;">
          <strong>Tips:</strong> Pastikan Anda minum obat sesuai anjuran dokter.
          Jika mengalami efek samping, segera konsultasikan ke tenaga medis.
        </div>
      </td>
    </tr>

    <tr>
      <td style="padding:16px 24px 24px 24px;">
        <table cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" style="border-radius:999px;" bgcolor="#2563eb">
              <a href="{{ url('/mandiri/obat') }}"
                style="display:inline-block;padding:10px 20px;border-radius:999px;background:#2563eb;color:#ffffff;text-decoration:none;font-size:14px;font-weight:600;">
                Lihat Jadwal Obat Saya
              </a>
            </td>
          </tr>
        </table>

        <p style="font-size:11px;color:#9ca3af;margin-top:18px;line-height:1.4;">
          Email ini dikirim otomatis oleh sistem pengingat obat KlikDoc.
          Jika Anda merasa tidak pernah mengatur pengingat ini, Anda dapat mengabaikan email ini.
        </p>
      </td>
    </tr>
  </table>

</body>

</html>
