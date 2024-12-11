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

    <title>SIBETA | Sistem Bebas Tanggungan | Verifikasi Pustaka</title>
</head>
<body>
<?php include '../include/header.php' ?>

<div class="body">
    <?php include '../include/sidebar-adm.php';?>

    <div class="main-content">
        <?php include '../include/banner.php' ?>

        <div class="card-container">
            <h3>Verifikasi Upload Mahasiswa</h3>
            <hr id="hr-1">
            <div class="table">
                <div class="table-header">
                    <h4>Form Bebas Tanggungan Prodi</h4>
                </div>
                <div class="table-content">
                    <table>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Cek Data</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>