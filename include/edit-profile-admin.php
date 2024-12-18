<?php 
    session_start();

    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: ../index.php");
        exit();
    } 

    include '../config/db-connect.php';

    $query = "SELECT 
                NAMA_ADM,
                NO_WA_ADM,
                EMAIL_ADM
                FROM [ADMIN]
                WHERE NIP = ?";
    $params = array($_SESSION['noInduk']);
    $result = sqlsrv_query($conn, $query, $params);

    if (!$result) {
        die("Query Data Gagal " . print_r(sqlsrv_errors(), true));
    } else {
        $getData = sqlsrv_fetch_array($result);
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
        <?php 
            if ($_SESSION['role'] === 'Super Admin') {
                include '../include/sidebar-super-adm.php';
            } else {
                include '../include/sidebar-adm.php';
            }
        ?>

        <div class="main-content">
            <?php include '../include/banner.php' ?>
            <div class="card-container">
                <h3>SELAMAT DATANG</h3>
                <hr id="hr-1">
                <div class="card-data">
                    <div class="profile-img">
                        <?php
                            include '../include/profile-picture.php';
                        ?>
                    </div>
                    <div class="credential">
                        <div class="label">
                            <h5>Nama</h5>
                            <h5>No. Whatsapp</h5>
                            <h5>Email</h5>
                        </div>
                        <div class="titik-dua">
                            <h5>:</h5>
                            <h5>:</h5>
                            <h5>:</h5>
                        </div>
                        <div class="data">
                            <p><?= $_SESSION['nama'] ?></p>
                            <p><?= $_SESSION['noTelp'] ?></p>
                            <p><?= $_SESSION['email'] ?></p>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <button id="foto-btn" data-bs-toggle="modal" data-bs-target="#tambahFoto">Ubah Foto</button>
                <button id="profil" data-bs-toggle="modal" data-bs-target="#editProfile">Ubah Profile</button>
            </div>
            <hr>
        </div>
    </div>

    <!-- Modal unggah foto -->
    <form action="../assets/php/edit-profile-adm.php?type=1" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="tambahFoto" tabindex="-1" aria-labelledby="tambahFotoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahFotoLabel">Ganti Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="profile-img">
                    <img src="<?= $pfp ?>" alt="profil picture" id="foto-upload">;
                </div>
                <div class="upload-img">
                    <label for="foto">Unggah Foto</label>
                    <input type="file" name="foto" id="foto" accept="image/jpeg, image/png">
                    <span id="foto-name">No File Choosen.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
            </div>
            </div>
        </div>
        </div>
    </form>

    <!-- Modal edit profile-->
    <form action="../assets/php/edit-profile-adm.php?type=2" method="post" enctype="multipart/form-data">
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
                    <input type="text" name="nama" id="nama" value="<?= $getData['NAMA_ADM'] ?>">
                </div>

                <div class="input-form">
                    <label for="no-wa">No Whatsapp</label>
                    <input type="text" name="no-wa" id="no-wa" value="<?= $getData['NO_WA_ADM'] ?>">
                </div>

                <div class="input-form">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= $getData['EMAIL_ADM'] ?>">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-simpan">Simpan Perubahan</button>
            </div>
            </div>
        </div>
        </div>
    </form>
    
    <script>
        const inputFoto = document.getElementById('foto');

        inputFoto.addEventListener('change', function() {
            const sizeFile = (this.files[0].size / 1024 / 1024).toFixed(2);
            if (sizeFile > 5) {
                document.getElementById('foto-name').innerHTML = "Foto Tidak Lebih Dari 5 Mb";
                document.getElementById('foto-name').classList = "err";
                inputFoto.value = "";
            } else if (inputFoto.value) {
                document.getElementById('foto-name').classList.remove('err');
                document.getElementById('foto-upload').src = URL.createObjectURL(inputFoto.files[0]);
                document.getElementById('foto-name').innerHTML = inputFoto.files[0].name;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>