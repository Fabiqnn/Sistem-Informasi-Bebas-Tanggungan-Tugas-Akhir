<?php 
session_start();
    include '../../config/db-connect.php';

    if (isset($_SESSION['noInduk'])) {
        $role = $_SESSION['role'];
        if ($role === "Admin TA") {
            if (isset($_GET['id'])) {
                $catatan = $_POST['catatan'];
                $status = $_POST['status'];
                $nip = $_SESSION['noInduk'];
                $nim = $_GET['id'];
    
                $current_timestamp = date('Y-m-d H:i:s');
    
                $queryVerifikasi = "INSERT INTO VERIFIKASI (STATUS_VERIFIKASI, WAKTU_VERIFIKASI, CATATAN, NIP)
                                    OUTPUT INSERTED.ID_VERIFIKASI
                                    VALUES (?, ?, ?, ?)";
                $params = array($status, $current_timestamp, $catatan, $nip);
                $result = sqlsrv_query($conn, $queryVerifikasi, $params);
    
                if ($result) {
                    $row = sqlsrv_fetch_array($result);
                    $getVerifikasiId = $row['ID_VERIFIKASI'];
    
                    $queryUpdate = "UPDATE FORM_TA
                                    SET ID_VERIFIKASI = ?
                                    WHERE NIM = ?";
                    $paramsUpdate = array($getVerifikasiId, $nim);
                    $resultUpdate = sqlsrv_query($conn, $queryUpdate, $paramsUpdate);
                    if ($resultUpdate) {
                        header("Location: ../../admin-TA/verifikasi-ta.php");
                    } else {
                        echo "Tidak Berhasil melakukan Update";
                    }
                    
                } else {
                    echo "Tidak Berhasil Insert!";
                }
                
            }
        } else if ($role === "Admin Prodi") {
            if (isset($_GET['id'])) {
                $catatan = $_POST['catatan'];
                $status = $_POST['status'];
                $nip = $_SESSION['noInduk'];
                $nim = $_GET['id'];
    
                $current_timestamp = date('Y-m-d H:i:s');
    
                $queryVerifikasi = "INSERT INTO VERIFIKASI (STATUS_VERIFIKASI, WAKTU_VERIFIKASI, CATATAN, NIP)
                                    OUTPUT INSERTED.ID_VERIFIKASI
                                    VALUES (?, ?, ?, ?)";
                $params = array($status, $current_timestamp, $catatan, $nip);
                $result = sqlsrv_query($conn, $queryVerifikasi, $params);
    
                if ($result) {
                    $row = sqlsrv_fetch_array($result);
                    $getVerifikasiId = $row['ID_VERIFIKASI'];
    
                    $queryUpdate = "UPDATE FORM_PRODI
                                    SET ID_VERIFIKASI = ?
                                    WHERE NIM = ?";
                    $paramsUpdate = array($getVerifikasiId, $nim);
                    $resultUpdate = sqlsrv_query($conn, $queryUpdate, $paramsUpdate);
                    if ($resultUpdate) {
                        header("Location: ../../admin-prodi/verifikasi-prodi.php");
                    } else {
                        echo "Tidak Berhasil melakukan Update";
                    }
                    
                } else {
                    echo "Tidak Berhasil Insert!";
                }
                
            }
        } else if ($role === "Admin Pustaka") {
            if (isset($_GET['id'])) {
                $catatan = $_POST['catatan'];
                $status = $_POST['status'];
                $nip = $_SESSION['noInduk'];
                $nim = $_GET['id'];
    
                $current_timestamp = date('Y-m-d H:i:s');
    
                $queryVerifikasi = "INSERT INTO VERIFIKASI (STATUS_VERIFIKASI, WAKTU_VERIFIKASI, CATATAN, NIP)
                                    OUTPUT INSERTED.ID_VERIFIKASI
                                    VALUES (?, ?, ?, ?)";
                $params = array($status, $current_timestamp, $catatan, $nip);
                $result = sqlsrv_query($conn, $queryVerifikasi, $params);
    
                if ($result) {
                    $row = sqlsrv_fetch_array($result);
                    $getVerifikasiId = $row['ID_VERIFIKASI'];
    
                    $queryUpdate = "UPDATE FORM_TA
                                    SET ID_VERIFIKASI = ?
                                    WHERE NIM = ?";
                    $paramsUpdate = array($getVerifikasiId, $nim);
                    $resultUpdate = sqlsrv_query($conn, $queryUpdate, $paramsUpdate);
                    if ($resultUpdate) {
                        header("Location: ../../admin-TA/verifikasi-ta.php");
                    } else {
                        echo "Tidak Berhasil melakukan Update";
                    }
                    
                } else {
                    echo "Tidak Berhasil Insert!";
                }
                
            }
        }
        
        
    } else {

    }
?>