<?php
session_start();
include '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'mahasiswa') {
        header("Location: ../index.php");
        exit();
    }

    $id_user = $_SESSION['id']; 

    $upload_dir = '../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    function uploadFile($file, $upload_dir, $field_name) {
        if (isset($file['name']) && $file['error'] === 0) {
            $filename = basename($file['name']);
            $unique_filename = time() . '_' . $filename; 
            $target_path = $upload_dir . $unique_filename;
            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                return $unique_filename; 
            } else {
                die("Gagal mengunggah file $field_name.");
            }
        }
        return null;
    }

    $file_laporan_ta = uploadFile($_FILES['up-laporan-ta'], $upload_dir, 'Laporan TA/Skripsi');
    $file_program = uploadFile($_FILES['up-program'], $upload_dir, 'Program TA/Skripsi');
    $file_publikasi = uploadFile($_FILES['up-publikasi'], $upload_dir, 'Bukti Publikasi');

    $current_timestamp = date('Y-m-d H:i:s');
    $sql = "INSERT INTO FORM_PRODI (
                ID_USER,
                FILE_LAPORAN_TA,
                FILE_PROGRAM_TA,
                FILE_BUKTI_PUBLIKASI,
                FORM_PRODI_CREATED_AT,
                FORM_PRODI_UPDATED_AT
            ) VALUES (?, ?, ?, ?, ?, ?)";

    $params = array(
        $id_user,
        $file_laporan_ta,
        $file_program,
        $file_publikasi,
        $current_timestamp,
        $current_timestamp
    );

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die("Gagal menyimpan data ke database: " . print_r(sqlsrv_errors(), true));
    } else {
        header("Location: success_page.php");
        exit();
    }
}

sqlsrv_close($conn);
?>
