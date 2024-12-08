<?php
    session_start();
    include '../../config/db-connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $nim = $_POST['nim'];
        $angkatan = $_POST['angkatan'];
        $prodi = $_POST['prodi'];
        $pass = $_POST['pass'];  

        echo "$name, $nim, $angkatan, $prodi, $pass";
    
        if (!empty($name) && !empty($angkatan) && !empty($nim) && !empty($pass) && !empty($prodi)) {
            sqlsrv_begin_transaction($conn);
    
            $sqlUser = "INSERT INTO [USER] (ROLE, PASS, ID_USER) VALUES ('mahasiswa', ?, ?)";
            $paramsUser = array($pass, $nim); 
            $stmtUser = sqlsrv_query($conn, $sqlUser, $paramsUser);
    
            if (!$stmtUser) {
                sqlsrv_rollback($conn);
                die("Error memasukkan data ke tabel user: " . print_r(sqlsrv_errors(), true));
            }
    
            $sqlMhs = "INSERT INTO MAHASISWA (NAMA_MHS, NIM, ID_USER, ANGKATAN, PRODI) VALUES (?, ?, ?, ?, ?)";
            $paramsMhs = array($name, $nim, $nim, $angkatan, $prodi);
            $stmtMhs = sqlsrv_query($conn, $sqlMhs, $paramsMhs);
        
            if (!$stmtMhs) {
                sqlsrv_rollback($conn);

                die("Error memasukkan data ke tabel mahasiswa: " . print_r(sqlsrv_errors(), true));
            }
    
            sqlsrv_commit($conn);
            header("Location: ../../super-admin/kelola-mhs.php?success=1");
            exit();
        }
        } else {
            echo "Harap isi semua field.";
        }   
    sqlsrv_close($conn);
?>