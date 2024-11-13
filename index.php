<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styleLogin.css" type="text/css">
    <title>Login</title>
</head>
<body>
    <div class="header"></div>
    <div class="form">
        <h1>Sistem Informasi Bebas Tanggungan</h1>
        <h3>Masuk Ke Akun Anda!</h3>
        <form action="">
            <div class="input-form">
                <label for="noInduk">Nomor Induk</label>
                <input type="text" name="noInduk" id="noInduk" placeholder="Masukkan No Induk Pegawai/Mahasiswa">
            </div>
            <div class="input-form">
                <label for="pass">Kata Sandi</label>
                <input type="password" name="pass" id="pass" placeholder="Masukkan Sandi">
            </div>
            <input type="submit" value="Masuk">
        </form>
    </div>

    <div class="informasi"></div>
    <div class="footer"></div>
</body>
</html>