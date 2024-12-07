<?php
    session_start();
    include '../../config/db-connect.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM admin WHERE NIP = ?";
        $params = array($id);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die("Error dalam query: " . print_r(sqlsrv_errors(), true));
        } else {
            echo "Data dengan NIP: " . $id . " berhasil dihapus.<br>";
            header("Location: ../../super-admin/kelola_admin.php");
            exit();
        }
    }

    sqlsrv_close($conn);
?>
