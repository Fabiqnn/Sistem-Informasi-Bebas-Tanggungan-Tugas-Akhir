<?php
session_start();
include '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $nip = $_POST['nip'];
    $pass = $_POST['pass'];

    if (empty($nama) || empty($role) || empty($nip) || empty($pass)) {
        sqlsrv_begin_transaction($conn);
    }

    $sqlAdmin = "INSERT INTO ADMIN (NAMA, NIP) VALUES (?, ?)";
    $paramsAdmin = array($name, $nip);
    $stmtAdmin = sqlsrv_query($conn, $sqlAdmin, $paramsAdmin);

    if ($stmtAdmin === false) {
        sqlsrv_rollback($conn);
        die("Error memasukkan data ke tabel admin: " . print_r(sqlsrv_errors(), true));
    }

    $sqlUser = "INSERT INTO [USER] (JABATAN, PASSWORD, NIP) VALUES (?, ?, ?)";
    $paramsUser = array($role, $pass, $nip); 
    $stmtUser = sqlsrv_query($conn, $sqlUser, $paramsUser);
   
    if ($stmtUser === false) {
        sqlsrv_rollback($conn);
        die("Error memasukkan data ke tabel user: " . print_r(sqlsrv_errors(), true));
    }
    
    sqlsrv_commit($conn);
    header("Location: ../../super-admin/super-admin-dashboard.php?success=1");
    exit();
    } else {
    echo "Harap isi semua field.";
}   
sqlsrv_close($conn)
?>