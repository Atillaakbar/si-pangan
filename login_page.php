<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SI-Pangan</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            overflow: hidden; /* Mencegah scrolling */
        }
        
        .login-container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* Bagian Kiri (Gambar Gedung) */
        .left-panel {
            flex: 1; /* Mengambil setengah bagian */
            
            /* GANTI DI SINI: Menggunakan gambar lokal dari folder public/images */
            background-image: url('<?= base_url('images/gedung.jpeg') ?>'); 
            
            background-size: cover;
            background-position: center;
            position: relative;
        }

        /* Bagian Kanan (Form Login) */
        .right-panel {
            flex: 1; /* Mengambil setengah bagian */
            display: flex;
            justify-content: center; /* Pusatkan form secara horizontal */
            align-items: center; /* Pusatkan form secara vertikal */
            background-color: #ffffff;
            
            /* Trik untuk membuat lengkungan besar */
            margin-left: -200px; 
            border-top-left-radius: 200px; 
            border-bottom-left-radius: 200px;
            
            position: relative; 
            z-index: 2;
        }

        .login-form-wrapper {
            width: 350px;
            /* Beri padding kiri agar form tidak tertutup lengkungan */
            padding-left: 100px; 
            box-sizing: border-box;
        }

        .logo {
            display: block;
            margin: 0 auto 30px; /* Logo di tengah, beri jarak bawah */
            width: 100px; /* Ukuran logo */
            height: 100px;
        }

        .form-group {
            margin-bottom: 20px; /* Jarak antar input */
            position: relative;
        }

        /* INI ADALAH INPUT FIELDNYA, STYLING SEPERTI GAMBAR */
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            background-color: #2e7d32; /* Warna hijau */
            color: white; /* Warna teks yang diketik */
            font-size: 1rem;
            font-weight: 500;
            border: none;
            border-radius: 5px;
            box-sizing: border-box; /* Penting */
        }
        
        /* STYLING PLACEHOLDER-NYA (Email, Password) */
        .form-group input::placeholder {
            color: white;
            opacity: 1; /* Firefox */
            font-weight: 500;
        }
        .form-group input:-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: white;
            font-weight: 500;
        }
        .form-group input::-ms-input-placeholder { /* Microsoft Edge */
            color: white;
            font-weight: 500;
        }


        .forgot-password {
            display: block;
            text-align: right;
            margin-top: 15px;
            text-decoration: none;
            color: #333;
            font-size: 0.9rem;
        }

        /* Tombol Login (harus ada untuk form) */
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #2e7d32; /* Samakan dengan input */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 25px;
            transition: background-color 0.2s ease;
        }
        .btn-login:hover {
            background-color: #1b5e20; /* Warna hijau lebih gelap */
        }

        /* Untuk pesan error */
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="left-panel"></div>
        
        <div class="right-panel">
            <div class="login-form-wrapper">
                
                <img src="<?= base_url('images/logopolinela.png') ?>" alt="Logo Polinela" class="logo">
                
                <form action="<?= site_url('auth/login') ?>" method="post">
                    <?= csrf_field() ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <a href="#" class="forgot-password">Forgot password?</a>
                    
                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>