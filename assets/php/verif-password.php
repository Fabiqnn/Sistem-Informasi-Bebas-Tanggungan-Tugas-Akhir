<?php
session_start();
include '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['noInduk'];
    $new_password = $_POST['pass'];
    $confirm_password = $_POST['pass-confirm'];

    if ($new_password === $confirm_password) {

        $sql = "UPDATE [USER] SET PASS = ? WHERE ID_USER = ?";
        $params = array($new_password, $id_user);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die("Kesalahan pada query: " . print_r(sqlsrv_errors(), true));
            exit();
        }
        header("Location: ../../index.php");
        echo $id_user;
        exit();
    } else {
        header("Location: ../../form-sandi.php?id=$id_user&error=1");
        exit();
    }
}

sqlsrv_close($conn);
?>
