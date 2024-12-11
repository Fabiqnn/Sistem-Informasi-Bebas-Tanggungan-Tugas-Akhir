<?php
    session_start();

    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: ../index.php");
        exit();
    } 

    if ($_SESSION['role'] !== 'Admin Pustaka') {
        header("Location: ../index.php");
        exit();
    }

    include '../config/db-connect.php';

    if (isset($_GET['id'])) {
        $idMhs = $_GET['id'];

        $queryCheck = " SELECT * FROM FORM_PUSTAKA 
                        JOIN MAHASISWA ON FORM_PUSTAKA.NIM = MAHASISWA.NIM
                        WHERE FORM_PUSTAKA.NIM = ?";
        $params = array($idMhs);
        $result = sqlsrv_query($conn, $queryCheck, $params);

        if ($result) {
            $getData = sqlsrv_fetch_array($result);
            $tglUjian = $getData['TANGGAL_UJIAN_SKRIPSI']->format('Y-m-d');
            $tglYudisium = $getData['TANGGAL_YUDISIUM']->format('Y-m-d');
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
    <style>
        .subjudul {
            background-color: #FEB74B;
            color: black;
            text-align: center;
            padding: 8px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .3);
            margin: 30px 0;    
        }
        
        .download {
            background-color: rgb(255, 255, 255);
            padding: 8px 8px 8px 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            height: max-content;
            display: grid;
            line-height: 1.5;
            margin-top: 10px;
        }

        .download h6, .form-container h6 {
            font-size: 20px;
            font-weight: 500;
        }

        .download p {
            font-size: 16px;
            font-weight: 400;
        }

        .download .last {
            margin-bottom: 10px;
        }

        .download .download-btn {
            margin: 0;
        }

        .download-file {
            display: flex;
            gap: 10px;
            align-items: center;
            margin: 5px 0 5px 0;
        }

        .download-file span {
            font-weight: 400;
            font-size: 15px;
        }

        input[type="file"] {
            display: none;
        }

    </style>
    <title>SIBETA | Sistem Bebas Tanggungan | Form Verifikasi</title>
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
                    <h4>Formulir Tanggungan Pustaka</h4>

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

                    <!-- data upload mahasiswa -->
                    <label>Jenis Karya Ilmiah</label>
                    <div class="box">
                        <h5><?= $getData['JENIS_KARYA']?></h5>
                    </div>

                    <label>Judul Karya Ilmiah (Laporan Akhir)</label>
                    <div class="box">
                        <h5><?= $getData['JUDUL_KARYA_ILMIAH']?></h5>
                    </div>

                    <label>Tahun Karya Ilmiah Akhir Terbit (Laporan Akhir)</label>
                    <div class="box">
                        <h5><?= $getData['TAHUN_KARYA_ILMIAH']?></h5>
                    </div>

                    <label>Tanggal, Bulan, Tahun Ujian Tugas Akhir / Skripsi</label>
                    <div class="box">
                        <h5><?= $tglUjian?></h5>
                    </div>

                    <label>Tanggal, Bulan, Tahun Yudisium</label>
                    <div class="box">
                        <h5><?= $tglYudisium?></h5>
                    </div>

                    <label>Bukti Bebas Kompen</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['FILE_BEBAS_KOMPEN']?>">Download</a>
                        <span id="kompen-name"><?= $getData['FILE_BEBAS_KOMPEN'];?></span>
                    </div>

                    <p class="subjudul">Upload File SoftCopy Laporan Akhir</p>

                    
                    <label>Pendahuluan ( Digabung Menjadi 1 File PDF )</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['FILE_PENDAHULUAN']?>">Download</a>
                        <span id="pendahuluan-name"><?= $getData['FILE_PENDAHULUAN'];?></span>
                    </div>
                
                    <label>ABSTRAK ( Indonesia - Inggris digabung 1 File PDF / DOC )</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['FILE_ABSTRAK']?>">Download</a>
                        <span id="abstrak-name"><?= $getData['FILE_ABSTRAK'];?></span>
                    </div>
                
                    <label>ISI LAPORAN BAB I - PDF</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['BAB_1']?>">Download</a>
                        <span id="bab1-name"><?= $getData['BAB_1'];?></span>
                    </div>
                
                    <label>ISI LAPORAN BAB II - PDF</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['BAB_2']?>">Download</a>
                        <span id="bab2-name"><?= $getData['BAB_2'];?></span>
                    </div>
                
                    <label>ISI LAPORAN BAB III - PDF</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['BAB_3']?>">Download</a>
                        <span id="bab3-name"><?= $getData['BAB_3'];?></span>
                    </div>
                
                    <label>ISI LAPORAN BAB IV - PDF</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['BAB_4']?>">Download</a>
                        <span id="bab4-name"><?= $getData['BAB_4'];?></span>
                    </div>
                
                    <label>ISI LAPORAN BAB V - PDF</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['BAB_5']?>">Download</a>
                        <span id="bab5-name"><?= $getData['BAB_5'];?></span>
                    </div>
                
                    <label>ISI LAPORAN BAB VI - PDF</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['BAB_6']?>">Download</a>
                        <span id="bab6-name"><?= $getData['BAB_6'];?></span>
                    </div>
                
                    <label>ISI LAPORAN BAB VII - PDF</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['BAB_7']?>">Download</a>
                        <span id="bab7-name"><?= $getData['BAB_7'];?></span>
                    </div>
                
                    <label>DAFTAR PUSTAKA - PDF</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['FILE_DAFTAR_PUSTAKA']?>">Download</a>
                        <span id="pustaka-name"><?= $getData['FILE_DAFTAR_PUSTAKA'];?></span>
                    </div>

                
                    <label>LAMPIRAN - ( PDF/DOC )</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['FILE_LAMPIRAN']?>">Download</a>
                        <span id="lampiran-name"><?= $getData['FILE_LAMPIRAN'];?></span>
                    </div>

                
                    <label>KOMPILASI LAPORAN AKHIR ( 1 FILE PENUH PDF )</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['FILE_KOMPILASI_LAPORAN_AKHIR']?>">Download</a>
                        <span id="kompilasi-name"><?= $getData['FILE_KOMPILASI_LAPORAN_AKHIR'];?></span>
                    </div>

                    <label>LINK PUBLIKASI JURNAL</label>
                    <div class="box">
                        <h5><?= $getData['LINK_JURNAL'] ?></h5>
                    </div>

                    <label>SOFTCOPY JURNAL</label>
                    <div class="download-btn">
                        <a href="../assets/php/download-handler.php?file=<?= $getData['FILE_SOFTCOPY_JURNAL']?>">Download</a>
                        <span id="jurnal-name"><?= $getData['FILE_SOFTCOPY_JURNAL'];?></span>
                    </div>

                    <label>Izin Mengolah Laporan Akhir</label>
                    <div class="box">
                        <h5><?= $getData['IZIN_MENGOLAH'] ?></h5>
                    </div>

                    <label>Hard Copy Laporan Akhir/ Skripsi/ Tesis</label>
                    <div class="box">
                        <h5><?= $getData['PENYERAHAN_SKRIPSI'] ?></h5>
                    </div>

                    
                        <label>Bukti Resi Hard Copy Laporan Akhir/ Skripsi / Tesis</label>
                        <div class="download-btn">
                            <a href="../assets/php/download-handler.php?file=<?= $getData['RESI_PENGIRIMAN_SKRIPSI'] ?>">Download</a>
                            <span id="resi-name"><?= $getData['RESI_PENGIRIMAN_SKRIPSI'] ;?></span>
                        </div>

                    <hr>
                    <!-- form verifikasi -->
                    <form action="../assets/php/verifikasi-adm.php?id=<?= $idMhs?>" method="post">
                        <div class="form-verif">
                            <div class="input">
                                <label for="catatan">Catatan Untuk Mahasiswa</label>
                                <input type="text" name="catatan" id="catatan">
                            </div>
                            <div class="status-verifikasi">
                                <button type="submit" name="status" value="Disetujui" id="setuju">Setuju</button>
                                <button type="submit" name="status" value="Ditolak" id="tolak">Tolak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const btnSetuju = document.getElementById('setuju');
        const btnTolak = document.getElementById('tolak');

        btnSetuju.addEventListener("click", function (event) {

            if (confirm("Apakah Anda yakin ingin menyetujui?")) {
                const form = event.target.closest("form");
                if (form) {
                    form.submit();
                }
            } else {
                event.preventDefault();
            }
        });

        btnTolak.addEventListener("click", function (event) {

            if (confirm("Apakah Anda yakin ingin menolak?")) {
                const form = event.target.closest("form");
                if (form) {
                    form.submit(); 
                }
            } else {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>