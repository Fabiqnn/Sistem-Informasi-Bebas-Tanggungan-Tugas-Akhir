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

$id = $_GET['id'];

$query = "SELECT * FROM admin WHERE ID_ADMIN = ?";
$stmt = sqlsrv_query($conn, $query, array($id));
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $nip = $_POST['nip'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $query = "UPDATE admin SET NAMA = ?, JABATAN = ?, NIP = ?, PASSWORD = ? WHERE ID_ADMIN = ?";
    $params = array($name, $role, $nip, $pass, $id);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    header("Location: kelola-admin.php");
}

?>
