<?php
    session_start();

    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: ../index.php");
        exit();
    } 
    
    if ($_SESSION['role'] !== 'mahasiswa') {
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-form-TA.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>SIBETA | Sistem Bebas Tanggungan | Form Prodi</title>
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
<<<<<<< Updated upstream
                    <h4>Formulir Tanggungan Skripsi/TA</h4>
                    <form action="" method="post" enctype="multipart/form-data">
=======
                    <h4>Formulir Tanggungan Prodi</h4>
                    <form action="../assets/php/upload-prodi.php" method="post" enctype="multipart/form-data">
>>>>>>> Stashed changes

                        <label>Bukti Distribusi Buku Skripsi / Laporan Akhir</label>
                        
                        <label for="up-skripsi" class="upload-btn">Unggah</label> <!--button-->
                        <input type="file" name="up-skripsi" id="up-skripsi">
                        
                        <label>Bukti Distribusi Laporan PKL</label>
                        
                        <label for="up-pkl" class="upload-btn">Unggah</label> <!--button-->
                        <input type="file" name="up-pkl" id="up-pkl">
                        
                        <label>Bukti Bebas Kompen</label>
                        
                        <label for="up-kompen" class="upload-btn">Unggah</label> <!--button-->
                        <input type="file" name="up-kompen" id="up-kompen">
                        
                        <button type="submit" id="submit-btn">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>