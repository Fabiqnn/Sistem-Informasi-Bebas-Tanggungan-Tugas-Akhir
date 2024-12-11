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

    $queryCheck = " SELECT * FROM FORM_TA 
                    JOIN MAHASISWA ON FORM_TA.NIM = MAHASISWA.NIM
                    LEFT JOIN VERIFIKASI ON FORM_TA.ID_VERIFIKASI = VERIFIKASI.ID_VERIFIKASI";

    $result = sqlsrv_query($conn, $queryCheck);

    if (!$result) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        $data = [];
        while ($row = sqlsrv_fetch_array($result)) {
            $data[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-verif.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>SIBETA | Sistem Bebas Tanggungan | Verifikasi TA</title>
</head>
<body>
    <?php include '../include/header.php' ?>

    <div class="body">
        <?php include '../include/sidebar-adm.php';?>

        <div class="main-content">
            <?php include '../include/banner.php' ?>

            <div class="card-container">
                <h3>Verifikasi Upload Mahasiswa</h3>
                <hr class="hr-1">
                <div class="table">
                    <div class="table-header">
                        <h4>Form Bebas Tanggungan Tugas Akhir</h4>
                    </div>
                    <div class="table-content">
                        <table>
                            <tr>
                                <th>Nama Pengguna</th>
                                <th>NIM</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>Statuts Verifikasi</th>
                                <th>Cek Data</th>
                            </tr>
                            <?php
                            foreach ($data as $getData) {
                                if (empty($getData['STATUS_VERIFIKASI'])) {
                                    echo "<tr>";
                                    echo "<td>". $getData['NAMA_MHS']. "</td>";
                                    echo "<td>". $getData['NIM'] ."</td>";
                                    echo "<td>". $getData['EMAIL_MHS']. "</td>";
                                    echo "<td>". $getData['NO_WA_MHS']. "</td>";
                                    echo "<td> Belum Di Verifikasi </td>";
                                    echo "<td id='check-form'> <a href='form-verifikasi-ta.php?id=" . $getData['NIM'] ."'>Cek Data Upload Mahasiswa</a></td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-container2" id="riwayat-verif">
                <h3>Riwayat Verifikasi Upload Mahasiswa</h3>
                <hr class="hr-1">
                <div class="table2">
                    <div class="table-header">
                        <h4>Form Bebas Tanggungan Tugas Akhir</h4>
                    </div>
                    <div class="table-content">
                        <table>
                            <tr>
                                <th>Nama Pengguna</th>
                                <th>NIM</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>Status Verifikasi</th> 
                                <th>Update Data</th>
                            </tr>
                            <?php
                            foreach ($data as $getData) {
                                if (!empty($getData['STATUS_VERIFIKASI'])) {
                                    $status = $getData['STATUS_VERIFIKASI'];
                                    echo "<tr>";
                                    echo "<td>". $getData['NAMA_MHS']. "</td>";
                                    echo "<td>". $getData['NIM'] ."</td>";
                                    echo "<td>". $getData['EMAIL_MHS']. "</td>";
                                    echo "<td>". $getData['NO_WA_MHS']. "</td>";
                                    if ($status === "Disetujui") {
                                        echo "<td> <p id='setuju'>". $status. "</p></td>";
                                    } else {
                                        echo "<td> <p id='tolak'>". $status. "</p></td>";
                                    }
                                    echo "<td id='check-form'> <a href='form-update-verifikasi-ta.php?id=" . $getData['NIM'] ."'>Update Verifikasi Mahasiswa</a></td>";
                                    echo "</tr>";
                                } else {
                                    echo "Tidak ada sayang";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>
</html>