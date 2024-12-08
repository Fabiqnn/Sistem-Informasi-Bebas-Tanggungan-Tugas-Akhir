<?php
session_start();
if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
    header("Location: ../index.php");
    exit();
}

include '../../config/db-connect.php';

if (!empty($_POST['name-edit']) && !empty($_POST['angkatan-edit']) && !empty($_POST['pass-edit']) && !empty($_POST['nim-edit']) && !empty($_POST['prodi-edit'])) {
    $nama = $_POST['name-edit'];
    $angkatan = $_POST['angkatan-edit'];
    $pass = $_POST['pass-edit'];
    $nim = $_POST['nim-edit'];
    $prodi = $_POST['prodi-edit'];

    $querryUser = "UPDATE [USER] 
                SET PASS = ?
                WHERE ID_USER = ?;"; 
    $paramsUser = array($pass, $nim);
    $resultUser = sqlsrv_query($conn, $querryUser, $paramsUser);

    $queryMhs = "UPDATE [MAHASISWA]
                SET NAMA_MHS = ?,
                    ANGKATAN = ?,
                    PRODI = ?
                WHERE NIM = ?";
    $paramsMhs = array($nama, $angkatan, $prodi, $nim);
    $resultMhs = sqlsrv_query($conn, $queryMhs, $paramsMhs);
    if (!$resultUser && !$resultMhs) {
        die("Terjadi Error Dengan Query". print_r(sqlsrv_errors(), true));
    } else {
        header("Location: ../../super-admin/kelola-mhs.php");
        exit();
    }
    
} else {
    echo " ". $_POST['name-edit'].", " . $_POST['angkatan-edit'].", " . $_POST['pass-edit'].", " . $_POST['nim-edit'].", ".  $_POST['prodi-edit'].", ";
}

?>
