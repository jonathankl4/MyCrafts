<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .otp-code {
            font-size: 20px;
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Terima kasih telah mendaftar, {{ $get_user_name }}!</h1>
        <p>Untuk menyelesaikan proses pendaftaran, silakan masukkan kode OTP di bawah ini ke halaman verifikasi di website kami:</p>
        <p class="otp-code">{{ $validToken }}</p>
        <p>Jika Anda tidak melakukan pendaftaran ini, harap abaikan email ini.</p>
        <p>Terima kasih telah menggunakan layanan kami!</p>
    </div>
</body>
</html>
