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

    $file_buku_skripsi = null;
    $file_laporan_pkl = null;
    $file_bukti_bebas_kompen = null;

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

    $file_buku_skripsi = uploadFile($_FILES['up-buku-skripsi'], $upload_dir, 'Buku Skripsi');
    $file_laporan_pkl = uploadFile($_FILES['up-laporan-pkl'], $upload_dir, 'Laporan PKL');
    $file_bukti_bebas_kompen = uploadFile($_FILES['up-bebas-kompen'], $upload_dir, 'Bukti Bebas Kompen');

    $current_timestamp = date('Y-m-d H:i:s');

    $sql = "INSERT INTO FORM_PRODI (
                ID_USER,
                FILE_BUKU_SKRIPSI,
                FILE_LAPORAN_PKL,
                FILE_BUKTI_BEBAS_KOMPEN,
                FORM_PRODI_CREATED_AT,
                FORM_PRODI_UPDATED_AT
            ) VALUES (?, ?, ?, ?, ?, ?)";
    
    $params = array(
        $id_user,
        $file_buku_skripsi,
        $file_laporan_pkl,
        $file_bukti_bebas_kompen,
        $current_timestamp,
        $current_timestamp
    );

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die("Gagal menyimpan data ke database: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Data berhasil disimpan!";
        header("Location: success_page.php"); 
        exit();
    }
}

sqlsrv_close($conn);
?>
