<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Barang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 60px;
            max-width: 600px;
            text-align: center;
        }
        
        h1 {
            color: #667eea;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        
        p {
            color: #666;
            font-size: 1.2em;
            margin-bottom: 40px;
        }
        
        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.1em;
            transition: transform 0.3s, box-shadow 0.3s;
            margin: 10px;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .features {
            margin-top: 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }
        
        .feature {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .feature h3 {
            color: #667eea;
            margin-bottom: 10px;
        }
        
        .feature p {
            font-size: 0.9em;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏢 Sistem Inventaris Barang</h1>
        <p>Kelola inventaris barang Anda dengan mudah dan efisien</p>
        
        <div>
            <a href="#" class="btn">Masuk</a>
            <a href="#" class="btn">Daftar</a>
        </div>
        
        <div class="features">
            <div class="feature">
                <h3>📦</h3>
                <p>Manajemen Barang</p>
            </div>
            <div class="feature">
                <h3>📊</h3>
                <p>Laporan Real-time</p>
            </div>
            <div class="feature">
                <h3>🔍</h3>
                <p>Pencarian Cepat</p>
            </div>
        </div>
    </div>
</body>
</html>
