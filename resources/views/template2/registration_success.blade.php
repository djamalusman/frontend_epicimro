<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Berhasil</title>
</head>
<body>
    <h2>Halo, {{ $user->name }}</h2>
    <p>Selamat! Akun Anda telah berhasil didaftarkan.</p>
    <p>Berikut adalah informasi akun Anda:</p>
    <ul>
        <li><strong>Nama:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Silakan login ke akun Anda dengan Url ini https://kerjateknik.id/login dan mulai menggunakan layanan kami.</p>
    <br>
    <p>Terima kasih!</p>
</body>
</html>
