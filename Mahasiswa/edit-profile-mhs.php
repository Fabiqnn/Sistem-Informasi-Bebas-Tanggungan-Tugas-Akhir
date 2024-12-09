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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-edit-profile-mhs.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>SIBETA | Sistem Bebas Tanggungan | Edit Profil</title>
</head>
<body>
    <?php include '../include/header.php' ?>

    <div class="body">
        <?php include '../include/sidebar.php' ?>

        <div class="main-content">
            <?php include '../include/banner.php' ?>

            
            <div class="card-container">
                <h3>SELAMAT DATANG</h3>
                <hr id="hr-1">
                <div class="card-data">
                    <div class="profile-img">
                        <img src="../assets/images/profildummy1.jpg" alt="profile picture">
                    </div>
                    <div class="credential">
                        <div class="credential-info">
                            <h4>Nama : </h4>
                            <p><?= $_SESSION['nama'] ?></p>
                        </div>
                        <div class="credential-info">
                            <h4>NIM : </h4>
                            <p><?= $_SESSION['noInduk'] ?></p>
                        </div>
                        <div class="credential-info">
                            <h4>No. Whatsapp : </h4>
                            <p><?= $_SESSION['noTelp'] ?></p>
                        </div>
                        <div class="credential-info">
                            <h4>Email : </h4>
                            <p><?= $_SESSION['email'] ?></p>
                        </div>
                        <div class="credential-info">
                            <h4>Prodi : </h4>
                            <p><?= $_SESSION['prodi'] ?></p>
                        </div>
                        <div class="credential-info">
                            <h4>Angkatan : </h4>
                            <p><?= $_SESSION['angkatan'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="button-container">
                    <button id="foto-btn" data-bs-toggle="modal" data-bs-target="#tambahFoto">Ubah Foto</button>
                    <button id="profil" data-bs-toggle="modal" data-bs-target="#editProfile">Ubah Profile</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="tambahFoto" tabindex="-1" aria-labelledby="tambahFotoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahFotoLabel">Ganti Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="profile-img">
                    <img src="../assets/images/profildummy1.jpg" alt="">
                </div>
                <div class="upload-img">
                    <label for="foto">Unggah Foto</label>
                    <input type="file" name="foto" id="foto">
                    <span id="foto-name">No File Choosen.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </div>
        </div>
        </div>
    </form>

    <!-- Modal edit profile-->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-form">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama">
                </div>

                <div class="input-form">
                    <label for="nim">NIM</label>
                    <input type="text" name="nim" id="nim"> 
                </div>

                <div class="input-form">
                    <label for="no-wa">No Whatsapp</label>
                    <input type="text" name="no-wa" id="no-wa">
                </div>

                <div class="input-form">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>

                <div class="input-form">
                    <label for="prodi">Prodi</label>
                    <select name="prodi" id="prodi">
                        <option value="D4 Sistem Informasi Bisnis (D4-SIB)">D4 Sistem Informasi Bisnis (D4-SIB)</option>
                        <option value="D2 Pengembangan Perangkat (Piranti) Lunak Situs (D2-PPLS)">D2 Pengembangan Perangkat (Piranti) Lunak Situs (D2-PPLS)</option>
                        <option value="D4 Teknik Informatika (D4-TI)">D4 Teknik Informatika (D4-TI)</option>
                    </select>
                </div>

                <div class="input-form">
                    <label for="angkatan">Angkatan</label>
                    <input type="text" name="angkatan" id="angkatan">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>