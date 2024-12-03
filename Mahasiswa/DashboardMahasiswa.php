<?php
    session_start();

    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: ../index.php");
        exit();
    } 
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-mahasiwa.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Dashboard Mahasiswa</title>
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

            <div class="card-container">
                <h3>SELAMAT DATANG</h3>
                <hr id="hr-1">
                <div class="profile">
                    <div id="img-container2">
                        <img src="../assets/images/profildummy1.jpg" alt="profile picture">
                    </div>
                    <div id="credential">
                        <h4 id="h4-1">Hai' </h4> <h4 id="h4-2">Fabian Hasbillah</h4>
                        <hr id="hr-2">
                        <h5>No Induk : 2341720170</h5>
                        <h5>Jurusan  : Teknik Informatika</h5>
                        <h5>Prodi    : D4</h5>
                    </div>
                </div>

                <h3>Riwayat Permintaan</h3>
                <hr id="hr-3">
                <div class="request">
                    <button class="riwayat-btn" id="ta-btn">
                        <span>Bebas Tanggungan/TA</span>
                        <i class="lni lni-chevron-left dropdown-icon"></i>
                    </button>

                    <div class="verifikasi">
                        <p>halo</p>
                        <!-- kontainer table -->
                    </div>

                    <button class="riwayat-btn" id="prodi-btn">
                        <span>Bebas Tanggungan Prodi TI</span>
                        <i class="lni lni-chevron-left dropdown-icon"></i>
                    </button>

                    <div class="verifikasi">
                        <p>halo</p>
                         <!-- kontainer table -->
                    </div>

                    <button class="riwayat-btn" id="perpus-btn">
                        <span>Bebas Tanggungan Perpustakaan</span>
                        <i class="lni lni-chevron-left dropdown-icon"></i>
                    </button>
                        
                    <div class="verifikasi">
                        <p>halo</p>
                         <!-- kontainer table -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="footer"></div> -->

    <script src="../assets/js/script-mhs.js"></script>
</body>

</html>