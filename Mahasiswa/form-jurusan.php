<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/style-form-jurusan.css">
    <title>Form Jurusan</title>
</head>
<body>
    <?php 
        include '../include/header.php';
    ?>

    <div class="body">
        <?php
            include '../include/sidebar.php';
        ?>
        <div class="main-content">
            <?php
                include '../include/banner.php';
            ?>

            <div class="form-container">
                <h3>Bebas Tanggungan Jurusan Teknologi Informasi</h3>
                <div class="informasi-admin">
                    <h4>Informasi Admin</h4>
                    <hr>
                    <h5>Nama Admin : </h5>
                    <h5>Email : </h5>
                    <h5>No HandPhone : </h5>
                    <h5>Jabatan : </h5>
                </div>

                <div class="form">
                    <button class="update-btn">update</button>
                    <h4>Formulir Tanggungan Jurusan</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="fname">Nama Lengkap</label>
                        <input type="text" name="fname" id="fname">
                        <label for="fnim">NIM</label>
                        <input type="text" name="fnim" id="fnim">
                        <label for="femail">Email</label>
                        <input type="email" name="femail" id="femail">
                        <label for="fnumber">No. Whatsapp</label>
                        <input type="tel" name="fnumber" id="fnumber" pattern="^(\+62|62|0)8[1-9][0-9]{6,10}$" >

                        <label>Laporan Tugas Akhir/Skripsi</label>
                        <label for="up-laporan-ta" class="upload-btn">upload</label>
                        <input type="file" name="up-laporan-ta" id="up-laporan-ta">
                        
                        <label>Program/Aplikasi Tugas Akhir/Skripsi</label>
                        <label for="up-program" class="upload-btn">upload</label>
                        <input type="file" name="up-program" id="up-program">
                        
                        <label>Bukti Publikasi</label>
                        <label for="up-publikasi" class="upload-btn">upload</label>
                        <input type="file" name="up-publikasi" id="up-publikasi">

                        <button type="submit" id="submit-btn">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/script-form-jurusan.js"></script>
</body>
</html>