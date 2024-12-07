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

    include '../config/db-connect.php';
    $query = "SELECT 
                  [USER].ID_USER, 
                  [USER].PASS, 
                  [USER].ROLE, 
                  [ADMIN].NIP, 
                  [ADMIN].NAMA
              FROM [USER]
              JOIN [ADMIN] ON [USER].ID_USER = [ADMIN].ID_USER";
    
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
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
                <h4 id="uname">Nama Pengguna</h4>
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
                                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['NAMA'] . "</td>";
                                    echo "<td>" . $row['ROLE'] . "</td>";
                                    echo "<td>" . $row['NIP'] . "</td>";
                                    echo "<td>******</td>"; 
                                    echo "<td><a href='edit_admin.php?id=" . $row['ID_USER'] . "' class='btn btn-warning'>Update</a></td>";
                                    echo "<td><a href='kelola_admin.php?delete_id=" . $row['ID_USER'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                                    echo "</tr>";
                                
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <form action="add_admin.php" method="post" id="form-add-admin">
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
                            <input type="text" name="role" id="role">
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

    <script src="../assets/js/script-kelola-adm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>