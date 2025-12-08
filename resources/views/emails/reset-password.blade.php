<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
</head>

<body style="font-family: Inter, Arial, sans-serif; background-color: #f1f5f9; padding: 40px;">

  <table align="center" width="100%"
    style="max-width: 520px; background: white; border-radius: 16px; padding: 32px;
              box-shadow: 0 20px 25px -5px rgba(0,0,0,.08),
                          0 10px 10px -5px rgba(0,0,0,.04);">

    <!-- LOGO -->
    <tr>
      <td align="center">
        <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc" height="50">
      </td>
    </tr>

    <!-- HEADER -->
    <tr>
      <td style="padding-top: 24px;">
        <h2 style="margin: 0 0 12px; color: #1f2937;">
          Reset Password Anda
        </h2>

        <p style="color: #4b5563; line-height: 1.6;">
          Kami menerima permintaan untuk mereset password akun <b>KlikDoc</b> Anda.
          Klik tombol di bawah ini untuk membuat password baru.
        </p>
      </td>
    </tr>

    <!-- BUTTON -->
    <tr>
      <td align="center" style="padding: 24px 0;">
        <a href="{{ $resetUrl }}"
          style="
                 display: inline-block;
                 padding: 12px 24px;
                 background-color: #ef4444;
                 color: #ffffff;
                 text-decoration: none;
                 border-radius: 8px;
                 font-weight: 600;
               ">
          Reset Password
        </a>
      </td>
    </tr>

    <!-- INFO -->
    <tr>
      <td>
        <p style="color: #6b7280; font-size: 13px; line-height: 1.5;">
          Link reset password ini akan kedaluwarsa dalam <b>15 menit</b>.
          Jika Anda tidak pernah meminta reset password, silakan abaikan email ini.
        </p>
      </td>
    </tr>

    <!-- FOOTER -->
    <tr>
      <td style="padding-top: 24px; text-align: center; color: #9ca3af; font-size: 12px;">
        © {{ date('Y') }} KlikDoc. All rights reserved.
      </td>
    </tr>

  </table>

</body>

</html>
