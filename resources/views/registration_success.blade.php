<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>Konfirmasi Email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            height: 100% !important;
            background-color: #F0F0F0;
            font-family: Arial, sans-serif;
            color: #000;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .container {
            max-width: 560px;
            background: #FFFFFF;
            margin: 30px auto;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

       
        .divider {
            border-top: 1px solid #E0E0E0;
            margin: 20px 0;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
            text-align: left;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #f05537;
            color: #0e0e0e;
            text-decoration: none;
            border-radius: 4px;
            font-size: 17px;
        }

        .footer {
            /* font-size: 14px; */
            /* color: #666; */
            margin-top: 20px;
        }
        a:link {
        color: rgb(0, 0, 0);
        background-color: transparent;
        text-decoration: none;
        }
        a:visited {
        color: rgb(0, 0, 0);
        background-color: transparent;
        text-decoration: none;
        }
        a:hover {
        color: #f05537;
        background-color: transparent;
        text-decoration: underline;
        }
        a:active {
        color: #f05537;
        background-color: transparent;
        text-decoration: underline;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td align="center">
                <table class="container">
                    <tr>
                        <td class="logo">
                            <img src="https://admin.trainingkerja.com/public/storage/6727b1318a81e.webp" alt="Kerja Teknik">
                        </td>
                    </tr>
                    <tr>
                        <td class="divider"></td>
                    </tr>
                    <tr>
                        <td class="content">
                            <p>Hai {{ $user->name }},</p>
                            <p>Untuk memulai menggunakan akun baru Anda, silakan konfirmasi alamat email dengan menggunakan token berikut:</p>
                            <p><strong>{{ $user->remember_token }}</strong></p>
                            <p>Detail akun Anda:</p>
                            <ul>
                                <li><strong>Nama:</strong> {{ $user->name }}</li>
                                <li><strong>Email:</strong> {{ $user->email }}</li>
                                <li><strong>Password:</strong> {{ $password }}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="button-container">
                            <a href="{{route('confirm.email', ['token' => $user->remember_token, 'email' => $user->email]) }}" class="button">Verifikasi Email</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="divider"></td>
                    </tr>
                    <tr>
                        <td class="footer">
                            <p>Jika Anda tidak mendaftar untuk akun ini, Anda dapat mengabaikan email ini.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>