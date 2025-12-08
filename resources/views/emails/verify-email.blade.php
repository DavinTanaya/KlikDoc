<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email</title>
</head>

<body style="font-family: Inter, Arial, sans-serif; background-color: #f1f5f9; padding: 40px;">

    <table align="center" width="100%" style="max-width: 520px; background: white; border-radius: 16px; padding: 32px;">
        <tr>
            <td align="center">
                <img src="{{ asset('image/KlikDoc.png') }}" alt="KlikDoc" height="50">
            </td>
        </tr>

        <tr>
            <td style="padding-top: 24px;">
                <h2 style="margin: 0 0 12px; color: #1f2937;">
                    Verifikasi Email Anda
                </h2>

                <p style="color: #4b5563; line-height: 1.6;">
                    Terima kasih telah mendaftar di <b>KlikDoc</b>.
                    Silakan klik tombol di bawah ini untuk memverifikasi email Anda.
                </p>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding: 24px 0;">
                <a href="{{ $verifyUrl }}"
                    style="
                       display: inline-block;
                       padding: 12px 24px;
                       background-color: #3b82f6;
                       color: white;
                       text-decoration: none;
                       border-radius: 8px;
                       font-weight: 600;
                   ">
                    Verifikasi Email
                </a>
            </td>
        </tr>

        <tr>
            <td>
                <p style="color: #6b7280; font-size: 13px;">
                    Link ini akan kedaluwarsa dalam 30 menit.
                    Jika Anda tidak merasa mendaftar, silakan abaikan email ini.
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding-top: 24px; text-align: center; color: #9ca3af; font-size: 12px;">
                © {{ date('Y') }} KlikDoc. All rights reserved.
            </td>
        </tr>
    </table>

</body>

</html>
