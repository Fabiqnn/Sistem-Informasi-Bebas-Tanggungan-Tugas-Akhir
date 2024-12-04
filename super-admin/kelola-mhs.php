<?php
    session_start();

    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: ../index.php");
        exit();
    } 

    if ($_SESSION['role'] !== 'super_adm') {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style-kelola-mhs.css" type="text/css">
    <title>Kelola Mahasiswa</title> 
</head>
<body>
    <?php include '../include/header.php'; ?>

    <div class="body">
        <?php include '../include/sidebar-super-adm.php'; ?>

        <div class="main-content">
            <?php include '../include/banner.php'?>

            <div class="card-container">
                <h3>SELAMAT DATANG</h3>
                <h4 id="uname">Nama Pengguna</h4>
                <hr id="hr-1">

                <div class="table">
                    <div class="table-header">
                        <h4>Kelola Mahasiswa</h4>
                    </div>
                    <div class="table-content">
                        <button data-bs-toggle="modal" data-bs-target="#add-mhs-modal">
                            <i class="lni lni-plus"></i>
                            Add Mahasiswa User
                        </button>
                        <table>
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Kata Sandi</th>
                                <th>update</th>
                                <th>Delete</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <form action="" method="post" id="form-add-mhs">
        <div class="modal fade" id="add-mhs-modal" tabindex="-1" aria-labelledby="add-mhs-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-mhs-modalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="form">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="angkatan">Angkatan</label>
                        <input type="text" name="angkatan" id="angkatan">
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" id="nim">
                    </div>
                    <div class="form-group">
                        <label for="pass">Kata Sandi</label>
                        <input type="pass" name="pass" id="pass">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <script src="../assets/js/script-kelola-mhs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>