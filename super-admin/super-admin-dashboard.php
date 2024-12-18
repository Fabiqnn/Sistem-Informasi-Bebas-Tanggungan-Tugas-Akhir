<?php
    session_start();

    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: ../index.php");
        exit();
    } 

    if ($_SESSION['role'] !== 'Super Admin') {
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style-super-adm.css" type="text/css">
    <title>Dashboard Admin</title>
</head>
<body>
    <?php 
        include '../include/header.php';
    ?>
    
    <div class="body">
        <?php include '../include/sidebar-super-adm.php'?>

        <div class="main-content">
            <?php include '../include/banner.php'; ?>

            <div class="card-container">
                <h3>SELAMAT DATANG</h3>
                <hr id="hr-1">
                <div class="profile">
                    <div id="img-container2">
                        <?php include '../include/profile-picture.php' ?>
                    </div>
                    <div id="credential">
                        <h4 id="h4-1">Hai' </h4> <h4 id="h4-2"><?php if (isset($_SESSION['nama'])) {
                            echo $_SESSION['nama'];
                        }?></h4>
                        <hr id="hr-2">
                        <div class="sub-credential">
                            <h5>NIP : </h5>
                            <p><?= $_SESSION['noInduk']?></p>
                        </div>
                        <div class="sub-credential">
                            <h5>Jabatan : </h5>
                            <p><?= $_SESSION['role']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/script-super-adm.js"></script>
</body>
</html>