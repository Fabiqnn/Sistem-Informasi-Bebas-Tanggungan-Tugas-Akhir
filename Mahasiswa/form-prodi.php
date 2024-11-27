<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-form-prodi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- dropzone -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <title>Form Bebas Tanggungan TA Prodi</title>
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
                    <h4>Formulir Tanggungan Prodi</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="fnama">Nama Lengkap</label>
                        <input type="text" name="fnama" id="fnama">
                        <label for="fnim">NIM</label>
                        <input type="text" name="fnim" id="fnim">
                        <label for="femail">Email</label>
                        <input type="email" name="femail" id="femail">
                        <label>Bukti Distribusi Buku Skripsi / Laporan Akhir</label>
                        
                        <label for="up-skripsi" class="upload-btn">upload</label> <!--button-->
                        <input type="file" name="up-skripsi" id="up-skripsi">
                        
                        <label>Bukti Distribusi Laporan PKL</label>
                        
                        <label for="up-pkl" class="upload-btn">upload</label> <!--button-->
                        <input type="file" name="up-pkl" id="up-pkl">
                        
                        <label>Bukti Bebas Kompen</label>
                        
                        <label for="up-kompen" class="upload-btn">upload</label> <!--button-->
                        <input type="file" name="up-kompen" id="up-kompen">
                        
                        <button type="submit" id="submit-btn">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../assets/js/script-form-prodi.js"></script>
</body>

</html>