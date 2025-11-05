<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Kemahasiswaan UIN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('{{ asset('images/background.jpg') }}') center/cover no-repeat;
            padding: 1rem;
        }

        .container {
            display: flex;
            width: 65%;
            max-width: 1000px;
            box-shadow: 0 20px 80px rgba(0, 0, 0, 0.5);
            border-radius: 16px;
            overflow: hidden;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, rgba(45, 122, 62, 0.9) 0%, rgba(30, 92, 45, 0.9) 100%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .logo-container {
            margin-bottom: 2rem;
        }

        .logo img {
            width: 180px;
            height: auto;
            filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.3));
        }

        .divider {
            width: 75%;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
            margin: 1.8rem 0;
        }

        .left-panel h2 {
            font-size: 1.25rem;
            font-weight: 400;
            line-height: 1.7;
        }

        .right-panel {
            flex: 1;
            background: white;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
        }

        .login-header {
            font-size: 2.3rem;
            color: #333;
            margin-bottom: 2.2rem;
            font-weight: 600;
        }

        .mobile-logo-section {
            display: none;
            background: linear-gradient(135deg, rgba(45, 122, 62, 0.9) 0%, rgba(30, 92, 45, 0.9) 100%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: white;
            text-align: center;
            padding: 3rem 1rem ;
            border-radius: 16px 16px 0 0;
        }

        .mobile-logo-section img {
            width: 90px;
            height: auto;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.25));
            margin-bottom: 1rem;
        }

        .mobile-logo-section h2 {
            font-size: 1rem;
            line-height: 1.5;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.6rem;
            color: #666;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.95rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2d7a3e;
            background: white;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 0.85rem;
            padding: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .toggle-password:hover {
            color: #666;
        }

        .toggle-password svg {
            width: 18px;
            height: 18px;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: #6b6b6b;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1.5rem;
        }

        .btn-login:hover {
            background: #555;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .help-link {
            text-align: left;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: #666;
            font-size: 0.95rem;
        }

        .help-link a {
            color: #2d7a3e;
            text-decoration: none;
            font-weight: 600;
        }

        .help-link a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: auto;
            padding-top: 2rem;
            border-top: 1px solid #e0e0e0;
            color: #777;
            font-size: 0.75rem;
            text-align: center;
        }

        .footer a {
            color: #2d7a3e;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 1140px) {
            .container {
                width: 100%;
                max-width: 900px;
            }

            .help-link {
                margin-bottom: 0;
            }
        }
        	

        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                width: 90%;
                max-width: 500px;
                background: transparent;
            }

            .left-panel {
                display: none;
            }

            .mobile-logo-section {
                display: block;
            }

            .right-panel {
                padding: 0;
                border-radius: 0 0 16px 16px;
                background: none;
            }

            .right-panel .form-container {
                padding: 2rem 2rem;
                background: white;
            }

            .login-header {
                font-size: 1.85rem;
                margin-bottom: 1.8rem;
                text-align: center;
            }

            .footer {
                font-size: 0.8rem;
                margin-top: 2rem;
            }
        }

        @media (max-width: 600px) {
            .mobile-logo-section img {
                width: 75px;
            }

            .mobile-logo-section h2 {
                font-size: 0.9rem;
            }

            .login-header {
                font-size: 1.7rem;
            }
        }

        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;  
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo UIN">
                </div>
            </div>
            <div class="divider"></div>
            <h2>Sistem Informasi<br>Kemahasiswaan UIN Maulana<br>Malik Ibrahim</h2>
        </div>

        <div class="right-panel">
            <div class="mobile-logo-section">
                <img src="{{ asset('images/logo.png') }}" alt="Logo UIN">
                <h2>Sistem Informasi Kemahasiswaan <br> UIN Maulana Malik Ibrahim</h2>
            </div>


            <div class="form-container">
                <h1 class="login-header">Login</h1>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nim">ID User / NIM</label>
                        <input type="text" id="nim" name="nim" value="{{ old('nim') }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Kode Akses / PIN</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <span id="toggle-text">Hide</span>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>

                <div class="help-link">
                    Belum punya akun? <a href="https://kemahasiswaan.uin-malang.ac.id/kontak/">Hubungi Admin</a>
                </div>

                <div class="footer">
                    Bagian Kemahasiswaan UIN Maulana Malik Ibrahim Malang<br>
                    Website resmi: <a href="https://kemahasiswaan.uin-malang.ac.id" target="_blank">kemahasiswaan.uin-malang.ac.id</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleText = document.getElementById('toggle-text');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleText.textContent = 'Show';
                eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                passwordInput.type = 'password';
                toggleText.textContent = 'Hide';
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }
    </script>
</body>
</html>
