<link rel="stylesheet" href="../assets/css/style-header.css">

<?php 
    $editProfileLink = "error";
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] === "mahasiswa") {
            $editProfileLink = "../Mahasiswa/edit-profile-mhs.php";
        } else {
            $editProfileLink = "/kokam";
        }
    }
?>

<header>
    <h1>
        <div class="logo">
            <img src="../assets/images/Logo Fiks.png" alt="logo">
        </div>
        SIBETA
    </h1>
    <div class="username"> 
        <a href="<?= $editProfileLink ?>">
            <div class="pfp-img">
                <?php 
                    include '../include/profile-picture.php';
                ?>
            </div>
            <h1 id="nama_pengguna">
                <?php
                    if(isset($_SESSION['nama'])) {
                        echo $_SESSION['nama'];
                    }
                ?>
            </h1>
        </a>
    </div>
</header>