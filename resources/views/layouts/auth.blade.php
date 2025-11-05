<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-R">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Kemahasiswaan UIN</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body class="auth-page">

    <div class="login-container">
        <div class="login-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo UIN">
            <h1>Sistem Informasi Kemahasiswaan UIN Maulana Malik Ibrahim</h1>
        </div>
        <div class="login-right">
            <h2>@yield('title')</h2>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    <footer class="auth-footer">
        Bagian Kemahasiswaan UIN Maulana Malik Ibrahim Malang | © {{ date('Y') }}
    </footer>
    
    </body>
</html>