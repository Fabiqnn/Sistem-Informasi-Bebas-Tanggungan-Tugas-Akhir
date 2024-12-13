<?php
session_start();
include '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim= $_POST['nim'];
    $email = $_POST['email'];

    $sql = "SELECT * FROM MAHASISWA WHERE NIM = ? AND EMAIL_MHS = ?";
    $params = array($nim, $email);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die("Kesalahan pada query: " . print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        header("Location: ../../form-sandi.php?id=$nim");
        exit();
    } else {
        header("Location: ../../lupa-sandi.php?error=1");
        exit();
    }
}

sqlsrv_close($conn);
?>
