<?php
    session_start();
    include '../../config/db-connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $nip = $_POST['nip'];
        $pass = $_POST['pass'];  

        echo "$name, $role, $nip, $pass";

        if (!empty($nama) && !empty($role) && !empty($nip) && !empty($pass)) {
            sqlsrv_begin_transaction($conn);

            $sqlUser = "INSERT INTO [USER] (ROLE, PASS, ID_USER) VALUES (?, ?, ?)";
            $paramsUser = array($role, $pass, $nip); 
            $stmtUser = sqlsrv_query($conn, $sqlUser, $paramsUser);

            if (!$stmtUser) {
                sqlsrv_rollback($conn);
                echo "$name, $role, $nip, $pass";
                die("Error memasukkan data ke tabel user: " . print_r(sqlsrv_errors(), true));
            }

            $sqlAdmin = "INSERT INTO ADMIN (NAMA, NIP, ID_USER) VALUES (?, ?, ?)";
            $paramsAdmin = array($name, $nip, $nip);
            $stmtAdmin = sqlsrv_query($conn, $sqlAdmin, $paramsAdmin);
        
            if (!$stmtAdmin) {
                sqlsrv_rollback($conn);
                die("Error memasukkan data ke tabel admin: " . print_r(sqlsrv_errors(), true));
            }

            sqlsrv_commit($conn);
            header("Location: ../../super-admin/kelola-admin.php?success=1");
            exit();
        }
        } else {
            echo "Harap isi semua field.";
        }   
    sqlsrv_close($conn)
?>