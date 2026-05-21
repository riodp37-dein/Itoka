<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris</title>
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
        }

        /* Left Side - Info Section */
        .left-section {
            flex: 1;
            background-color: #6B6B6B;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
            color: white;
        }

        .left-content {
            max-width: 500px;
        }

        .left-content h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 25px;
            line-height: 1.3;
        }

        .left-content p {
            font-size: 16px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Right Side - Login Form */
        .right-section {
            flex: 1;
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            margin-bottom: 35px;
        }

        .login-header h2 {
            font-size: 32px;
            color: #000;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .login-header p {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            color: #000;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .input-wrapper {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #CCCCCC;
            border-radius: 8px;
            font-size: 15px;
            background-color: #FFFFFF;
            transition: all 0.3s;
            color: #333;
        }

        .form-group input:focus {
            outline: none;
            border-color: #999;
            background-color: white;
        }

        .form-group input::placeholder {
            color: #999;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            font-size: 18px;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background-color: #6B6B6B;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .login-btn:hover {
            background-color: #5A5A5A;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #999;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #CCCCCC;
        }

        .divider span {
            padding: 0 15px;
        }

        .google-btn {
            width: 100%;
            padding: 14px;
            background-color: white;
            color: #333;
            border: 2px solid #CCCCCC;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .google-btn:hover {
            border-color: #999;
            background-color: #F5F5F5;
        }

        .contact-admin-btn {
            display: block;
            width: 100%;
            padding: 14px;
            background-color: white;
            color: #333;
            border: 2px solid #CCCCCC;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .contact-admin-btn:hover {
            border-color: #999;
            background-color: #F5F5F5;
        }

        .error-message {
            background-color: #FFE5E5;
            color: #C62828;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #C62828;
        }

        /* Responsive */
        @media (max-width: 968px) {
            body {
                flex-direction: column;
            }

            .left-section {
                padding: 40px 30px;
                min-height: 300px;
            }

            .left-content h1 {
                font-size: 32px;
            }

            .right-section {
                padding: 40px 30px;
            }
        }

        @media (max-width: 640px) {
            .left-section {
                padding: 30px 20px;
                min-height: 250px;
            }

            .left-content h1 {
                font-size: 28px;
            }

            .left-content p {
                font-size: 14px;
            }

            .right-section {
                padding: 30px 20px;
            }

            .login-header h2 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <!-- Left Section -->
    <div class="left-section">
        <div class="left-content">
            <h1>Selamat Datang di Sistem Inventaris</h1>
            <p>Kelola data barang, stok masuk, dan stok keluar secara otomatis dan efisien. Tingkatkan produktivitas dengan sistem inventaris digital yang cepat, akurat, dan mudah digunakan.</p>
        </div>
    </div>

    <!-- Right Section - Login Form -->
    <div class="right-section">
        <div class="login-container">
            <div class="login-header">
                <h2>Selamat Datang Kembali!</h2>
                <p>Silakan masuk ke akun Anda untuk melanjutkan pengelolaan inventaris.</p>
            </div>

            @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Masukkan email Anda"
                        required
                        value="{{ old('email') }}"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            required
                        >
                        <span class="password-toggle" onclick="togglePassword()"></span>
                    </div>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <a href="{{ route('contact-admin') }}" class="contact-admin-btn">Lupa Password / Buat Akun</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🔓';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '🔒';
            }
        }
    </script>
</body>
</html>