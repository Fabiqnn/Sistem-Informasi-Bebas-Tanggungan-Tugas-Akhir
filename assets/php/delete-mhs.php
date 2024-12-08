<?php
    session_start();
    include '../../config/db-connect.php';

    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];

        $sql = "DELETE FROM MAHASISWA WHERE NIM = ?";
        $sqlUser = "DELETE FROM [USER] WHERE ID_USER = ?";
        $params = array($id);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $stmtUser = sqlsrv_query($conn, $sqlUser, $params);

        if (!$stmt && !$stmtUser) {
            die("Error dalam query: " . print_r(sqlsrv_errors(), true));
        } else {
            header("Location: ../../super-admin/kelola-mhs.php");
            exit();
        }
    }

    sqlsrv_close($conn);
?>
