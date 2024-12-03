<?php
    session_start();
    include '../../config/db-connect.php';

    if (isset($_POST['noInduk']) && isset($_POST['pass'])) {
        $noInduk = $_POST['noInduk'];
        $pass = $_POST['pass'];

        $query = "SELECT * FROM [USER] WHERE ID_USER = ? AND PASS = ? ";
        $queryMhs = "SELECT * FROM MAHASISWA WHERE ID_USER = ?";

        $params = array($noInduk, $pass);

        $result = sqlsrv_query($conn, $query, $params);
        $resultMhs = sqlsrv_query($conn, $queryMhs, $params = [0]);

        if ($result && $resultMhs) {
            $row = sqlsrv_fetch_array($result);
            $rowMhs = sqlsrv_fetch_array($resultMhs);

            if ($row) {
                if ($row['ROLE'] == "mahasiswa") {
                    $_SESSION['logged-in'] = true;
                    $_SESSION['nama'] = $row['NAMA_MHS'];
                    header("Location: ../../Mahasiswa/DashboardMahasiswa.php");
                    exit();
                } 
            } else {
                $_SESSION['error'] = "No Induk Atau Kata Sandi Salah";
                header("Location: ../../index.php");
                exit();
            }
        } else {
           die("Terjadi Kesalahan Dengan Query" . sqlsrv_errors());
        }   
    }
?>