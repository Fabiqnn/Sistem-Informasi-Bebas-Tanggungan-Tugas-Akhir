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

    $idMhs = $_SESSION['noInduk'];

    $queryTA = "SELECT STATUS_VERIFIKASI FROM FORM_TA 
            JOIN VERIFIKASI ON FORM_TA.ID_VERIFIKASI = VERIFIKASI.ID_VERIFIKASI
            WHERE FORM_TA.NIM = ?";
    $queryProdi = "SELECT STATUS_VERIFIKASI FROM FORM_PRODI 
            JOIN VERIFIKASI ON FORM_PRODI.ID_VERIFIKASI = VERIFIKASI.ID_VERIFIKASI
            WHERE FORM_PRODI.NIM = ?";
    $queryPustaka = "SELECT STATUS_VERIFIKASI FROM FORM_Pustaka 
            JOIN VERIFIKASI ON FORM_Pustaka.ID_VERIFIKASI = VERIFIKASI.ID_VERIFIKASI
            WHERE FORM_Pustaka.NIM = ?";

    $params = array($idMhs);
    $resultTa = sqlsrv_query($conn, $queryTA, $params);
    $resultProdi = sqlsrv_query($conn, $queryProdi, $params);
    $resultPustaka = sqlsrv_query($conn, $queryPustaka, $params);

    if (!$resultTa && !$resultProdi && !$resultPustaka) {
        die("Error Query" . print_r(sqlsrv_errors(), true)); 
    } else {
        $statusTa = sqlsrv_fetch_array($resultTa);
        $statusProdi = sqlsrv_fetch_array($resultProdi);
        $statusPustaka = sqlsrv_fetch_array($resultPustaka);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-print.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title> SIBETA | Sistem Bebas Tanggungan | Print Formulir Penyelesaian</title>
</head>
<body>
    <?php include '../include/header.php' ?>

    <div class="body">
        <?php include '../include/sidebar.php' ?>

        <div class="main-content">
            <?php include '../include/banner.php' ?>

            <div class="card-container">
                <h3 id="tittle">Cetak Surat Bebas Tanggungan</h3>
                <hr class="hr-1">
                <div class="cetak-btn">
                    <button id="print">Cetak</button>
                </div>

                <div id="print-area">
                    <table class="header" width="100%">
                        <tr>
                            <td align="left" width="12%">
                                <img src="../assets/images/logo-polinema.png" alt="logo-poilinema" width="100" height="100">
                            </td>
                            <td align="center" width="76%" colspan="2">
                                <div>
                                    <div style="font-size:15px">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI</div>
                                    <div style="font-size:18px">POLITEKNIK NEGERI MALANG</div>
                                    <div style="font-size:14px">Jalan Soekarno-Hatta No.9 PO Box 04 Malang 65141 </div>
                                    <div style="font-size:14px">Telp. (0341) 404424 Fax. (0341) 404423<br>http://www.polinema.ac.id</div>
                                </div>
                            </td>
                            <td align="left" width="12%"></td>
                        </tr>
                    </table>
                    <hr style="border-top:solid 1px #000000; border-bottom:solid 1px #000000; line-height:normal; color:#FFFFFF; margin-top:2px;">
                    <br>
                    <table class="credential" width ="100%">
                        <tr>
                            <td colspan="3" style="text-align: center;">
                                <h2>Surat Bebas Tanggungan</h2>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px">NIM</td>
                            <td style="width: 5px">:</td>
                            <td>2341720170</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?= $_SESSION['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td><?= $_SESSION['prodi'] ?></td>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td>:</td>
                            <td>Teknologi Informasi</td>
                        </tr>
                    </table>
                    <br>
                    
                    <h3>Bebas Tanggungan TA</h3>
                    <table width="100%">
                        <tr>
                        <?php if (isset($statusTa['STATUS_VERIFIKASI'])): ?>
                            <td align="center"><h2 style="font-weight: 400;"><?= $statusTa['STATUS_VERIFIKASI'] ?></h2 style="font-weight: 400;"></td>
                        <?php endif; ?>
                        </tr>
                    </table>

                    <hr style="opacity: .5; margin: 10px 0;">            
                    
                    <h3>Bebas Tanggungan Prodi</h3>
                    <table width="100%">
                        <tr>
                        <?php if (isset($statusProdi['STATUS_VERIFIKASI'])): ?>
                            <td align="center"><h2 style="font-weight: 400;"><?= $statusProdi['STATUS_VERIFIKASI'] ?></h2 style="font-weight: 400;"></td>
                        <?php endif; ?>
                        </tr>
                    </table width="100%">

                    <hr style="opacity: .5; margin: 10px 0;">

                    <h3>Bebas Tanggungan Pustaka</h3>
                    <table width="100%">
                        <tr>
                        <?php if (isset($statusPustaka['STATUS_VERIFIKASI'])): ?>
                            <td align="center"><h2 style="font-weight: 400;"><?= $statusPustaka['STATUS_VERIFIKASI'] ?></h2 style="font-weight: 400;"></td>
                        <?php endif; ?>
                        </tr>
                    </table>

                    <hr style="opacity: .5; margin: 10px 0;">

                    <table border="0" class="TableFormulir" style="width:100%; padding-top: 50px;">
                        <tbody>
                            <tr>
                                <td style="text-align: right; vertical-align: bottom; width: 30%; height: 50px;"></td>
                                <td style="text-align: right; vertical-align: bottom; width: 40%; height: 50px;"></td>
                                <td style="text-align: right; vertical-align: bottom; width: 30%; height: 50px; padding-right: 70px;">......................................,....................2024</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; width: 30%">Mengetahui<br>Administrasi Jurusan</td>
                                <td style="text-align: center; width: 40%"></td>
                                <td style="text-align: center; width: 30%">Yang Bersangkutan,<br>Mahasiswa</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="height: 100px"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; width: 30%">.........................................................</td>
                                <td style="text-align: center; width: 40%"></td>
                                <td style="text-align: center; width: 30%">.........................................................</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const printBtn = document.getElementById('print');

        printBtn.addEventListener('click', function () {
            print();
        });
    </script>
</body>
</html>