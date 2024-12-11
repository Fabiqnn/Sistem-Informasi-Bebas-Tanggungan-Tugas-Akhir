<?php
    session_start();
    include '../../config/db-connect.php';

    if (isset($_SESSION['noInduk'])) {
        $role = $_SESSION['role'];
        if ($role === "Admin TA") {
            if (isset($_GET['id']) && isset($_GET['idVerif'])) {
                $idVerif = $_GET['idVerif'];
                $catatan = $_POST['catatan'];
                $status = $_POST['status'];
                $nip = $_SESSION['noInduk'];
                $nim = $_GET['id'];
    
                $current_timestamp = date('Y-m-d H:i:s');
    
                $queryUpdate = "UPDATE VERIFIKASI
                                SET catatan = ?,
                                    STATUS_VERIFIKASI = ?
                                WHERE ID_VERIFIKASI = ?";
                $params = array($catatan, $status, $idVerif);
                $result = sqlsrv_query($conn, $queryUpdate, $params);
    
                if ($result) {
                    header("Location: ../../admin-TA/verifikasi-ta.php");
                } else {
                    echo "Tidak Berhasil Update!";
                }
            }
        } else if ($role === "Admin Prodi") {
            if (isset($_GET['id']) && isset($_GET['idVerif'])) {
                $idVerif = $_GET['idVerif'];
                $catatan = $_POST['catatan'];
                $status = $_POST['status'];
                $nip = $_SESSION['noInduk'];
                $nim = $_GET['id'];
    
                $current_timestamp = date('Y-m-d H:i:s');
    
                $queryUpdate = "UPDATE VERIFIKASI
                                SET catatan = ?,
                                    STATUS_VERIFIKASI = ?
                                WHERE ID_VERIFIKASI = ?";
                $params = array($catatan, $status, $idVerif);
                $result = sqlsrv_query($conn, $queryUpdate, $params);
    
                if ($result) {
                    header("Location: ../../admin-prodi/verifikasi-prodi.php");
                } else {
                    echo "Tidak Berhasil Update!";
                }
            }
        } else if ($role === "Admin Pustaka") {
            if (isset($_GET['id']) && isset($_GET['idVerif'])) {
                $idVerif = $_GET['idVerif'];
                $catatan = $_POST['catatan'];
                $status = $_POST['status'];
                $nip = $_SESSION['noInduk'];
                $nim = $_GET['id'];
    
                $current_timestamp = date('Y-m-d H:i:s');
    
                $queryUpdate = "UPDATE VERIFIKASI
                                SET catatan = ?,
                                    STATUS_VERIFIKASI = ?
                                WHERE ID_VERIFIKASI = ?";
                $params = array($catatan, $status, $idVerif);
                $result = sqlsrv_query($conn, $queryUpdate, $params);
    
                if ($result) {
                    header("Location: ../../admin-pustaka/verifikasi-pustaka.php");
                } else {
                    echo "Tidak Berhasil Update!";
                }
            }
        }
    } else {
        echo "Login Terlebih Dahulu!";
    }
?>