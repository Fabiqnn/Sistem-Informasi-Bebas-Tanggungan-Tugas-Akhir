<?php
session_start();
if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
    header("Location: ../index.php");
    exit();
}

include '../../config/db-connect.php';

if (!empty($_POST['name-edit']) && !empty($_POST['role-edit']) && !empty($_POST['pass-edit']) && !empty($_POST['nip-edit'])) {
    $nama = $_POST['name-edit'];
    $role = $_POST['role-edit'];
    $pass = $_POST['pass-edit'];
    $nip = $_POST['nip-edit'];
    
    $querryUser = "UPDATE [USER] 
                SET ROLE = ?, 
                    PASS = ?
                WHERE ID_USER = ?;"; 
    $paramsUser = array($role, $pass, $nip);
    $resultUser = sqlsrv_query($conn, $querryUser, $paramsUser);

    $queryAdmin = "UPDATE [ADMIN]
                SET NAMA = ?
                WHERE NIP = ?";
    $paramsAdmin = array($nama, $nip);
    $reusltAdmin = sqlsrv_query($conn, $queryAdmin, $paramsAdmin);
    if (!$resultUser && !$reusltAdmin) {
        die("Terjadi Error Dengan Query". print_r(sqlsrv_errors(), true));
    } else {
        header("Location: ../../super-admin/kelola-admin.php");
        exit();
    }
    
} else {
    echo " ". $_POST['name-edit'].", " . $_POST['role-edit'].", " . $_POST['pass-edit'].", " . $_POST['nip-edit'].", ";
}

?>
