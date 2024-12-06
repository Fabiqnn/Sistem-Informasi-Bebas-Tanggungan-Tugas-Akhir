<?php
    session_start();

    if (isset($_SESSION['error'])) {
        echo "<script type='text/javascript'>
            alert('" . $_SESSION['error'] . "');
        </script>";
        unset($_SESSION['error']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style-login.css" type="text/css">
    <title>Login</title>
</head>
<body>
    <div class="header"></div>
    <div class="body"> 
        <div class="form">
            <div class="content">
                <h1>Sistem Informasi Bebas Tanggungan</h1>
                <h3>Masuk Ke Akun Anda!</h3>
                <form action="assets/php/login-handler.php" method="post" id="login-form">
                    <div class="input-form">
                        <label for="noInduk">Nomor Induk</label>
                        <input type="text" name="noInduk" id="noInduk" placeholder="Masukkan No Induk Pegawai/Mahasiswa">
                    </div>
                    <div class="input-form">
                        <label for="pass">Kata Sandi</label>
                        <input type="password" name="pass" id="pass" placeholder="Masukkan Sandi">
                    </div>
                    <button type="submit">Masuk</button>
                </form>
                <a href="lupa-sandi.php">Lupa Sandi? Klik disini</a>
            </div>
        </div>
    
        <div class="informasi">
            <img src="assets/images/Logo Fiks.png" alt="">
            <h1>Selamat Datang</h1>
            <p>Platform resmi ‘SIBETA’ untuk memfasilitasi proses administrasi pelepasan tanggungan mahasiswa. Akses status tanggungan Anda dengan mudah dan pastikan kelancaran proses kelulusan Anda di sini.</p>
        </div>
    </div>
    <div class="footer"></div>

    <script src="assets/js/script-login.js"></script>
</body>
</html>