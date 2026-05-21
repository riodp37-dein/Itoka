<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Admin - Sistem Inventaris</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            overflow: hidden;
            background-color: #f5f5f5;
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .info-card {
            background-color: #FFFFFF;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .info-card h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .info-card p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .admin-contact {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #eee;
        }

        .admin-contact p {
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
        }

        .admin-contact p:last-child {
            margin-bottom: 0;
        }

        .back-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #6B6B6B;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background-color: #5A5A5A;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="info-card">
            <h2>Bantuan Akun</h2>
            <p>Untuk alasan keamanan, pembuatan akun baru atau reset password hanya dapat dilakukan oleh Administrator sistem.</p>
            
            <div class="admin-contact">
                <p>Silakan hubungi Administrator:</p>
                <p>Email: admin@admin.com</p>
                <p>WhatsApp: +62 812-3456-7890</p>
            </div>

            <a href="{{ route('login') }}" class="back-btn">Kembali ke Halaman Login</a>
        </div>
    </div>
</body>
</html>
