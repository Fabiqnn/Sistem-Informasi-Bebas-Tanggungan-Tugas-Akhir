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

    include '../config/db-connect.php';

    $noInduk = $_SESSION['noInduk'];
    $queryTable = "SELECT 
                [USER].ID_USER, 
                [USER].PASS, 
                [USER].ROLE, 
                ADMIN.NIP, 
                ADMIN.NAMA_ADM
            FROM [USER]JOIN [ADMIN] ON [USER].ID_USER = ADMIN.ID_USER";
    
    $resultTable = sqlsrv_query($conn, $queryTable);

    if (!$resultTable) {
        die("Query gagal: " . print_r(sqlsrv_errors(), true));;
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
    <link rel="stylesheet" href="../assets/css/style-kelola-adm.css" type="text/css">
    <title>Kelola Admin</title>
</head>
<body>
    <?php include '../include/header.php';?>

    <div class="body">
        <?php include '../include/sidebar-super-adm.php';?>
        
        <div class="main-content">
            <?php include '../include/banner.php' ?>

            <div class="card-container">
                <h3>SELAMAT DATANG</h3>
                <h4 id="uname"><?=$_SESSION['nama']?></h4>
                <hr id="hr-1">

                <div class="table">
                    <div class="table-header">
                        <h4>Kelola Admin</h4>
                    </div>
                    <div class="table-content">
                        <button data-bs-toggle="modal" data-bs-target="#add-admin-modal">
                            <i class="lni lni-plus"></i>
                            Add Admin User
                        </button>
                        <div class="table-table">
                            <table>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>NIP</th>
                                    <th>Kata Sandi</th>
                                    <th>update</th>
                                    <th>Delete</th>
                                </tr>
                                <?php
                                    while ($rowTable = sqlsrv_fetch_array($resultTable, SQLSRV_FETCH_ASSOC)) {
                                        echo "<tr>";
                                            echo "<td>" . $rowTable['NAMA_ADM'] . "</td>";
                                            echo "<td>" . $rowTable['ROLE'] . "</td>";
                                            echo "<td>" . $rowTable['NIP'] . "</td>";
                                            echo "<td>******</td>"; 
                                            echo "<td class='update-col'><a 
                                                href='#' 
                                                class='update-btn' 
                                                data-bs-toggle='modal' 
                                                data-bs-target='#edit-admin-modal'
                                                data-nama = '".$rowTable['NAMA_ADM']."'
                                                data-nip = '".$rowTable['NIP']."'
                                                data-pass = '".$rowTable['PASS']."' >Perbarui</a></td>";
                                            echo "<td class='delete-col'><a href='../assets/php/delete-admin.php?delete_id=" . $rowTable['ID_USER'] . "' class='delete-btn' onclick='return confirm(\"Apakah anda yakin untuk menghapus user berikut?\")'>Hapus</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <form action="../assets/php/add-admin.php" method="post" id="form-add-admin">
        <div class="modal fade" id="add-admin-modal" tabindex="-1" aria-labelledby="add-admin-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-admin-modalLabel">Tambah Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="role">Posisi/Jabatan</label>
                            <select name="role" id="role">
                                <option value="adm_lt7">Admin TA</option>
                                <option value="adm_prodi">Admin Prodi</option>
                                <option value="adm_pustaka">Admin Pustaka</option>
                                <option value="super_adm">Super Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" id="nip">
                        </div>
                        <div class="form-group">
                            <label for="pass">Kata Sandi</label>
                            <input type="pass" name="pass" id="pass">
                        </div>
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

    <!-- Modal edit-->
    <form action="../assets/php/edit-admin.php" method="post" id="form-edit-admin">
        <div class="modal fade" id="edit-admin-modal" tabindex="-1" aria-labelledby="edit-admin-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-admin-modalLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <label for="name-edit">Nama</label>
                            <input type="text" name="name-edit" id="name-edit">
                        </div>
                        <div class="form-group">
                            <label for="role-edit">Posisi/Jabatan</label>
                            <select name="role-edit" id="role-edit">
                                <option value="adm_lt7">Admin TA</option>
                                <option value="adm_prodi">Admin Prodi</option>
                                <option value="adm_pustaka">Admin Pustaka</option>
                                <option value="super_adm">Super Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pass-edit">Kata Sandi</label>
                            <input type="pass" name="pass-edit" id="pass-edit">
                        </div>
                        <input type="hidden" name="nip-edit" id="nip-edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
                </div>
            </div>
        </div>
    </form>

    <script src="../assets/js/script-kelola-adm.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>