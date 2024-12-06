<link rel="stylesheet" href="../assets/css/style-header.css">
<header>
    <h1>
        <img src="../assets/images/logo-pbl.png" alt="logo">
        SIBETA
    </h1>
    <div class="username"> 
        <a href="edit-profile.php">
            <div class="pfp-img">
                <?php 
                    if (isset($_SESSION['profil'])) {
                        ?> <img src="<?php $_SESSION['profil']; ?>" alt="profile picture"><?php
                    } else {
                       ?> <img src="../assets/images/profildummy1.jpg" alt=""><?php 
                    }
                    
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