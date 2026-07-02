<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>Sistem Aplikasi Tempahan Bilik MdI</title>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
            /* Prevents bouncing scroll effects on mobile browsers */
            overflow-x: hidden; 
        }

        /* Responsive Container */
        .page-container {
            display: flex;
            width: 100vw;
            height: 100vh;
            background-color: #ffffff;
            overflow-y: auto;
        }

        /* Desktop Mode Upgrades */
        @media(min-width: 768px) {
            body {
                padding-bottom: 60px; /* Make space for desktop footer */
            }
            .page-container {
                width: 85vw;
                max-width: 1100px;
                height: 70vh;
                min-height: 520px;
                border-radius: 16px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }
        }

        /* Left Side: Graphic Banner */
        .banner-side {
            display: none;
            flex: 1.2;
            background-image: url("./logo/wallpaperEbooking.jpeg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        @media(min-width: 768px) {
            .banner-side {
                display: block;
            }
        }

        /* Right Side: Login Area */
        .login-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 30px 24px;
            background-color: #ffffff;
            width: 100%;
        }

        @media(min-width: 768px) {
            .login-side {
                padding: 40px;
            }
        }

        .login-header {
            margin-bottom: 25px;
            text-align: center;
        }

        .login-header h2 {
            color: #003b6f;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .login-header p {
            font-size: 0.9rem;
            color: #718096;
        }

        /* Inputs and Mobile Touch Target Size (Min 44px height for easy tapping) */
        .form-group {
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px; /* Increased padding slightly for mobile fingers */
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px; /* Mandating 16px stops iOS Safari from auto-zooming input fields */
            transition: all 0.3s ease;
            background-color: #f8fafc;
            -webkit-appearance: none; /* Uniform styling on iOS devices */
        }

        .form-group input:focus {
            outline: none;
            border-color: #003b6f;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(0, 59, 111, 0.15);
        }

        /* Actions & Responsive Submit button */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .forgot-link {
            font-size: 0.85rem;
            color: #003b6f;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-submit {
            background-color: #003b6f;
            color: white;
            padding: 12px 28px;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            -webkit-tap-highlight-color: transparent;
        }

        /* Full width button on small mobile views for better ergonomics */
        @media(max-width: 480px) {
            .form-actions {
                flex-direction: column-reverse;
                gap: 16px;
            }
            .btn-submit {
                width: 100%;
                padding: 14px;
            }
        }

        .btn-submit:hover {
            background-color: #002b5c;
        }

        /* Alternative Register Box Layout */
        .register-box {
            text-align: center;
            border-top: 1px solid #edf2f7;
            padding-top: 20px;
            margin-top: 10px;
            font-size: 0.9rem;
            color: #718096;
        }

        .register-link, .dashboard-link {
            color: #003b6f;
            font-weight: 600;
            text-decoration: none;
        }

        /* Responsive Footer placement */
        .footer {
            background-color: #003b6f;
            text-align: center;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.8rem;
            padding: 15px;
            width: 100%;
        }

        @media(min-width: 768px) {
            .footer {
                position: absolute;
                bottom: 0;
                left: 0;
            }
        }
    </style>
</head>
<body>

    <div class="page-container">
        <div class="banner-side"></div>

        <div class="login-side">
            @if (Route::has('login'))
                @auth
                    <div class="login-header">
                        <h2>Selamat Kembali</h2>
                        <p>Sila akses panel utama anda melalui pautan di bawah.</p>
                    </div>
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="{{ url('/dashboard') }}" class="dashboard-link">Pergi ke Dashboard &rarr;</a>
                    </div>
                @else
                    <div class="login-header">
                        <h2>LOG MASUK</h2>
                        <p>Sistem Tempahan Bilik Mesyuarat MdI</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">E-mel :</label>
                            <input id="email" name="email" required type="email" 
                                   placeholder="contoh@insolvensi.gov.my" 
                                   autocapitalize="none" 
                                   autocorrect="off" 
                                   autocomplete="email" />
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Laluan :</label>
                            <input id="password" name="password" required type="password" 
                                   placeholder="••••••••" 
                                   autocomplete="current-password" />
                        </div>

                        <div class="form-actions">
                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">Lupa Kata Laluan?</a>
                            @else
                                <div></div>
                            @endif
                            <button type="submit" class="btn-submit">Masuk</button>
                        </div>
                    </form>

                    @if (Route::has('register'))
                        <div class="register-box">
                            Belum mempunyai akaun? <a href="{{ route('register') }}" class="register-link">Daftar Sini</a>
                        </div>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <footer class="footer">
        <p>Hakcipta Terpelihara {{ date('Y') }} @ Jabatan Insolvensi Malaysia (MdI)</p>
    </footer>

</body>
</html>
