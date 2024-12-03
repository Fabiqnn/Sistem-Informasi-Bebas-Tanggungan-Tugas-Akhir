<link rel="stylesheet" href="../assets/css/style-header.css">
<header>
    <h1>
        <img src="../assets/images/logo-pbl.png" alt="logo">
        SIBETA
    </h1>
    <div class="username"> 
        <a href="edit-profile.php">
            <div class="pfp-img">

            </div>
            <h1 id="nama_pengguna">
                <?php
                    if(isset($_SESSION['nama'])) {
                        echo $_SESSION['nama'];
                    } else {
                        echo "Guest";
                    }
                ?>
            </h1>
        </a>
    </div>
</header>