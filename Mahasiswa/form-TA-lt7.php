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

    include '../config/db-connect.php';

    $queyCheck = "SELECT * FROM FORM_TA 
                join MAHASISWA ON FORM_TA.NIM = MAHASISWA.NIM 
                WHERE FORM_TA.NIM = ?";
    $params = array($_SESSION['noInduk']);
    $result = sqlsrv_query($conn, $queyCheck, $params);

    $data = sqlsrv_fetch_array($result);
    
    $isSubmitted = $data ? 'true' : 'false';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style-form-TA.css">
    <title>SIBETA | Sistem Bebas Tanggungan | Form TA</title>
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
                <?php include '../include/adm-identitiy.php' ?>

                <div class="form">
                    <h4>Formulir Tanggungan Skripsi/TA</h4>
                    <form action="../assets/php/upload-TA.php" method="post" enctype="multipart/form-data">

                        <label>Laporan Tugas Akhir/Skripsi</label>
                        <div class="file-upload">
                            <label for="up-laporan-ta" class="upload-btn">Unggah</label>
                            <input type="file" name="up-laporan-ta" id="up-laporan-ta">
                            <span id="laporan-ta-name">No File Choosen.</span>
                        </div>
                        
                        <label>Program/Aplikasi Tugas Akhir/Skripsi</label>
                        <div class="file-upload">
                            <label for="up-program" class="upload-btn">Unggah</label>
                            <input type="file" name="up-program" id="up-program">
                            <span id="program-name">No File Choosen.</span>
                        </div>
                        
                        <label>Bukti Publikasi Tugas Akhir</label>
                        <div class="file-upload">
                            <label for="up-publikasi" class="upload-btn">Unggah</label>
                            <input type="file" name="up-publikasi" id="up-publikasi">
                            <span id="publikasi-name">No File Choosen.</span>
                        </div>

                        <button type="submit" id="submit-btn" data-submitted="<?= $isSubmitted; ?>" onclick="checkSubmit()">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const laporanTa = document.getElementById('up-laporan-ta');
        const programTa = document.getElementById('up-program');
        const publikasi = document.getElementById('up-publikasi');

        laporanTa.addEventListener('change', function () {

            if (!sizeCheck(laporanTa)) {
                document.getElementById('laporan-ta-name').classList = "err";
                document.getElementById('laporan-ta-name').innerHTML = "Ukuran File Tidak Boleh Melebihi 50 MB";
                this.value = "";
            } else if (laporanTa.value) {
                document.getElementById('laporan-ta-name').innerHTML = laporanTa.files[0].name;
            }
        });
        programTa.addEventListener('change', function () {
            
            if (!sizeCheck(programTa)) {
                document.getElementById('program-name').classList = "err";
                document.getElementById('program-name').innerHTML = "Ukuran File Tidak Boleh Melebihi 50 MB";
                this.value = "";
            } else if (programTa.value) {
                document.getElementById('program-name').innerHTML = programTa.files[0].name;
            }
        });
        publikasi.addEventListener('change', function () {

            if (!sizeCheck(publikasi)) {
                document.getElementById('publikasi-name').classList = "err";
                document.getElementById('publikasi-name').innerHTML = "Ukuran File Tidak Boleh Melebihi 50 MB";
                this.value = "";
            } else if (publikasi.value) {
                document.getElementById('publikasi-name').innerHTML = publikasi.files[0].name;
            }
        });

        function sizeCheck(inputFiles) {
            const size = (inputFiles.files[0].size / 1024 / 1024).toFixed(2);

            if (size > 50) {
                return false;
            } 
            return true;
        }

        function checkSubmit() {
            const submit = document.getElementById('submit-btn');
            const isSubmited = submit.getAttribute('data-submitted') === 'true';
            
            if (isSubmited) {
                event.preventDefault();
                const message = document.createElement('p');
                message.textContent = 'Anda Sudah Mengunggah Formulir.';
                document.querySelector('.form').appendChild(message);
            } else if (validation() === false) {
                event.preventDefault();
                const message = document.createElement('p');
                message.textContent = 'Lengkapi Form Sebelum Melakukan Kirim.';
                document.querySelector('.form').appendChild(message);
            } 
        }

        function validation() {
            if (laporanTa.files.length === 0 ||
                programTa.files.length === 0 ||
                publikasi.files.length === 0
            ) {
                return false;
            } 
            return true;
        }
    </script>
</body>
</html>