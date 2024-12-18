<?php
    session_start();

    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: ../index.php");
        exit();
    } 

    if(!isset($_GET['type'])) {
        echo "Inisialisasikan variable get 'Type' terlebih dahulu";
        exit();
    }

    $tipe = $_GET['type'];
    $id = $_SESSION['noInduk'];
    $current_timestamp = date('Y-m-d H:i:s');
    include '../../config/db-connect.php';
    

    if ($tipe === '1') {
        $upload_dir = '../uploaded-file/profile-picture/';
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

        $fotoProfile = uploadFile($_FILES['foto'], $upload_dir, "Foto_Profile");

        $query = "UPDATE [ADMIN]
                    SET FOTO_ADM = ?
                    WHERE NIP = ?";
        $params = array($fotoProfile, $id);
        $result = sqlsrv_query($conn, $query, $params);
        if (!$result) {
            die("Query Update Gagal " . print_r(sqlsrv_errors(), true));
        } else {
            $_SESSION['profil'] = $fotoProfile;
            header("Location: ../../include/edit-profile-admin.php");
            exit();
        }
        
    } else if ($tipe === '2') {
        $nama = $_POST['nama'];
        $noWa = $_POST['no-wa'];
        $email = $_POST['email'];

        $query = "UPDATE [ADMIN]
                    SET NAMA_ADM = ?,
                        NO_WA_ADM = ?,
                        EMAIL_ADM = ?
                WHERE NIP = ?";
        $params = array($nama, $noWa, $email, $id);
        $result = sqlsrv_query($conn, $query, $params);

        if (!$result) {
            die("Query Update Gagal " . print_r(sqlsrv_errors(), true));
        } else {
            $_SESSION['nama'] = $nama;
            $_SESSION['noTelp'] = $noWa;
            $_SESSION['email'] = $email;
            header("Location: ../../include/edit-profile-admin.php");
            exit();
        }
    } else {
        echo "Tipe tidak terdaftar";
        exit();
    }

?>