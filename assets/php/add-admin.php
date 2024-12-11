<?php
session_start();
include '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $nip = $_POST['nip'];
    $pass = $_POST['pass'];

    // Debugging output
    echo "Name: $name, Role: $role, NIP: $nip, Password: $pass<br>";

    // Validasi input
    if (!empty($name) && !empty($role) && !empty($nip) && !empty($pass)) {
        // Memulai transaksi
        sqlsrv_begin_transaction($conn);

        // Insert ke tabel USER
        $sqlUser = "INSERT INTO [USER] (ROLE, PASS, ID_USER) VALUES (?, ?, ?)";
        $paramsUser = array($role, $pass, $nip);
        $stmtUser = sqlsrv_prepare($conn, $sqlUser, $paramsUser);

        if (!$stmtUser || !sqlsrv_execute($stmtUser)) {
            $errors = sqlsrv_errors();
            sqlsrv_rollback($conn);
            die("Error memasukkan data ke tabel USER: " . print_r($errors, true));
        }

        // Insert ke tabel ADMIN
        $sqlAdmin = "INSERT INTO ADMIN (NAMA_ADM, NIP, ID_USER) VALUES (?, ?, ?)";
        $paramsAdmin = array($name, $nip, $nip);
        $stmtAdmin = sqlsrv_prepare($conn, $sqlAdmin, $paramsAdmin);

        if (!$stmtAdmin || !sqlsrv_execute($stmtAdmin)) {
            $errors = sqlsrv_errors();
            sqlsrv_rollback($conn);
            die("Error memasukkan data ke tabel ADMIN: " . print_r($errors, true));
        }

        // Commit transaksi
        sqlsrv_commit($conn);
        header("Location: ../../super-admin/kelola-admin.php?success=1");
        exit();
    } else {
        echo "Harap isi semua field.";
    }
} else {
    echo "Metode tidak valid.";
}

// Menutup koneksi
sqlsrv_close($conn);
?>
