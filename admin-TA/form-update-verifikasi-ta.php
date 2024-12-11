<?php
    session_start();

    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: ../index.php");
        exit();
    } 

    if ($_SESSION['role'] !== 'Admin TA') {
        header("Location: ../index.php");
        exit();
    }

    include '../config/db-connect.php';

    if (isset($_GET['id'])) {
        $idMhs = $_GET['id'];

        $queryCheck = " SELECT * FROM FORM_TA 
                        JOIN MAHASISWA ON FORM_TA.NIM = MAHASISWA.NIM
                        JOIN VERIFIKASI ON FORM_TA.ID_VERIFIKASI = VERIFIKASI.ID_VERIFIKASI
                        WHERE FORM_TA.NIM = ?";
        $params = array($idMhs);
        $result = sqlsrv_query($conn, $queryCheck, $params);

        if ($result) {
            $getData = sqlsrv_fetch_array($result);

            $idVerif = $getData['ID_VERIFIKASI'];
            $skripsi = $getData['FILE_LAPORAN_TA'];
            $program = $getData['PROGRAM_TA'];
            $publikasi = $getData['PUBLIKASI'];
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    } 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-form-verifikasi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>SIBETA | Sistem Bebas Tanggungan | Form Update Verifikasi</title>
</head>
<body>
    <?php include '../include/header.php'?>

    <div class="body">
        <?php include '../include/sidebar-adm.php'?>

        <div class="main-content">
            <?php include '../include/banner.php' ?>

            <div class="form-container">
                <h3>Verifikasi Upload Mahasiswa</h3>
                <hr id="hr-1">
                <div class="form-verifikasi">
                    <h4>Formulir Tanggungan Skripsi/TA</h4>

                    <label>Nama</label>
                    <div class="box">
                        <h5><?= $getData['NAMA_MHS']?></h5>
                    </div>

                    <label>NIM</label>
                    <div class="box">
                        <h5><?= $getData['NIM']?></h5>
                    </div>

                    <label>No. Whatsapp</label>
                    <div class="box">
                        <h5><?= $getData['NO_WA_MHS']?></h5>
                    </div>

                    <label>Email</label>
                    <div class="box">
                        <h5><?= $getData['EMAIL_MHS']?></h5>
                    </div>

                    <!-- download button -->
                    <label>Laporan Tugas Akhir/Skripsi</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $skripsi?>">Download</a>
                        <span id="skripsi-name"><?= $skripsi;?></span>
                    </div>

                    <label>Program/Aplikasi Tugas Akhir</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $program?>">Download</a>
                        <span id="program-name"><?= $program;?></span>
                    </div>

                    <label>Bukti Publikasi</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $publikasi?>">Download</a>
                        <span id="publikasi-name"><?= $publikasi;?></span>
                    </div>

                    <hr>

                    <!-- form verifikasi -->
                    <form action="../assets/php/verifikasi-update-adm.php?id=<?= $idMhs?>&idVerif=<?= $idVerif?>" method="post">
                        <div class="form-verif">
                            <div class="input">
                                <label for="catatan">Catatan Untuk Mahasiswa</label>
                                <input type="text" name="catatan" id="catatan" value="<?= $getData['catatan'] ?>">
                            </div>
                            <div class="input">
                                <label for="status">Status Verifikasi</label>
                                <select name="status" id="status">
                                    <option value="Disetujui" <?= ($getData['STATUS_VERIFIKASI'] == 'Disetujui') ? 'selected' : '' ?>>Setuju</option>
                                    <option value="Ditolak" <?= ($getData['STATUS_VERIFIKASI'] == 'Ditolak') ? 'selected' : '' ?>>Tolak</option>
                                </select>
                            </div>
                            <div class="simpan">
                                <button type="submit" name="simpan" id="simpan">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>