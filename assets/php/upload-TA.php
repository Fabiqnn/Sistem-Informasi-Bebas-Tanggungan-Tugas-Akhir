<?php
session_start();

if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
    header("Location: ../index.php");
    exit();
} 

if ($_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../index.php");
    exit();
}
include '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_user = $_SESSION['noInduk']; 

    $upload_dir = '../uploaded-file/form-ta/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    } else if (!is_writable($upload_dir)) {
        die("Folder Tidak Bisa Di Tulis");
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
    $sql = "INSERT INTO FORM_TA (
                NIM,
                FILE_LAPORAN_TA,
                PROGRAM_TA,
                PUBLIKASI,
                FORM_TA_CREATED,
                FORM_TA_UPDATED
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
        die("$file_laporan_ta " . print_r(sqlsrv_errors(), true));
    } else {
        header("Location: ../../Mahasiswa/form-TA-lt7.php?adm=1");
        exit();
    }
}

sqlsrv_close($conn);
?>
