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

    include '../config/db-connect.php';

    $queryTa = "SELECT 
                    [ADMIN].NAMA_ADM, 
                    [ADMIN].EMAIL_ADM, 
                    [ADMIN].NO_WA_ADM, 
                    [USER].[ROLE], 
                    VERIFIKASI.STATUS_VERIFIKASI, 
                    VERIFIKASI.catatan 
                FROM VERIFIKASI
                JOIN FORM_TA ON FORM_TA.ID_VERIFIKASI = VERIFIKASI.ID_VERIFIKASI
                JOIN [ADMIN] ON VERIFIKASI.NIP = [ADMIN].NIP
                JOIN [USER] on [ADMIN].ID_USER = [USER].ID_USER
                WHERE FORM_TA.NIM = ?";
    $queryProdi = "SELECT 
                    [ADMIN].NAMA_ADM, 
                    [ADMIN].EMAIL_ADM, 
                    [ADMIN].NO_WA_ADM, 
                    [USER].[ROLE], 
                    VERIFIKASI.STATUS_VERIFIKASI, 
                    VERIFIKASI.catatan 
                FROM VERIFIKASI
                JOIN FORM_PRODI ON FORM_PRODI.ID_VERIFIKASI = VERIFIKASI.ID_VERIFIKASI
                JOIN [ADMIN] ON VERIFIKASI.NIP = [ADMIN].NIP
                JOIN [USER] on [ADMIN].ID_USER = [USER].ID_USER
                WHERE FORM_PRODI.NIM = ?";
    $queryPustaka = "SELECT 
                    [ADMIN].NAMA_ADM, 
                    [ADMIN].EMAIL_ADM, 
                    [ADMIN].NO_WA_ADM, 
                    [USER].[ROLE], 
                    VERIFIKASI.STATUS_VERIFIKASI, 
                    VERIFIKASI.catatan 
                FROM VERIFIKASI
                JOIN FORM_PUSTAKA ON FORM_PUSTAKA.ID_VERIFIKASI = VERIFIKASI.ID_VERIFIKASI
                JOIN [ADMIN] ON VERIFIKASI.NIP = [ADMIN].NIP
                JOIN [USER] on [ADMIN].ID_USER = [USER].ID_USER
                WHERE FORM_PUSTAKA.NIM = ?";

    $params = array($_SESSION['noInduk']);

    $resultTa = sqlsrv_query($conn, $queryTa, $params);
    $resultProdi = sqlsrv_query($conn, $queryProdi, $params);
    $resultPustaka = sqlsrv_query($conn, $queryPustaka, $params);

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
                        <?php include '../include/profile-picture.php' ?>
                    </div>
                    <div id="credential">
                        <h4 id="h4-1">Hai' </h4> <h4 id="h4-2"><?php if (isset($_SESSION['nama'])) {
                            echo $_SESSION['nama'];
                        } ?></h4>
                        <hr id="hr-2">
                        <div class="sub-credential">
                            <h5>NIM : </h5> 
                            <h5 class="credential-value"><?php if (isset($_SESSION['noInduk'])) {
                                echo $_SESSION['noInduk'];
                            }?></h5>
                        </div>
                        <div class="sub-credential">
                            <h5>Prodi : </h5> 
                            <h5 class="credential-value"><?php if (isset($_SESSION['prodi'])) {
                                echo $_SESSION['prodi'];
                            }?></h5>
                        </div>
                        <div class="sub-credential">
                            <h5>Angkatan : </h5> 
                            <h5 class="credential-value"><?php if (isset($_SESSION['angkatan'])) {
                                echo $_SESSION['angkatan'];
                            } ?></h5>
                        </div>
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
                        <div class="table-container">
                            <table>
                                <tr>
                                    <th>Nama Admin</th>
                                    <th>Email</th>
                                    <th>No Wa</th>
                                    <th>Jabatan</th>
                                    <th>Status Verifikasi</th>
                                    <th>Catatan</th>
                                    <th>Update</th>
                                </tr>
                                <tr>
                                    <?php
                                        if ($resultTa) {
                                            $row = sqlsrv_fetch_array($resultTa);
                                            if (isset($row)) {
                                                echo "<td>" . $row['NAMA_ADM']. "</td>";
                                                echo "<td>" . $row['EMAIL_ADM'] . "</td>";
                                                echo "<td>" . $row['NO_WA_ADM'] . "</td>";
                                                echo "<td>" . $row['ROLE'] . "</td>";
                                                echo "<td>" . $row['STATUS_VERIFIKASI'] . "</td>";
                                                echo "<td>" . $row['catatan'] . "</td>";
                                                if ($row['STATUS_VERIFIKASI'] === 'Ditolak') {
                                                    echo "<td><a class='perbarui-btn' href='form-edit-ta.php?adm=1'>Perbarui</a></td>";
                                                } else {
                                                    echo "<td><a class='perbarui-disabled'>Perbarui</a>";
                                                }
                                                
                                            }
                                        }
                                    ?>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <button class="riwayat-btn" id="prodi-btn">
                        <span>Bebas Tanggungan Prodi TI</span>
                        <i class="lni lni-chevron-left dropdown-icon"></i>
                    </button>

                    <div class="verifikasi">
                        <div class="table-container">
                            <table>
                                <tr>
                                    <th>Nama Admin</th>
                                    <th>Email</th>
                                    <th>No Wa</th>
                                    <th>Jabatan</th>
                                    <th>Status Verifikasi</th>
                                    <th>Catatan</th>
                                    <th>Update</th>
                                </tr>
                                <tr>
                                <?php
                                    if ($resultProdi) {
                                        $row = sqlsrv_fetch_array($resultProdi);
                                        if (isset($row)) {
                                            echo "<td>" . $row['NAMA_ADM']. "</td>";
                                            echo "<td>" . $row['EMAIL_ADM'] . "</td>";
                                            echo "<td>" . $row['NO_WA_ADM'] . "</td>";
                                            echo "<td>" . $row['ROLE'] . "</td>";
                                            echo "<td>" . $row['STATUS_VERIFIKASI'] . "</td>";
                                            echo "<td>" . $row['catatan'] . "</td>";
                                            if ($row['STATUS_VERIFIKASI'] === 'Ditolak') {
                                                echo "<td><a class='perbarui-btn' href='form-edit-prodi.php?adm=2' >Perbarui</a></td>";
                                            } else {
                                                echo "<td><a class='perbarui-disabled'>Perbarui</a></td>";
                                            }
                                            
                                        }
                                    }
                                ?>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <button class="riwayat-btn" id="perpus-btn">
                        <span>Bebas Tanggungan Perpustakaan</span>
                        <i class="lni lni-chevron-left dropdown-icon"></i>
                    </button>
                        
                    <div class="verifikasi">
                        <div class="table-container">
                            <table>
                                <tr>
                                    <th>Nama Admin</th>
                                    <th>Email</th>
                                    <th>No Wa</th>
                                    <th>Jabatan</th>
                                    <th>Status Verifikasi</th>
                                    <th>Catatan</th>
                                    <th>Update</th>
                                </tr>
                                <tr>
                                <?php
                                    if ($resultPustaka) {
                                        $row = sqlsrv_fetch_array($resultPustaka);
                                        if (isset($row)) {
                                            echo "<td>" . $row['NAMA_ADM']. "</td>";
                                            echo "<td>" . $row['EMAIL_ADM'] . "</td>";
                                            echo "<td>" . $row['NO_WA_ADM'] . "</td>";
                                            echo "<td>" . $row['ROLE'] . "</td>";
                                            echo "<td>" . $row['STATUS_VERIFIKASI'] . "</td>";
                                            echo "<td>" . $row['catatan'] . "</td>";
                                            if ($row['STATUS_VERIFIKASI'] === 'Ditolak') {
                                                echo "<td><a class='perbarui-btn' href='form-edit-pustaka.php?adm=3'>Perbarui</a></td>";
                                            } else {
                                                echo "<td><a class='perbarui-disabled'>Perbarui</a></td>";
                                            }
                                        }
                                    }
                                ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="footer"></div> -->

    <script src="../assets/js/script-mhs.js"></script>
</body>

</html>